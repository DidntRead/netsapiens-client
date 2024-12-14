<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\DeviceResource;

class DeviceContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $user, string $device)
    {
        parent::__construct($client, $device);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    public function fetch(): DeviceResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/devices/{$this->getId()}");
        $data = json_decode($response->getBody()->getContents(), true);

        return new DeviceResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/devices/{$this->getId()}", [], $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/devices/{$this->getId()}");
    }
}
