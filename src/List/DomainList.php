<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\DomainContext;
use Didntread\NetSapiens\Data\DomainResource;

class DomainList extends ResourceList
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Retrieve a list of domains.
     * @return array<DomainResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', 'v2/domains');
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new DomainResource($this->client, $item);
        }, $data);
    }

    public function count(): int
    {
        $response = $this->client->request('GET', 'v2/domains/count');
        $data = json_decode($response->getBody(), true);

        return $data['total'];
    }

    public function create(string $domain, array $options = []): string
    {
        if (!isset($options['domain'])) {
            $options['domain'] = $domain;
        }

        $this->client->request('POST', 'v2/domains', [
            'json' => $options,
        ]);

        return $options['domain'];
    }

    public function fetch(string $id): DomainResource
    {
        return (new DomainContext($this->client, $id))->fetch();
    }

    public function update(string $id, array $options): void
    {
        (new DomainContext($this->client, $id))->update($options);
    }

    public function delete(string $id): void
    {
        (new DomainContext($this->client, $id))->delete();
    }
}
