<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\SiteContext;
use Didntread\NetSapiens\Data\SiteResource;

class SiteList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/sites");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new SiteResource($this->client, $item);
        }, $data);
    }

    public function create(string $site, array $options): void
    {
        if (!isset($options['site'])) {
            $options['site'] = $site;
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/sites", [
            'json' => $options,
        ]);
    }

    public function fetch(string $id): SiteResource
    {
        return (new SiteContext($this->client, $this->meta['domain'], $id))->fetch();
    }

    public function update(string $id, array $options): void
    {
        (new SiteContext($this->client, $this->meta['domain'], $id))->update($options);
    }

    public function delete(string $id): void
    {
        (new SiteContext($this->client, $this->meta['domain'], $id))->delete();
    }
}
