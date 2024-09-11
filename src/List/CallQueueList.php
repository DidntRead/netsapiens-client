<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\CallQueueContext;
use Didntread\NetSapiens\Data\CallQueueResource;
use Didntread\NetSapiens\Enum\CallQueueType;

class CallQueueList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    /**
     * Retrieve a list of call queues.
     * @return array<CallQueueResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/callqueues");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new CallQueueResource($this->client, $item);
        }, $data);
    }

    public function create(int $extension, CallQueueType $type, string $description, array $options = []): string
    {
        if (!isset($options['callqueue'])) {
            $options['callqueue'] = $extension;
        }

        if (!isset($options['callqueue-dispatch-type'])) {
            $options['callqueue-dispatch-type'] = $type->value;
        }

        if (!isset($options['description'])) {
            $options['description'] = $description;
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/callqueues", [], $options);

        return $options['callqueue'];
    }

    public function fetch(string $id): CallQueueResource
    {
        return (new CallQueueContext($this->client, $this->meta['domain'], $id))->fetch();
    }

    public function update(string $id, array $options): void
    {
        (new CallQueueContext($this->client, $this->meta['domain'], $id))->update($options);
    }

    public function delete(string $id): void
    {
        (new CallQueueContext($this->client, $this->meta['domain'], $id))->delete();
    }
}
