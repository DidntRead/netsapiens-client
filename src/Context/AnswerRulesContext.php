<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRules;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRulesResource;

class AnswerRulesContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $user, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    public function fetch(): AnswerRulesResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new AnswerRulesResource($this->client, $data);
    }

    public function update(AnswerRules $rules): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules/{$this->meta['id']}", [], $rules->toJsonArray());
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules/{$this->meta['id']}");
    }
}
