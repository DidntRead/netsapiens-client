<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\AgentResource;

class AgentContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $queue, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
        $this->meta['queue'] = $queue;
    }

    public function fetch(): AgentResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents/{$this->getId()}");
        $data = json_decode($response->getBody()->getContents(), true);

        return new AgentResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents/{$this->getId()}", [], $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents/{$this->getId()}");
    }
}
