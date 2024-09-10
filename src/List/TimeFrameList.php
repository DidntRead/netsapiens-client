<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\TimeFrameContext;
use Didntread\NetSapiens\Data\TimeFrameResource;

class TimeFrameList extends ResourceList
{
    public function __construct(Client $client, string $domain, ?string $user = null)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        if ($user) {
            $this->meta['user'] = $user;
        }
    }

    /**
     * Retrieve a list of time frames.
     * @return array<TimeFrameResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', $this->buildUrl());
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new TimeFrameResource($this->client, $item);
        }, $data);
    }

    public function create(array $options = []): string
    {
        $this->client->request('POST', $this->buildUrl(), [
            'json' => $options,
        ]);

        return $options['time-frame'];
    }

    public function fetch(string $id): TimeFrameResource
    {
        return (new TimeFrameContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->fetch();
    }

    public function update(string $id, array $options): void
    {
        (new TimeFrameContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->update($options);
    }

    public function delete(string $id): void
    {
        (new TimeFrameContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->delete();
    }

    private function buildUrl(): string
    {
        if (isset($this->meta['user'])) {
            return "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/timeframes";
        } else {
            return "v2/domains/{$this->meta['domain']}/timeframes";
        }
    }
}
