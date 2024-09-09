<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\CallQueueContext;
use Didntread\NetSapiens\Data\CallQueueResource;
use Didntread\NetSapiens\Enum\CallQueueType;

class CallQueueList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/callqueues");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new CallQueueResource($this->client, $item);
        }, $data);
    }

    public function create(int $extension, CallQueueType $type, string $description, array $options = []): void
    {
        if (!isset($options['extension'])) {
            $options['extension'] = $extension;
        }

        if (!isset($options['type'])) {
            $options['type'] = $type->value;
        }

        if (!isset($options['description'])) {
            $options['description'] = $description;
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/callqueues", [
            'json' => $options,
        ]);
    }

    public function fetch(string $id): CallQueueResource
    {
        return (new CallQueueContext($this->client, $this->meta['domain'], $id))->fetch();
    }

    public function update(string $id, array $options): void
    {
        (new CallQueueContext($this->client, $this->meta['domain'], $id))->update($options);
    }

    public function delete(string $id): void
    {
        (new CallQueueContext($this->client, $this->meta['domain'], $id))->delete();
    }
}
