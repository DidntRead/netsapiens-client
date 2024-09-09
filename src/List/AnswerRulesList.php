<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Data\AnswerRules\AnswerRules;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\AnswerRulesContext;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRulesResource;

class AnswerRulesList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $user)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new AnswerRulesResource($this->client, $item);
        }, $data);
    }

    public function create(AnswerRules $rules): AnswerRulesResource
    {
        $response = $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules", [
            'json' => $rules->toJsonArray(),
        ]);
        $data = json_decode($response->getBody(), true);

        return new AnswerRulesResource($this->client, $data);
    }

    public function fetch(string $id): AnswerRulesResource
    {
        return (new AnswerRulesContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->fetch();
    }

    public function update(string $id, AnswerRules $rules): void
    {
        (new AnswerRulesContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->update($rules);
    }

    public function delete(string $id): void
    {
        (new AnswerRulesContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->delete();
    }
}
