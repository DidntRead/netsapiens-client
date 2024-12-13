<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;

/**
 * Class PhoneResource
 *
 * This class contains properties related to device provisioning and other associated parameters.
 *
 * @property string|null $dir_inc Directory include parameter.
 * @property string|null $domain Domain name.
 * @property string|null $notes Notes related to the device or configuration.
 * @property string|null $device_provisioning_mac_address MAC address used for device provisioning.
 * @property string|null $device_provisioning_registration_core_server Registration core server for device provisioning.
 * @property string|null $reseller Reseller information.
 * @property string|null $user_presence_status User presence status.
 * @property string|null $device_models_brand_and_model Brand and model of the device.
 * @property string|null $device_provisioning_sip_uri_1 First SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_2 Second SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_3 Third SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_4 Fourth SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_5 Fifth SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_6 Sixth SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_7 Seventh SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_uri_8 Eighth SIP URI for device provisioning.
 * @property string|null $device_provisioning_sip_transport_protocol SIP transport protocol for device provisioning.
 * @property string|null $device_models_overrides_blob Overrides blob for device models.
 * @property string|null $device_provisioning_username Username for device provisioning.
 * @property string|null $device_provisioning_password Password for device provisioning.
 * @property Carbon|null $device_provisioning_last_retrieved_datetime Last retrieved datetime for device provisioning.
 * @property Carbon|null $created_datetime The datetime when the entity was created.
 * @property string|null $global_one_time_pass Global one-time pass.
 * @property Carbon|null $device_sip_registration_expires_datetime Expiry datetime for SIP registration.
 * @property string|null $device_sip_registration_state State of the SIP registration.
 * @property Carbon|null $last_modified_datetime The datetime when the entity was last modified.
 */
class PhoneResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'id' => $parameters['mac'],
            'domain' => $parameters['domain'],
        ];

        $this->properties = [
            'mac' => $parameters['mac'],
            'dir_inc' => $parameters['dir_inc'],
            'domain' => $parameters['domain'],
            'notes' => $parameters['notes'],
            'device_provisioning_mac_address' => $parameters['device-provisioning-mac-address'],
            'device_provisioning_registration_core_server' => $parameters['device-provisioning-registration-core-server'],
            'reseller' => $parameters['reseller'],
            'user_presence_status' => $parameters['user-presence-status'],
            'device_models_brand_and_model' => $parameters['device-models-brand-and-model'],
            'device_provisioning_sip_uri_1' => $parameters['device-provisioning-sip-uri-1'],
            'device_provisioning_sip_uri_2' => $parameters['device-provisioning-sip-uri-2'],
            'device_provisioning_sip_uri_3' => $parameters['device-provisioning-sip-uri-3'],
            'device_provisioning_sip_uri_4' => $parameters['device-provisioning-sip-uri-4'],
            'device_provisioning_sip_uri_5' => $parameters['device-provisioning-sip-uri-5'],
            'device_provisioning_sip_uri_6' => $parameters['device-provisioning-sip-uri-6'],
            'device_provisioning_sip_uri_7' => $parameters['device-provisioning-sip-uri-7'],
            'device_provisioning_sip_uri_8' => $parameters['device-provisioning-sip-uri-8'],
            'device_provisioning_sip_transport_protocol' => $parameters['device-provisioning-sip-transport-protocol'],
            'device_models_overrides_blob' => $parameters['device-models-overrides-blob'],
            'device_provisioning_username' => $parameters['device-provisioning-username'],
            'device_provisioning_password' => $parameters['device-provisioning-password'],
            'device_provisioning_last_retrieved_datetime' => Carbon::parse($parameters['device-provisioning-last-retrieved-datetime']),
            'created_datetime' => Carbon::parse($parameters['created-datetime']),
            'global_one_time_pass' => $parameters['global-one-time-pass'],
            'device_sip_registration_expires_datetime' => $parameters['device-sip-registration-expires-datetime'] ? Carbon::parse($parameters['device-sip-registration-expires-datetime']) : null,
            'device_sip_registration_state' => $parameters['device-sip-registration-state'],
            'last_modified_datetime' => $parameters['last-modified-datetime'] ? Carbon::parse($parameters['last-modified-datetime']) : null,
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[PhoneResource ' . \implode(' ', $context) . ']';
    }
}
