<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\AnswerRulesContext;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRules;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRulesResource;

class AnswerRulesList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $user)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    /**
     * Retrieve a list of answer rules for a user.
     * @return array<AnswerRulesResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new AnswerRulesResource($this->client, $item);
        }, $data);
    }

    public function create(AnswerRules $rules): string
    {
        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules", [
            'json' => $rules->toJsonArray(),
        ]);

        return $rules->getTimeFrame();
    }

    public function reorder(array $ids): void
    {
        $time_frames = array_map(function ($id) {
            return ['time-frame' => $id];
        }, $ids);
        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/answerrules/reorder", [
            'json' => $time_frames,
        ]);
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
