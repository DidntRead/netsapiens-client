<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\DialRuleApplication;

/**
 * Properties for the dial rule configuration.
 *
 * @property string $phonenumber The phone number associated with the dial rule.
 * @property string $domain The domain to which the dial rule applies.
 * @property DialRuleApplication $dial_rule_application The application of the dial rule (represented by an enum).
 * @property string $dial_rule_description A description of the dial rule.
 * @property string $dial_rule_parameter Additional parameters for the dial rule.
 * @property string $dial_rule_translation_destination_host The destination host for dial rule translation.
 * @property string $dial_rule_translation_destination_user The destination user for dial rule translation.
 * @property string $dial_rule_translation_source_name The source name used in dial rule translation.
 * @property bool $enabled Indicates whether the dial rule is enabled.
 */
class PhoneNumberResource extends JsonResource
{
    protected $context;

    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'id' => $parameters['phonenumber'],
            'domain' => $parameters['domain'],
        ];

        $this->properties = [
            'phonenumber' => $parameters['phonenumber'],
            'domain' => $parameters['domain'],
            'dial_rule_application' => DialRuleApplication::from($parameters['dial-rule-application']),
            'dial_rule_description' => $parameters['dial-rule-description'],
            'dial_rule_parameter' => $parameters['dial-rule-parameter'],
            'dial_rule_translation_destination_host' => $parameters['dial-rule-translation-destination-host'],
            'dial_rule_translation_destination_user' => $parameters['dial-rule-translation-destination-user'],
            'dial_rule_translation_source_name' => $parameters['dial-rule-translation-source-name'],
            'enabled' => Deserialize::bool($parameters['enabled']),
        ];
    }

    public function context(): PhoneNumberContext
    {
        return new PhoneNumberContext($this->client, $this->meta['domain'], $this->meta['id']);
    }
}
