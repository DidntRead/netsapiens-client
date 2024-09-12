<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;

/**
 * Properties for the call log and connection details.
 *
 * @property string $id The unique identifier for the call record.
 * @property string $domain The domain associated with the call.
 * @property string $reseller The reseller associated with the call.
 * @property string|null $call_account_code The account code for the call (nullable).
 * @property string $call_answer_datetime The datetime when the call was answered.
 * @property string $call_audio_codec The audio codec used in the call.
 * @property int $call_audio_relay_side_a_local_port The local port used for audio relay on side A.
 * @property int $call_audio_relay_side_a_packet_count The packet count for audio relay on side A.
 * @property string $call_audio_relay_side_a_remote_ip The remote IP for audio relay on side A.
 * @property int $call_audio_relay_side_b_packet_count The packet count for audio relay on side B.
 * @property string $call_audio_relay_side_b_remote_ip The remote IP for audio relay on side B.
 * @property string $call_batch_answer_datetime The datetime when the call batch was answered.
 * @property int $call_batch_on_hold_duration_seconds The duration the call was on hold during the batch.
 * @property string $call_batch_sequence_marker The sequence marker for the call batch.
 * @property string $call_batch_start_datetime The start datetime of the call batch.
 * @property int $call_batch_total_duration_seconds The total duration of the call batch in seconds.
 * @property int $call_direction The direction of the call (0 for incoming, 1 for outgoing).
 * @property string $call_disconnect_datetime The datetime when the call was disconnected.
 * @property string $call_disconnect_reason_text The reason text for the call disconnect.
 * @property string|null $call_disposition The disposition of the call (nullable).
 * @property string|null $call_disposition_direction The direction of the call disposition (nullable).
 * @property string|null $call_disposition_notes Any notes related to the call disposition (nullable).
 * @property string|null $call_disposition_reason The reason for the call disposition (nullable).
 * @property string|null $call_disposition_submitted_datetime The datetime when the call disposition was submitted (nullable).
 * @property string|null $call_fax_codec The fax codec used for the call, if applicable (nullable).
 * @property int|null $call_fax_relay_side_a_local_port The local port for fax relay on side A (nullable).
 * @property int|null $call_fax_relay_side_a_packet_count The packet count for fax relay on side A (nullable).
 * @property string|null $call_fax_relay_side_a_remote_ip The remote IP for fax relay on side A (nullable).
 * @property int|null $call_fax_relay_side_b_packet_count The packet count for fax relay on side B (nullable).
 * @property string|null $call_fax_relay_side_b_remote_ip The remote IP for fax relay on side B (nullable).
 * @property int $call_leg_ordinal_index The ordinal index of the call leg.
 * @property int $call_on_hold_duration_seconds The duration the call was on hold in seconds.
 * @property string $call_orig_call_id The original call ID for the call.
 * @property int $call_orig_caller_id The original caller's ID.
 * @property string|null $call_orig_department The department the call originated from (nullable).
 * @property string $call_orig_domain The domain the call originated from.
 * @property string $call_orig_from_host The host the call originated from.
 * @property string $call_orig_from_name The name of the caller on the original side.
 * @property string $call_orig_from_uri The URI of the caller on the original side.
 * @property int $call_orig_user The user ID of the caller on the original side.
 * @property int $call_orig_from_user The user ID of the caller on the original side.
 * @property string $call_orig_ip_address The IP address the call originated from.
 * @property string $call_orig_match_uri The match URI on the original side.
 * @property string $call_orig_pre_routing_uri The pre-routing URI for the original call.
 * @property string $call_orig_request_host The request host for the original call.
 * @property string $call_orig_request_uri The request URI for the original call.
 * @property int $call_orig_request_user The request user for the original call.
 * @property string $call_orig_reseller The reseller associated with the original call.
 * @property string|null $call_orig_site The site of the original call (nullable).
 * @property string $call_orig_to_host The destination host for the original call.
 * @property string $call_orig_to_uri The destination URI for the original call.
 * @property int $call_orig_to_user The destination user ID for the original call.
 * @property string $call_parent_call_id The parent call ID for the call.
 * @property string $call_parent_cdr_id The parent CDR ID for the call.
 * @property string $call_record_creation_datetime The datetime when the call record was created.
 * @property string $call_ringing_datetime The datetime when the call started ringing.
 * @property int $call_routing_class The routing class for the call.
 * @property string $call_routing_match_uri The routing match URI for the call.
 * @property string $call_server_mac_address The MAC address of the server handling the call.
 * @property string $call_start_datetime The datetime when the call started.
 * @property string $call_tag A tag associated with the call.
 * @property int $call_talking_duration_seconds The duration of the call talking time in seconds.
 * @property string $call_term_call_id The terminal call ID for the call.
 * @property int $call_term_caller_id The terminal caller's ID.
 * @property string|null $call_term_department The department associated with the terminal side of the call (nullable).
 * @property string $call_term_domain The domain of the terminal side of the call.
 * @property string $call_term_ip_address The IP address of the terminal side of the call.
 * @property string $call_term_match_uri The match URI for the terminal side of the call.
 * @property string $call_term_pre_routing_uri The pre-routing URI for the terminal side of the call.
 * @property string|null $call_term_reseller The reseller associated with the terminal side of the call (nullable).
 * @property string|null $call_term_site The site of the terminal side of the call (nullable).
 * @property string $call_term_to_uri The destination URI for the terminal side of the call.
 * @property int|null $call_term_user The user ID on the terminal side of the call (nullable).
 * @property string $call_through_action The action associated with the call routing.
 * @property string|null $call_through_call_id The call ID for the through-call (nullable).
 * @property string|null $call_through_caller_id The caller ID for the through-call (nullable).
 * @property string|null $call_through_department The department associated with the through-call (nullable).
 * @property string|null $call_through_domain The domain for the through-call (nullable).
 * @property string|null $call_through_reseller The reseller associated with the through-call (nullable).
 * @property string|null $call_through_site The site for the through-call (nullable).
 * @property string|null $call_through_uri The URI for the through-call (nullable).
 * @property int|null $call_through_user The user ID for the through-call (nullable).
 * @property int $call_total_duration_seconds The total duration of the call in seconds.
 * @property string|null $call_video_codec The codec used for video in the call (nullable).
 * @property int|null $call_video_relay_side_a_local_port The local port for video relay on side A (nullable).
 * @property int|null $call_video_relay_side_a_packet_count The packet count for video relay on side A (nullable).
 * @property string|null $call_video_relay_side_a_remote_ip The remote IP for video relay on side A (nullable).
 * @property int|null $call_video_relay_side_b_packet_count The packet count for video relay on side B (nullable).
 * @property string|null $call_video_relay_side_b_remote_ip The remote IP for video relay on side B (nullable).
 * @property string $core_server The core server handling the call.
 * @property int $hide_from_results Whether the call is hidden from the results (0 = false, 1 = true).
 * @property bool $is_trace_expected Whether trace is expected for the call.
 * @property string $prefilled_trace_api The API for the prefilled trace data.
 */
