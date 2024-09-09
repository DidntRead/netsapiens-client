<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\ResourceContext;
use Didntread\NetSapiens\Data\PhoneNumberResource;

class PhoneNumberContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): PhoneNumberResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/phonenumbers/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new PhoneNumberResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/phonenumbers/{$this->meta['id']}", $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/phonenumbers/{$this->meta['id']}");
    }
}
