<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\AgentAvailability;
use Didntread\NetSapiens\Enum\UserScope;

class AgentResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'id' => $parameters['callqueue-agent-id'],
            'callqueue' => $parameters['callqueue-id'],
            'domain' => $parameters['domain-id'],
        ];

        $this->properties = [
            'domain' => $parameters['domain'],
            'callqueue' => $parameters['callqueue'],
            'callqueue_agent_id' => $parameters['callqueue-agent-id'],
            'name_full_name' => $parameters['name-full-name'],
            'callqueue_agent_availability_type' => AgentAvailability::from($parameters['callqueue-agent-availability-type']),
            'callqueue_agent_availability_for_dispatch' => $parameters['callqueue-agent-availability-for-dispatch'],
            'callqueue_agent_wrap_up_allowance_seconds' => $parameters['callqueue-agent-wrap-up-allowance-seconds'],
            'callqueue_agent_has_registered_devices' => $parameters['callqueue-agent-has-registered-devices'],
            'callqueue_agent_dispatch_queue_priority_ordinal' => $parameters['callqueue-agent-dispatch-queue-priority-ordinal'],
            'sub_portal_status' => $parameters['sub-portal-status'],
            'active_calls_total_current' => $parameters['active-calls-total-current'],
            'agent_department' => $parameters['agent-department'],
            'auto_ans' => Deserialize::bool($parameters['auto-ans']),
            'callqueue_agent_answer_confirmation_enabled' => Deserialize::bool($parameters['callqueue-agent-answer-confirmation-enabled']),
            'callqueue_agent_entry_type' => $parameters['callqueue-agent-entry-type'],
            'callqueue_agent_max_concurrent_sms_conversations' => $parameters['callqueue-agent-max-concurrent-sms-conversations'],
            'last_callqueue_dispatch_datetime' => Carbon::parse($parameters['last-callqueue-dispatch-datetime']),
            'updated_at' => Carbon::parse($parameters['last-modified-datetime']),
            'limits_max_active_calls_total' => $parameters['limits-max-active-calls-total'],
            'login_username' => $parameters['login-username'],
            'name_first_name' => $parameters['name-first-name'],
            'name_last_name' => $parameters['name-last-name'],
            'ordinal_order' => $parameters['ordinal-order'],
            'sub_scope' => UserScope::from($parameters['sub-scope']),
            'sub_site' => $parameters['sub-site'],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[AgentResource ' . \implode(' ', $context) . ']';
    }
}
