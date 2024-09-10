<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\DomainResource;
use Didntread\NetSapiens\List\CallLogList;
use Didntread\NetSapiens\List\CallQueueList;
use Didntread\NetSapiens\List\PhoneNumberList;
use Didntread\NetSapiens\List\TimeFrameList;
use Didntread\NetSapiens\List\UserList;

class DomainContext extends ResourceContext
{
    public function __construct(Client $client, string $id)
    {
        parent::__construct($client, $id);
    }

    public function fetch(): DomainResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->id}");
        $data = json_decode($response->getBody(), true);

        return new DomainResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->id}", $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->id}");
    }

    public function users(): UserList
    {
        return new UserList($this->client, $this->getId());
    }

    public function user(int $extension): UserContext
    {
        return new UserContext($this->client, $this->getId(), $extension);
    }

    public function phone_numbers(): PhoneNumberList
    {
        return new PhoneNumberList($this->client, $this->getId());
    }

    public function phone_number(string $phone_number): PhoneNumberContext
    {
        return new PhoneNumberContext($this->client, $this->getId(), $phone_number);
    }

    public function shared_time_frames(): TimeFrameList
    {
        return new TimeFrameList($this->client, $this->getId());
    }

    public function shared_time_frame(string $id): TimeFrameContext
    {
        return new TimeFrameContext($this->client, $this->getId(), null, $id);
    }

    public function call_queues(): CallQueueList
    {
        return new CallQueueList($this->client, $this->getId());
    }

    public function call_queue(string $id): CallQueueContext
    {
        return new CallQueueContext($this->client, $this->getId(), $id);
    }

    public function call_logs(): CallLogList
    {
        return new CallLogList($this->client, $this->getId());
    }

    public function call_log(string $id): CallLogContext
    {
        return new CallLogContext($this->client, $this->getId(), $id);
    }
}
