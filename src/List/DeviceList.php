<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\DeviceContext;
use Didntread\NetSapiens\Data\DeviceResource;

class DeviceList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $user)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    /**
     * Retrieve a list of agents in a call queue.
     * @return array<DeviceList>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/devices");
        $data = json_decode($response->getBody()->getContents(), true);

        return array_map(function ($item) {
            return new DeviceList($this->client, $this->meta['user'], $item);
        }, $data);
    }

    public function create(string $device, array $options = []): string
    {
        if (!isset($options['device'])) {
            $options['device'] = $device;
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/devices", [], $options);

        return $options['device'];
    }

    public function fetch($id): DeviceResource
    {
        return (new DeviceContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->fetch();
    }

    public function update($id, array $options): void
    {
        (new DeviceContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->update($options);
    }

    public function delete($id): void
    {
        (new DeviceContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->delete();
    }
}
