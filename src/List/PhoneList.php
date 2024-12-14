<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\PhoneContext;
use Didntread\NetSapiens\Data\PhoneResource;

class PhoneList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    /**
     * Retrieve a list of phones in a domain.
     * @return array<PhoneResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/phones");
        $data = json_decode($response->getBody()->getContents(), true);

        return array_map(function ($item) {
            return new PhoneResource($this->client, $item);
        }, $data);
    }

    public function create(string $mac, string $model, array $options = []): string
    {
        if (!isset($options['mac'])) {
            $options['mac'] = $mac;
        }

        if (!isset($options['model'])) {
            $options['model'] = $model;
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/phones", [], $options);

        return $options['mac'];
    }

    public function fetch($mac): PhoneResource
    {
        return (new PhoneContext($this->client, $this->meta['domain'], $mac))->fetch();
    }

    public function update($mac, array $options): void
    {
        (new PhoneContext($this->client, $this->meta['domain'], $mac))->update($options);
    }

    public function delete($mac): void
    {
        (new PhoneContext($this->client, $this->meta['domain'], $mac))->delete();
    }
}
