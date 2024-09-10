<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\SubscriptionContext;
use Didntread\NetSapiens\Enum\EventType;
use Didntread\NetSapiens\Enum\SubscriptionStatus;
use Didntread\NetSapiens\Enum\UserScope;

/**
 * Properties for the event subscription configuration.
 *
 * @property string $id The unique identifier for the subscription.
 * @property EventType $model The event model type associated with the subscription.
 * @property string $post_url The URL where event posts will be sent.
 * @property bool $subscription_geo_support Whether geo-location support is enabled for the subscription.
 * @property UserScope $user_scope The scope of the user for the subscription.
 * @property string $reseller The reseller associated with the subscription.
 * @property string $domain The domain associated with the subscription.
 * @property string $user The user who owns the subscription.
 * @property Carbon $created_at The date and time when the subscription was created.
 * @property Carbon $expires_at The date and time when the subscription expires.
 * @property string $preferred_server The preferred server for the subscription.
 * @property string $current_active_server The server currently handling the subscription.
 * @property SubscriptionStatus $status The current status of the subscription (active, expired, etc.).
 * @property int $error_count The number of errors encountered during the subscription period.
 * @property int $posts_count The number of posts made by the subscription.
 */
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
            'expires_at' => Carbon::parse($parameters['subscription-expires-datetime']),
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