class CallLogV2Resource extends JsonResource
{
    public function __construct(Client $client, array $data)
    {
        parent::__construct($client);

        $this->meta = [
            'id' => $data['id'],
            'domain' => $data['domain'],
        ];

        $this->properties = [
            'id' => $data['id'],
            'domain' => $data['domain'],
            'reseller' => $data['reseller'],
            'call_account_code' => $data['call-account-code'],
            'call_answer_datetime' => $data['call-answer-datetime'],
            'call_audio_codec' => $data['call-audio-codec'],
            'call_audio_relay_side_a_local_port' => $data['call-audio-relay-side-a-local-port'],
            'call_audio_relay_side_a_packet_count' => $data['call-audio-relay-side-a-packet-count'],
            'call_audio_relay_side_a_remote_ip' => $data['call-audio-relay-side-a-remote-ip'],
            'call_audio_relay_side_b_packet_count' => $data['call-audio-relay-side-b-packet-count'],
            'call_audio_relay_side_b_remote_ip' => $data['call-audio-relay-side-b-remote-ip'],
            'call_batch_answer_datetime' => $data['call-batch-answer-datetime'],
            'call_batch_on_hold_duration_seconds' => $data['call-batch-on-hold-duration-seconds'],
            'call_batch_sequence_marker' => $data['call-batch-sequence-marker'],
            'call_batch_start_datetime' => $data['call-batch-start-datetime'],
            'call_batch_total_duration_seconds' => $data['call-batch-total-duration-seconds'],
            'call_direction' => $data['call-direction'],
            'call_disconnect_datetime' => $data['call-disconnect-datetime'],
            'call_disconnect_reason_text' => $data['call-disconnect-reason-text'],
            'call_disposition' => $data['call-disposition'],
            'call_disposition_direction' => $data['call-disposition-direction'],
            'call_disposition_notes' => $data['call-disposition-notes'],
            'call_disposition_reason' => $data['call-disposition-reason'],
            'call_disposition_submitted_datetime' => $data['call-disposition-submitted-datetime'],
            'call_fax_codec' => $data['call-fax-codec'],
            'call_fax_relay_side_a_local_port' => $data['call-fax-relay-side-a-local-port'],
            'call_fax_relay_side_a_packet_count' => $data['call-fax-relay-side-a-packet-count'],
            'call_fax_relay_side_a_remote_ip' => $data['call-fax-relay-side-a-remote-ip'],
            'call_fax_relay_side_b_packet_count' => $data['call-fax-relay-side-b-packet-count'],
            'call_fax_relay_side_b_remote_ip' => $data['call-fax-relay-side-b-remote-ip'],
            'call_leg_ordinal_index' => $data['call-leg-ordinal-index'],
            'call_on_hold_duration_seconds' => $data['call-on-hold-duration-seconds'],
            'call_orig_call_id' => $data['call-orig-call-id'],
            'call_orig_caller_id' => $data['call-orig-caller-id'],
            'call_orig_department' => $data['call-orig-department'],
            'call_orig_domain' => $data['call-orig-domain'],
            'call_orig_from_host' => $data['call-orig-from-host'],
            'call_orig_from_name' => $data['call-orig-from-name'],
            'call_orig_from_uri' => $data['call-orig-from-uri'],
            'call_orig_from_user' => $data['call-orig-from-user'],
            'call_orig_ip_address' => $data['call-orig-ip-address'],
            'call_orig_match_uri' => $data['call-orig-match-uri'],
            'call_orig_pre_routing_uri' => $data['call-orig-pre-routing-uri'],
            'call_orig_request_host' => $data['call-orig-request-host'],
            'call_orig_request_uri' => $data['call-orig-request-uri'],
            'call_orig_request_user' => $data['call-orig-request-user'],
            'call_orig_reseller' => $data['call-orig-reseller'],
            'call_orig_site' => $data['call-orig-site'],
            'call_orig_to_host' => $data['call-orig-to-host'],
            'call_orig_to_uri' => $data['call-orig-to-uri'],
            'call_orig_to_user' => $data['call-orig-to-user'],
            'call_orig_user' => $data['call-orig-user'],
            'call_parent_call_id' => $data['call-parent-call-id'],
            'call_parent_cdr_id' => $data['call-parent-cdr-id'],
            'call_record_creation_datetime' => $data['call-record-creation-datetime'],
            'call_ringing_datetime' => $data['call-ringing-datetime'],
            'call_routing_class' => $data['call-routing-class'],
            'call_routing_match_uri' => $data['call-routing-match-uri'],
            'call_server_mac_address' => $data['call-server-mac-address'],
            'call_start_datetime' => $data['call-start-datetime'],
            'call_tag' => $data['call-tag'],
            'call_talking_duration_seconds' => $data['call-talking-duration-seconds'],
            'call_term_call_id' => $data['call-term-call-id'],
            'call_term_caller_id' => $data['call-term-caller-id'],
            'call_term_department' => $data['call-term-department'],
            'call_term_domain' => $data['call-term-domain'],
            'call_term_ip_address' => $data['call-term-ip-address'],
            'call_term_match_uri' => $data['call-term-match-uri'],
            'call_term_pre_routing_uri' => $data['call-term-pre-reouting-uri'],
            'call_term_reseller' => $data['call-term-reseller'],
            'call_term_site' => $data['call-term-site'],
            'call_term_to_uri' => $data['call-term-to-uri'],
            'call_term_user' => $data['call-term-user'],
            'call_through_action' => $data['call-through-action'],
            'call_through_call_id' => $data['call-through-call-id'],
            'call_through_caller_id' => $data['call-through-caller-id'],
            'call_through_department' => $data['call-through-department'],
            'call_through_domain' => $data['call-through-domain'],
            'call_through_reseller' => $data['call-through-reseller'],
            'call_through_site' => $data['call-through-site'],
            'call_through_uri' => $data['call-through-uri'],
            'call_through_user' => $data['call-through-user'],
            'call_total_duration_seconds' => $data['call-total-duration-seconds'],
            'call_video_codec' => $data['call-video-codec'],
            'call_video_relay_side_a_local_port' => $data['call-video-relay-side-a-local-port'],
            'call_video_relay_side_a_packet_count' => $data['call-video-relay-side-a-packet-count'],
            'call_video_relay_side_a_remote_ip' => $data['call-video-relay-side-a-remote-ip'],
            'call_video_relay_side_b_packet_count' => $data['call-video-relay-side-b-packet-count'],
            'call_video_relay_side_b_remote_ip' => $data['call-video-relay-side-b-remote-ip'],
            'core_server' => $data['core-server'],
            'hide_from_results' => $data['hide-from-results'],
            'is_trace_expected' => $data['is-trace-expected'],
            'prefilled_trace_api' => $data['prefilled-trace-api'],
        ];
    }
}
