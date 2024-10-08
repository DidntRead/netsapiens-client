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

    /**
     * Retrieve a list of users.
     * @param  string|null  $site  - filter by user site
     * @param  bool  $show_system  - show system users
     * @return array<UserResource>
     */
    public function list(?string $site = null, bool $show_system = false): array
    {
        $query = [];

        if ($site) {
            $query['site'] = $site;
        }

        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users", $query);
        $data = json_decode($response->getBody(), true);

        return array_reduce($data, function ($carry, $item) use ($show_system) {
            if (str_starts_with($item['service-code'], 'system') && !$show_system) {
                return $carry;
            }

            $carry[] = new UserResource($this->client, $item);

            return $carry;
        }, []);
    }

    public function create(int $extension, string $first_name, string $last_name, UserScope $scope, array $options = []): string
    {
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

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users", [], $options);

        return $options['user'];
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
