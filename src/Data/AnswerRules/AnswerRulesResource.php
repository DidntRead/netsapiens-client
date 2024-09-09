<?php

namespace Didntread\NetSapiens\Data\AnswerRules;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\Deserialize;
use Didntread\NetSapiens\Data\JsonResource;
use Didntread\NetSapiens\Exceptions\NetSapiensException;

/**
 * @property AnswerRules $rule Parsed answer rule data.
 * @property string $time-frame The time frame for which the rule applies.
 * @property string $domain The domain associated with the rule.
 * @property string $user The user to whom the rule applies.
 * @property bool $is-active Whether the rule is active.
 * @property int $ordinal-priority The priority level of the rule.
 * @property bool $enabled Whether the rule is enabled (processed by Deserialize::bool()).
 * @property mixed $new_time_frame_data Additional time frame data (if any).
 * @property array $simultaneous_ring Simultaneous ring rule settings.
 * @property array $do_not_disturb Do not disturb rule settings.
 * @property array $forward_always Forward always rule settings.
 * @property array $forward_on_active Forward on active rule settings.
 * @property array $forward_on_busy Forward on busy rule settings.
 * @property array $forward_no_answer Forward no answer rule settings.
 * @property array $forward_when_unregistered Forward when unregistered rule settings.
 * @property array $forward_on_dnd Forward on do not disturb rule settings.
 * @property array $forward_on_spam_call Forward on spam call rule settings.
 * @property array $call_screening Call screening rule settings.
 * @property array $phone_numbers_to_allow Phone numbers allowed by the rule.
 * @property array $phone_numbers_to_reject Phone numbers rejected by the rule.
 */
class AnswerRulesResource extends JsonResource
{
    protected AnswerRules $_rules;

    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);

        $this->meta = [
            'id' => $parameters['time-frame'],
            'domain' => $parameters['domain'],
        ];

        $this->properties = [
            'time_frame' => $parameters['time-frame'],
            'domain' => $parameters['domain'],
            'user' => $parameters['user'],
            'is_active' => $parameters['is-active'],
            'ordinal_priority' => $parameters['ordinal-priority'],
            'enabled' => Deserialize::bool($parameters['enabled']),
            'new_time_frame_data' => $parameters['new_time_frame_data'],
            'simultaneous_ring' => $parameters['simultaneous-ring'] ?? [],
            'do_not_disturb' => $parameters['do-not-disturb'] ?? [],
            'forward_always' => $parameters['forward-always'] ?? [],
            'forward_on_active' => $parameters['forward-on-active'] ?? [],
            'forward_on_busy' => $parameters['forward-on-busy'] ?? [],
            'forward_no_answer' => $parameters['forward-no-answer'] ?? [],
            'forward_when_unregistered' => $parameters['forward-when-unregistered'] ?? [],
            'forward_on_dnd' => $parameters['forward-on-dnd'] ?? [],
            'forward_on_spam_call' => $parameters['forward-on-spam-call'] ?? [],
            'call_screening' => $parameters['call-screening'] ?? [],
            'phone_numbers_to_allow' => $parameters['phone-numbers-to-allow'] ?? [],
            'phone_numbers_to_reject' => $parameters['phone-numbers-to-reject'] ?? [],
        ];

        $this->_rules = Deserialize::answer_rules($parameters);
    }

    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if ($name === 'rules') {
            return $this->_rules;
        }

        throw new NetSapiensException('Unknown property: ' . $name);
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[AnswerRulesResource ' . \implode(' ', $context) . ']';
    }
}
