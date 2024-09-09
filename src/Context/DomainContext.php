<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\DomainResource;

class DomainContext extends ResourceContext
{
    public function __construct(Client $client, string $id)
    {
        parent::__construct($client, $id);
    }

    public function fetch(): DomainResource
    {
        $response = $this->client->request("GET", "v2/domains/{$this->id}");
        $data = json_decode($response->getBody(), true);
        return new DomainResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request("PUT", "v2/domains/{$this->id}", $options);
    }

    public function delete(): void
    {
        $this->client->request("DELETE", "v2/domains/{$this->id}");
    }
}
