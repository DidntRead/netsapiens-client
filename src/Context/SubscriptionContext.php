<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\SubscriptionResource;

class SubscriptionContext extends ResourceContext
{
    public function __construct(Client $client, string $id)
    {
        parent::__construct($client, $id);
    }

    public function fetch(): SubscriptionResource
    {
        $response = $this->client->request('GET', "v2/subscriptions/{$this->id}");
        $data = json_decode($response->getBody(), true);

        return new SubscriptionResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/subscriptions/{$this->id}", [], $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/subscriptions/{$this->id}");
    }
}
