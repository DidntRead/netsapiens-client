<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;

class ResourceList
{
    protected Client $client;

    protected array $meta = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
