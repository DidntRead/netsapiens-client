<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\TimeFrameResource;

class TimeFrameContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, ?string $user, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
        if ($user) {
            $this->meta['user'] = $user;
        }
    }

    public function fetch(): TimeFrameResource
    {
        $response = $this->client->request('GET', $this->buildUrl());
        $data = json_decode($response->getBody(), true);

        return new TimeFrameResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', $this->buildUrl(), [
            'json' => $options,
        ]);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', $this->buildUrl());
    }

    private function buildUrl(): string
    {
        if (isset($this->meta['user'])) {
            return "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/timeframes/{$this->meta['id']}";
        } else {
            return "v2/domains/{$this->meta['domain']}/timeframes/{$this->meta['id']}";
        }
    }
}
