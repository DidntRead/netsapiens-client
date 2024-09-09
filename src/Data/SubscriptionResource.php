<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\SubscriptionContext;
use Didntread\NetSapiens\Enum\EventType;
use Didntread\NetSapiens\Enum\SubscriptionStatus;
use Didntread\NetSapiens\Enum\UserScope;

class SubscriptionResource extends JsonResource
{
    protected $context;

    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = ['id' => $parameters['id']];

        $this->properties = [
            'id' => $parameters['id'],
            'model' => EventType::from($parameters['model']),
            'post_url' => $parameters['post-url'],
            'subscription_geo_support' => Deserialize::bool($parameters['subscription-geo-support']),
            'user-scope' => UserScope::from($parameters['user-scope']),
            'reseller' => $parameters['reseller'],
            'domain' => $parameters['domain'],
            'user' => $parameters['user'],
            'created_at' => Carbon::parse($parameters['subscription-creation-datetime']),
            'expires_at' => Carbon::parse($parameters['subscription-expiration-datetime']),
            'preferred_server' => $parameters['preferred-server'],
            'current_active_server' => $parameters['current-active-server'],
            'status' => SubscriptionStatus::from($parameters['status']),
            'error_count' => $parameters['error-count'],
            'posts_count' => $parameters['posts-count'],
        ];
    }

    public function context(): SubscriptionContext
    {
        if (!$this->context) {
            $this->context = new SubscriptionContext($this->client, $this->meta['id']);
        }

        return $this->context;
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[SubscriptionResource ' . \implode(' ', $context) . ']';
    }
}
