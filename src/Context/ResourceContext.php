<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;

class ResourceContext
{
    protected Client $client;

    protected array $meta = [];

    public function __construct(Client $client, string $id)
    {
        $this->client = $client;
        $this->meta['id'] = $id;
    }

    public function getId(): string
    {
        return $this->meta['id'];
    }
}
