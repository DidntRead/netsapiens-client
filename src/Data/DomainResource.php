<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\DomainContext;
use Didntread\NetSapiens\Enum\DomainType;

/**
 * @property string $domain
 * @property string $reseller
 * @property string $description
 * @property int $active_calls_against_license_count
 * @property int $active_calls_offnet_current
 * @property int $active_calls_total_current
 * @property int $count_users_configured
 * @property string $dial_plan
 * @property string $dial_policy
 * @property DomainType $domain_type
 * @property string $email_send_from_address
 * @property string $email_send_smtp_hostname
 * @property string $email_send_smtp_password
 * @property string $email_send_smtp_port
 * @property string $email_send_smtp_username
 * @property string $emergency_address_id
 * @property bool $is_domain_locked
 * @property bool $is_ivr_forward_change_blocked
 * @property bool $is_stir_enabled
 * @property int $limits_max_active_calls_offnet
 * @property int $limits_max_active_calls_total
 * @property int $limits_max_auto_attendants
 * @property int $limits_max_call_queues
 * @property int $limits_max_conferences
 * @property int $limits_max_departments
 * @property int $limits_max_fax_accounts
 * @property int $limits_max_sites
 * @property int $limits_max_subscriber_resources_total
 * @property int $limits_max_users
 * @property bool $music_on_hold_enabled
 * @property bool $music_on_hold_randomized_enabled
 * @property bool $music_on_ring_enabled
 * @property bool $single_sign_on_enabled
 * @property string $time_zone
 */
class DomainResource extends JsonResource
{
    protected $context;

    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = ['id' => $parameters['domain']];

        $this->properties = [
            'domain' => $parameters['domain'],
            'reseller' => $parameters['reseller'],
            'description' => $parameters['description'],
            'active_calls_against_license_count' => $parameters['active-calls-against-license-count'],
            'active_calls_offnet_current' => $parameters['active-calls-offnet-current'],
            'active_calls_total_current' => $parameters['active-calls-total-current'],
            'count_users_configured' => $parameters['count-users-configured'],
            'dial_plan' => $parameters['dial-plan'],
            'dial_policy' => $parameters['dial-policy'],
            'domain_type' => DomainType::from($parameters['domain-type']),
            'email_send_from_address' => $parameters['email-send-from-address'],
            'email_send_smtp_hostname' => $parameters['email-send-smtp-hostname'],
            'email_send_smtp_password' => $parameters['email-send-smtp-password'],
            'email_send_smtp_port' => $parameters['email-send-smtp-port'],
            'email_send_smtp_username' => $parameters['email-send-smtp-username'],
            'emergency_address_id' => $parameters['emergency-address-id'],
            'is_domain_locked' => Deserialize::bool($parameters['is-domain-locked']),
            'is_ivr_forward_change_blocked' => Deserialize::bool($parameters['is-ivr-forward-change-blocked']),
            'is_stir_enabled' => Deserialize::bool($parameters['is-stir-enabled']),
            'limits_max_active_calls_offnet' => $parameters['limits-max-active-calls-offnet'],
            'limits_max_active_calls_total' => $parameters['limits-max-active-calls-total'],
            'limits_max_auto_attendants' => $parameters['limits-max-auto-attendants'],
            'limits_max_call_queues' => $parameters['limits-max-call-queues'],
            'limits_max_conferences' => $parameters['limits-max-conferences'],
            'limits_max_departments' => $parameters['limits-max-departments'],
            'limits_max_fax_accounts' => $parameters['limits-max-fax-accounts'],
            'limits_max_sites' => $parameters['limits-max-sites'],
            'limits_max_subscriber_resources_total' => $parameters['limits-max-subcriber-resources-total'],
            'limits_max_users' => $parameters['limits-max-users'],
            'music_on_hold_enabled' => Deserialize::bool($parameters['music-on-hold-enabled']),
            'music_on_hold_randomized_enabled' => Deserialize::bool($parameters['music-on-hold-randomized-enabled']),
            'music_on_ring_enabled' => Deserialize::bool($parameters['music-on-ring-enabled']),
            'single_sign_on_enabled' => Deserialize::bool($parameters['single-sign-on-enabled']),
            'time_zone' => $parameters['time-zone'],
        ];
    }

    public function context(): DomainContext
    {
        if (!$this->context) {
            $this->context = new DomainContext($this->client, $this->meta['id']);
        }

        return $this->context;
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[DomainResource ' . \implode(' ', $context) . ']';
    }
}
