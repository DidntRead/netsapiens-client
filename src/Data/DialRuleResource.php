<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\CallQueueType;
use Didntread\NetSapiens\Enum\DialRuleApplication;

/**
 * Properties for the dial rule.
 * @property string $dialrule The specific dial rule identifier or name.
 * @property string $domain The domain to which the dial rule is applied.
 * @property string $dial_rule_dial_plan The dial plan associated with the dial rule.
 * @property string $dial_rule_matching_to_uri The URI for matching destination (To) in the dial rule.
 * @property bool $enabled Indicates if the dial rule is enabled.
 * @property string $dial_rule_matching_from_uri The URI for matching source (From) in the dial rule.
 * @property string $dial_rule_matching_day_of_week The days of the week on which the dial rule is active.
 * @property string $dial_rule_matching_start_date The start date from which the dial rule is active.
 * @property string $dial_rule_matching_end_date The end date until which the dial rule is active.
 * @property string $dial_rule_matching_start_time The start time from which the dial rule is active each day.
 * @property string $dial_rule_matching_end_time The end time until which the dial rule is active each day.
 * @property DialRuleApplication $dial_rule_application The application or action triggered by the dial rule.
 * @property string $dial_rule_parameter Additional parameters for the dial rule.
 * @property string $dial_rule_translation_destination_scheme The scheme for the destination translation.
 * @property string $dial_rule_translation_destination_user The user component for the destination translation.
 * @property string $dial_rule_translation_destination_host The host component for the destination translation.
 * @property string $dial_rule_translation_source_name The source name used in the dial rule translation.
 * @property string $dial_rule_translation_source_scheme The scheme for the source translation.
 * @property string $dial_rule_translation_source_user The user component for the source translation.
 * @property string $dial_rule_translation_source_host The host component for the source translation.
 * @property string $dial_rule_description A description of the dial rule for documentation or clarification purposes.
 */
class DialRuleResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'id' => $parameters['dialrule'],
            'domain' => $parameters['domain'],
            'dial_plan' => $parameters['dial-rule-dial-plan'],
        ];

        $this->properties = [
            'dialrule' => $parameters['dialrule'],
            'domain' => $parameters['domain'],
            'dial_rule_dial_plan' => $parameters['dial-rule-dial-plan'],
            'dial_rule_matching_to_uri' => $parameters['dial-rule-matching-to-uri'],
            'enabled' => Deserialize::bool($parameters['enabled']),
            'dial_rule_matching_from_uri' => $parameters['dial-rule-matching-from-uri'],
            'dial_rule_matching_day_of_week' => $parameters['dial-rule-matching-day-of-week'],
            'dial_rule_matching_start_date' => $parameters['dial-rule-matching-start-date'],
            'dial_rule_matching_end_date' => $parameters['dial-rule-matching-end-date'],
            'dial_rule_matching_start_time' => $parameters['dial-rule-matching-start-time'],
            'dial_rule_matching_end_time' => $parameters['dial-rule-matching-end-time'],
            'dial_rule_application' => DialRuleApplication::from($parameters['dial-rule-application']),
            'dial_rule_parameter' => $parameters['dial-rule-parameter'],
            'dial_rule_translation_destination_scheme' => $parameters['dial-rule-translation-destination-scheme'],
            'dial_rule_translation_destination_user' => $parameters['dial-rule-translation-destination-user'],
            'dial_rule_translation_destination_host' => $parameters['dial-rule-translation-destination-host'],
            'dial_rule_translation_source_name' => $parameters['dial-rule-translation-source-name'],
            'dial_rule_translation_source_scheme' => $parameters['dial-rule-translation-source-scheme'],
            'dial_rule_translation_source_user' => $parameters['dial-rule-translation-source-user'],
            'dial_rule_translation_source_host' => $parameters['dial-rule-translation-source-host'],
            'dial_rule_description' => $parameters['dial-rule-description'],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[DialRuleResource ' . \implode(' ', $context) . ']';
    }
}
