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
        $response = $this->client->get("domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents/{$this->getId()}");
        $data = $response->json();

        return new AgentResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->put("domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents/{$this->getId()}", [
            'json' => $options,
        ]);
    }

    public function delete(): void
    {
        $this->client->delete("domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents/{$this->getId()}");
    }
}
