<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\SubscriptionContext;
use Didntread\NetSapiens\Data\SubscriptionResource;
use Didntread\NetSapiens\Enum\EventType;

class SubscriptionList extends ResourceList
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Retrieve a list of event subscriptions.
     * @return array<SubscriptionResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', 'v2/subscriptions');
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new SubscriptionResource($this->client, $item);
        }, $data);
    }

    public function create(EventType $type, string $url, string $domain, array $options = []): SubscriptionResource
    {
        $response = $this->client->request('POST', 'v2/subscriptions', [], [
            'event_type' => $type->value,
            'post-url' => $url,
            'domain' => $domain,
        ] + $options,
        );

        $data = json_decode($response->getBody(), true);

        return new SubscriptionResource($this->client, $data);
    }

    public function fetch($id): SubscriptionResource
    {
        return (new SubscriptionContext($this->client, $id))->fetch();
    }

    public function update($id, array $options): void
    {
        (new SubscriptionContext($this->client, $id))->update($options);
    }

    public function delete($id): void
    {
        (new SubscriptionContext($this->client, $id))->delete();
    }
}
