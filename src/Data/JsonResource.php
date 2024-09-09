<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;

class JsonResource
{
    protected Client $client;
    protected array $properties = [];
    protected array $meta = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function toArray(): array
    {
        return $this->properties;
    }

    public function __toString(): string
    {
        return '[JsonResource]';
    }

    public function __isset($name): bool
    {
        return \array_key_exists($name, $this->properties);
    }
}
