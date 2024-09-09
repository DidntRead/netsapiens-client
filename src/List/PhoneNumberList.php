<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\PhoneNumberContext;
use Didntread\NetSapiens\Data\PhoneNumberResource;

class PhoneNumberList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/phonenumbers");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new PhoneNumberResource($this->client, $item);
        }, $data);
    }

    public function create(string $phone_number, array $options = []): void
    {
        if (!isset($options['phonenumber'])) {
            $options['phonenumber'] = $phone_number;
        }

        $response = $this->client->request('POST', "v2/domains/{$this->meta['domain']}/phonenumbers", [
            'json' => $options,
        ]);
    }

    public function fetch($id): PhoneNumberResource
    {
        return (new PhoneNumberContext($this->client, $this->meta['domain'], $id))->fetch();
    }

    public function update($id, array $options): void
    {
        (new PhoneNumberContext($this->client, $this->meta['domain'], $id))->update($options);
    }

    public function delete($id): void
    {
        (new PhoneNumberContext($this->client, $this->meta['domain'], $id))->delete();
    }
}
