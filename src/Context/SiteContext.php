<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\SiteResource;

class SiteContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): SiteResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/sites/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new SiteResource($this->client, $data);
    }

    public function update(array $options): void
    {
        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/sites/{$this->meta['id']}", $options);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/sites/{$this->meta['id']}");
    }
}
