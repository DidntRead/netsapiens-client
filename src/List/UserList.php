<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\UserContext;
use Didntread\NetSapiens\Data\UserResource;
use Didntread\NetSapiens\Enum\UserScope;

class UserList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new UserResource($this->client, $item);
        }, $data);
    }

    public function create(int $extension, string $first_name, string $last_name, UserScope $scope, array $options = [], bool $return = false): ?UserResource
    {
        if ($return) {
            $options['synchronous'] = 'yes';
        }

        if (!isset($options['extension'])) {
            $options['user'] = $extension;
        }

        if (!isset($options['name-first-name'])) {
            $options['name-first-name'] = $first_name;
        }

        if (!isset($options['name-last-name'])) {
            $options['name-last-name'] = $last_name;
        }

        if (!isset($options['user-scope'])) {
            $options['user-scope'] = $scope->value;
        }

        $response = $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users", [
            'json' => $options,
        ]);

        if ($return) {
            $data = json_decode($response->getBody(), true);

            return new UserResource($this->client, $data);
        } else {
            return null;
        }
    }

    public function fetch($id): UserResource
    {
        return (new UserContext($this->client, $this->meta['domain'], $id))->fetch();
    }

    public function update($id, array $options): void
    {
        (new UserContext($this->client, $this->meta['domain'], $id))->update($options);
    }

    public function delete($id): void
    {
        (new UserContext($this->client, $this->meta['domain'], $id))->delete();
    }
}
