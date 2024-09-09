<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;

class ResourceList
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
