<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\CallQueueType;

/**
 * Properties for the call queue configuration.
 *
 * @property string $domain The domain associated with the call queue.
 * @property string $callqueue The unique identifier for the call queue.
 * @property string $description A description of the call queue.
 * @property CallQueueType $callqueue_dispatch_type The dispatch type for the call queue (represented by an enum).
 * @property bool $callqueue_calculate_statistics Whether statistics calculation is enabled for the call queue.
 * @property int $active_queued_calls_total_current The current total number of active queued calls.
 * @property bool $callqueue_agent_auto_logout_after_missed Whether agents are automatically logged out after missing a call.
 * @property int $callqueue_agent_dispatch_timeout_seconds The timeout period for dispatching calls to agents, in seconds.
 * @property int $callqueue_count_agents_available The number of available agents for the call queue.
 * @property int $callqueue_count_agents_total The total number of agents assigned to the call queue.
 * @property bool $callqueue_debug Whether debugging is enabled for the call queue.
 * @property bool $callqueue_force_full_intro_playback Whether to force the full playback of the introductory message before connecting calls.
 * @property int $callqueue_max_callback_queueing_hours The maximum number of hours for callback queueing.
 * @property int $callqueue_max_current_callers_to_accept_new_callers The maximum number of current callers allowed before new callers are accepted.
 * @property int $callqueue_max_current_wait_to_accepts_new_callers_seconds The maximum waiting time in seconds before accepting new callers.
 * @property int $callqueue_max_wait_timeout_minutes The maximum waiting time for a call in the queue before timeout, in minutes.
 * @property bool $callqueue_require_available_agents_to_accept_new_callers Whether available agents are required to accept new callers.
 * @property int $callqueue_sim_ring_1st_round The number of agents simultaneously rung during the first round of call distribution.
 * @property int $callqueue_sim_ring_increment The increment in the number of agents rung during subsequent rounds of call distribution.
 * @property bool $callqueue_sms_enable Whether SMS notifications are enabled for the call queue.
 * @property string $callqueue_source_match The source match criteria for the call queue.
 * @property string $site The site associated with the call queue.
 * @property string $subscriber_group The subscriber group assigned to the call queue.
 */
class CallQueueResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'domain' => $parameters['domain'],
            'id' => $parameters['callqueue'],
        ];

        $this->properties = [
            'domain' => $parameters['domain'],
            'callqueue' => $parameters['callqueue'],
            'description' => $parameters['description'],
            'callqueue_dispatch_type' => CallQueueType::from($parameters['callqueue-dispatch-type']),
            'callqueue_calculate_statistics' => Deserialize::bool($parameters['callqueue-calculate-statistics']),
            'active_queued_calls_total_current' => $parameters['active-queued-calls-total-current'],
            'callqueue_agent_auto_logout_after_missed' => Deserialize::bool($parameters['callqueue-agent-auto-logout-after-missed']),
            'callqueue_agent_dispatch_timeout_seconds' => $parameters['callqueue-agent-dispatch-timeout-seconds'],
            'callqueue_count_agents_available' => $parameters['callqueue-count-agents-available'],
            'callqueue_count_agents_total' => $parameters['callqueue-count-agents-total'],
            'callqueue_debug' => Deserialize::bool($parameters['callqueue-debug']),
            'callqueue_force_full_intro_playback' => Deserialize::bool($parameters['callqueue-force-full-intro-playback']),
            'callqueue_max_callback_queueing_hours' => $parameters['callqueue-max-callback-queueing-hours'],
            'callqueue_max_current_callers_to_accept_new_callers' => $parameters['callqueue-max-current-callers-to-accept-new-callers'],
            'callqueue_max_current_wait_to_accepts_new_callers_seconds' => $parameters['callqueue-max-current-wait-to-accepts-new-callers-seconds'],
            'callqueue_max_wait_timeout_minutes' => $parameters['callqueue-max-wait-timeout-minutes'],
            'callqueue_require_available_agents_to_accept_new_callers' => Deserialize::bool($parameters['callqueue-require-available-agents-to-accept-new-callers']),
            'callqueue_sim_ring_1st_round' => $parameters['callqueue-sim-ring-1st-round'],
            'callqueue_sim_ring_increment' => $parameters['callqueue-sim-ring-increment'],
            'callqueue_sms_enable' => Deserialize::bool($parameters['callqueue-sms-enable']),
            'callqueue_source_match' => $parameters['callqueue-source-match'],
            'site' => $parameters['site'],
            'subscriber_group' => $parameters['subscriber-group'],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[CallQueueResource ' . \implode(' ', $context) . ']';
    }
}
