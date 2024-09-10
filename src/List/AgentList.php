<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\AgentContext;
use Didntread\NetSapiens\Data\AgentResource;

class AgentList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $queue)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['queue'] = $queue;
    }

    /**
     * Retrieve a list of agents in a call queue.
     * @return array<AgentResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents");
        $data = json_decode($response->getBody()->getContents(), true);

        return array_map(function ($item) {
            return new AgentResource($this->client, $item);
        }, $data);
    }

    public function create(string $agent_id, array $options = []): string
    {
        if (!isset($options['callqueue-agent-id'])) {
            $options['callqueue-agent-id'] = $agent_id;
        }

        if (!isset($options['callqueue'])) {
            $options['callqueue'] = $this->meta['queue'];
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/callqueues/{$this->meta['queue']}/agents", [], $options);

        return $options['callqueue-agent-id'];
    }

    public function fetch($id): AgentResource
    {
        return (new AgentContext($this->client, $this->meta['domain'], $this->meta['queue'], $id))->fetch();
    }

    public function update($id, array $options): void
    {
        (new AgentContext($this->client, $this->meta['domain'], $this->meta['queue'], $id))->update($options);
    }

    public function delete($id): void
    {
        (new AgentContext($this->client, $this->meta['domain'], $this->meta['queue'], $id))->delete();
    }
}
