<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\UserResource;
use Didntread\NetSapiens\List\AnswerRulesList;

class UserContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): UserResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new UserResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/users/{$this->meta['id']}", $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/users/{$this->meta['id']}");
    }

    public function answer_rules(): AnswerRulesList
    {
        return new AnswerRulesList($this->client, $this->meta['domain'], $this->meta['id']);
    }

    public function answer_rule(string $time_frame): AnswerRulesContext
    {
        return new AnswerRulesContext($this->client, $this->meta['domain'], $this->meta['id'], $time_frame);
    }
}
