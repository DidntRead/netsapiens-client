<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\AgentResource;
use Didntread\NetSapiens\Data\PhoneResource;

class PhoneContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $mac)
    {
        parent::__construct($client, $mac);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): PhoneResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/phones/{$this->getId()}");
        $data = json_decode($response->getBody()->getContents(), true);

        return new PhoneResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/phones/{$this->getId()}", [], $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/phones/{$this->getId()}");
    }
}
