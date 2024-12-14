<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;

class DeviceResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'id' => $parameters['device'],
            'domain' => $parameters['domain'],
            'user' => $parameters['user'],
        ];

        $this->properties = [
            'device' => $parameters['device'],
            'user' => $parameters['user'],
            'domain' => $parameters['domain'],
            'device_sip_registration_uri' => $parameters['device-sip-registration-uri'],
            'device_sip_registration_state' => $parameters['device-sip-registration-state'],
            'device_sip_registration_password' => $parameters['device-sip-registration-password'],
            'auto_answer_enabled' => Deserialize::bool($parameters['auto-answer-enabled']),
            'caller_id_number_emergency' => $parameters['caller-id-number-emergency'],
            'core_server' => $parameters['core-server'],
            'device_force_notify_new_voicemails_enabled' => Deserialize::bool($parameters['device-force-notify-new-voicemails-enabled']),
            'device_level_call_recording_enabled' => Deserialize::bool($parameters['device-level-call-recording-enabled']),
            'device_push_enabled' => Deserialize::bool($parameters['device-push-enabled']),
            'device_sip_allowed_user_agent' => $parameters['device-sip-allowed-user-agent'],
            'device_sip_latency_seconds_average' => $parameters['device-sip-latency-seconds-average'],
            'device_sip_latency_seconds_current' => $parameters['device-sip-latency-seconds-current'],
            'device_sip_nat_traversal' => $parameters['device-sip-nat-traversal'],
            'device_sip_no_to_tag_in_cancel' => Deserialize::bool($parameters['device-sip-no-to-tag-in-cancel']),
            'device_sip_registration_contact' => $parameters['device-sip-registration-contact'],
            'device_sip_registration_datetime' => Carbon::parse($parameters['device-sip-registration-datetime']),
            'device_sip_registration_expires_datetime' => Carbon::parse($parameters['device-sip-registration-expires-datetime']),
            'device_sip_registration_expiry_seconds' => $parameters['device-sip-registration-expiry-seconds'],
            'device_sip_registration_ignore_for_presence_calculation' => Deserialize::bool($parameters['device-sip-registration-ignore-for-presence-calculation']),
            'device_sip_registration_ignore_report_enabled' => Deserialize::bool($parameters['device-sip-registration-ignore-report-enabled']),
            'device_sip_registration_ip_address' => $parameters['device-sip-registration-ip-address'],
            'device_sip_registration_user_agent' => $parameters['device-sip-registration-user-agent'],
            'device_srtp_enabled' => Deserialize::bool($parameters['device-srtp-enabled']),
            'emergency_address_id' => $parameters['emergency-address-id'],
            'error_reading_from_endpoint_module' => Deserialize::bool($parameters['error-reading-from-endpoint-module']),
            'login_username' => $parameters['login-username'],
            'name_full_name' => $parameters['name-full-name'],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[DeviceResource ' . \implode(' ', $context) . ']';
    }
}
