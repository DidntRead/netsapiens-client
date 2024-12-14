<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\DialRuleResource;

class DialRulesContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $dial_plan, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
        $this->meta['dial_plan'] = $dial_plan;
    }

    public function fetch(): DialRuleResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/dialplans/{$this->meta['dial_plan']}/dialrules/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new DialRuleResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/dialplans/{$this->meta['dial_plan']}/dialrules/{$this->meta['id']}", [], $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/dialplans/{$this->meta['dial_plan']}/dialrules/{$this->meta['id']}");
    }
}
