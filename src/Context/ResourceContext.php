<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;

class ResourceContext
{
    protected Client $client;
    protected string $id;

    public function __construct(Client $client, string $id)
    {
        $this->client = $client;
        $this->id = $id;
    }
}
