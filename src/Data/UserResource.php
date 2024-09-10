<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\UserScope;

/**
 * Properties for the user configuration.
 *
 * @property string $domain The domain associated with the user.
 * @property string $user The user identifier.
 * @property string $name_first_name The user's first name.
 * @property string $name_last_name The user's last name.
 * @property string $login_username The username used for login.
 * @property UserScope $user_scope The scope of the user (determined by the UserScope enum).
 * @property string $department The user's department.
 * @property string $site The site associated with the user.
 * @property string $user_presence_status The user's current presence status.
 * @property string $time_zone The user's time zone.
 * @property string $area_code The area code for the user’s phone number.
 * @property string $caller_id_number The default caller ID number.
 * @property string $caller_id_name The default caller ID name.
 * @property string $dial_plan The dial plan associated with the user.
 * @property string $dial_policy The dial policy assigned to the user.
 * @property string $account_status The status of the user's account.
 * @property int $active_calls_total_current The current number of active calls for the user.
 * @property bool $call_recordings_hide_from_others_enabled Whether call recordings are hidden from other users.
 * @property bool $call_screening_enabled Whether call screening is enabled for the user.
 * @property string $caller_id_number_emergency The emergency caller ID number.
 * @property Carbon $created_at The date and time when the account was created.
 * @property bool $directory_annouce_in_dial_by_name_enabled Whether the directory announces in the dial-by-name feature.
 * @property string $directory_name_number_dtmf_mapping The DTMF mapping for the user's directory name.
 * @property bool $directory_name_visible_in_list_enabled Whether the user's name is visible in the directory list.
 * @property string $directory_override_order_duplicate_dtmf_mapping The override order for duplicate DTMF mappings in the directory.
 * @property string $email The user's email address.
 * @property bool $email_send_alert_data_storage_limit_reached_enabled Whether to send an alert when data storage limit is reached.
 * @property bool $email_send_alert_new_missed_call_enabled Whether to send an alert for new missed calls.
 * @property string $email_send_alert_new_voicemail_behavior Behavior when sending alerts for new voicemails.
 * @property string $email_send_alert_new_voicemail_cc_list_csv List of CC emails for voicemail alerts.
 * @property bool $email_send_alert_new_voicemail_enabled Whether to send alerts for new voicemails.
 * @property string $emergency_address_id The emergency address ID.
 * @property string $language_token The language token for the user.
 * @property Carbon $updated_at The last modification date and time.
 * @property int $limits_max_active_calls_total The maximum number of active calls allowed.
 * @property int $limits_max_data_storage_kilobytes The maximum data storage limit in kilobytes.
 * @property int $music_on_hold_comfort_message_repeat_interval_seconds Interval in seconds to repeat the comfort message during music on hold.
 * @property bool $music_on_hold_randomized_enabled Whether music on hold is randomized.
 * @property bool $phone_numbers_to_allow_enabled Whether allowed phone numbers are enabled.
 * @property bool $phone_numbers_to_reject_enabled Whether rejected phone numbers are enabled.
 * @property bool $privacy Whether privacy settings are enabled for the user.
 * @property bool $reject_anonymous_calls_enabled Whether the user rejects anonymous calls.
 * @property int $ring_no_answer_timeout_seconds The timeout period in seconds for no answer before the call is terminated.
 * @property string $service_code The service code for the user.
 * @property string $status_message The user's status message.
 * @property bool $voicemail_enabled Whether voicemail is enabled for the user.
 * @property int $voicemail_greeting_index The index of the voicemail greeting.
 * @property string $voicemail_login_pin The user's voicemail login PIN.
 * @property bool $voicemail_playback_announce_caller_id Whether the voicemail playback announces the caller ID.
 * @property bool $voicemail_playback_announce_date_time_received Whether voicemail playback announces the date and time received.
 * @property bool $voicemail_playback_sort_newest_to_oldest Whether voicemails are played back from newest to oldest.
 * @property bool $voicemail_receive_broadcast_enabled Whether voicemail broadcast is enabled for the user.
 * @property bool $voicemail_transcription_enabled Whether voicemail transcription is enabled.
 * @property bool $voicemail_user_control_enabled Whether the user can control voicemail features.
 */
class UserResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta['domain'] = $parameters['domain'];
        $this->meta['id'] = $parameters['user'];

        $this->properties = [
            'domain' => $parameters['domain'],
            'user' => $parameters['user'],
            'name_first_name' => $parameters['name-first-name'],
            'name_last_name' => $parameters['name-last-name'],
            'login_username' => $parameters['login-username'],
            'user_scope' => UserScope::from($parameters['user-scope']),
            'department' => $parameters['department'],
            'site' => $parameters['site'],
            'user_presence_status' => $parameters['user-presence-status'],
            'time_zone' => $parameters['time-zone'],
            'area_code' => $parameters['area-code'],
            'caller_id_number' => $parameters['caller-id-number'],
            'caller_id_name' => $parameters['caller-id-name'],
            'dial_plan' => $parameters['dial-plan'],
            'dial_policy' => $parameters['dial-policy'],
            'account_status' => $parameters['account-status'],
            'active_calls_total_current' => $parameters['active-calls-total-current'],
            'call_recordings_hide_from_others_enabled' => Deserialize::bool($parameters['call-recordings-hide-from-others-enabled']),
            'call_screening_enabled' => Deserialize::bool($parameters['call-screening-enabled']),
            'caller_id_number_emergency' => $parameters['caller-id-number-emergency'],
            'created_at' => Carbon::parse($parameters['created-datetime']),
            'directory_annouce_in_dial_by_name_enabled' => Deserialize::bool($parameters['directory-annouce-in-dial-by-name-enabled']),
            'directory_name_number_dtmf_mapping' => $parameters['directory-name-number-dtmf-mapping'],
            'directory_name_visible_in_list_enabled' => Deserialize::bool($parameters['directory-name-visible-in-list-enabled']),
            'directory_override_order_duplicate_dtmf_mapping' => $parameters['directory-override-order-duplicate-dtmf-mapping'],
            'email' => $parameters['email'],
            'email_send_alert_data_storage_limit_reached_enabled' => Deserialize::bool($parameters['email-send-alert-data-storage-limit-reached-enabled']),
            'email_send_alert_new_missed_call_enabled' => Deserialize::bool($parameters['email-send-alert-new-missed-call-enabled']),
            'email_send_alert_new_voicemail_behavior' => $parameters['email-send-alert-new-voicemail-behavior'],
            'email_send_alert_new_voicemail_cc_list_csv' => $parameters['email-send-alert-new-voicemail-cc-list-csv'],
            'email_send_alert_new_voicemail_enabled' => Deserialize::bool($parameters['email-send-alert-new-voicemail-enabled']),
            'emergency_address_id' => $parameters['emergency-address-id'],
            'language_token' => $parameters['language-token'],
            'updated_at' => Carbon::parse($parameters['last-modified-datetime']),
            'limits_max_active_calls_total' => $parameters['limits-max-active-calls-total'],
            'limits_max_data_storage_kilobytes' => $parameters['limits-max-data-storage-kilobytes'],
            'music_on_hold_comfort_message_repeat_interval_seconds' => $parameters['music-on-hold-comfort-message-repeat-interval-seconds'],
            'music_on_hold_randomized_enabled' => Deserialize::bool($parameters['music-on-hold-randomized-enabled']),
            'phone_numbers_to_allow_enabled' => Deserialize::bool($parameters['phone-numbers-to-allow-enabled']),
            'phone_numbers_to_reject_enabled' => Deserialize::bool($parameters['phone-numbers-to-reject-enabled']),
            'privacy' => Deserialize::bool($parameters['privacy']),
            'reject_anonymous_calls_enabled' => Deserialize::bool($parameters['reject-anonymous-calls-enabled']),
            'ring_no_answer_timeout_seconds' => $parameters['ring-no-answer-timeout-seconds'],
            'service_code' => $parameters['service-code'],
            'status_message' => $parameters['status-message'],
            'voicemail_enabled' => Deserialize::bool($parameters['voicemail-enabled']),
            'voicemail_greeting_index' => $parameters['voicemail-greeting-index'],
            'voicemail_login_pin' => $parameters['voicemail-login-pin'],
            'voicemail_playback_announce_caller_id' => Deserialize::bool($parameters['voicemail-playback-announce-caller-id']),
            'voicemail_playback_announce_date_time_received' => Deserialize::bool($parameters['voicemail-playback-announce-date-time-received']),
            'voicemail_playback_sort_newest_to_oldest' => Deserialize::bool($parameters['voicemail-playback-sort-newest-to-oldest']),
            'voicemail_receive_broadcast_enabled' => Deserialize::bool($parameters['voicemail-receive-broadcast-enabled']),
            'voicemail_transcription_enabled' => Deserialize::bool($parameters['voicemail-transcription-enabled']),
            'voicemail_user_control_enabled' => Deserialize::bool($parameters['voicemail-user-control-enabled']),
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[UserResource ' . \implode(' ', $context) . ']';
    }
}
