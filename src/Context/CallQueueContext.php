<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\CallQueueResource;
use Didntread\NetSapiens\List\AgentList;

class CallQueueContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): CallQueueResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new CallQueueResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['id']}", [], $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['id']}");
    }

    public function agents(): AgentList
    {
        return new AgentList($this->client, $this->meta['domain'], $this->meta['id']);
    }

    public function agent(string $id): AgentContext
    {
        return new AgentContext($this->client, $this->meta['domain'], $this->meta['id'], $id);
    }
}
