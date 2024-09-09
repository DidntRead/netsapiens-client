<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Exceptions\NetSapiensException;

class JsonResource
{
    protected Client $client;

    protected array $properties = [];

    protected array $meta = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getId(): string
    {
        return $this->meta['id'];
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

    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        throw new NetSapiensException('Unknown property: ' . $name);
    }
}
