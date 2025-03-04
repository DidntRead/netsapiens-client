<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\DomainContext;
use Didntread\NetSapiens\Enum\DomainType;

/**
 * @property string $name
 * @property bool $backup_ok
 * @property string $status
 * @property string $address_location_description
 * @property string $device_provisioning_redundancy_group
 * @property int $device_provisioning_core_server_tcp_port
 * @property int $device_provisioning_core_server_tls_port
 * @property string $device_provisioning_core_server_postfix_fqdn
 * @property string $device_provisioning_core_server_api_fqdn
 */
class ProvisionServerResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = ['id' => $parameters['name']];

        $this->properties = [
            'name' => $parameters['name'],
            'backup_ok' => Deserialize::bool($parameters['backup_ok']),
            'status' => $parameters['status'],
            'address_location_description' => $parameters['address-location-description'],
            'device_provisioning_redundancy_group' => $parameters['device-provisioning-redundancy-group'],
            'device_provisioning_core_server_tcp_port' => $parameters['device-provisioning-core-server-tcp-port'],
            'device_provisioning_core_server_tls_port' => $parameters['device-provisioning-core-server-tls-port'],
            'device_provisioning_core_server_postfix_fqdn' => $parameters['device-provisioning-core-server-postfix-fqdn'],
            'device_provisioning_core_server_api_fqdn' => $parameters['device-provisioning-core-server-api-fqdn'],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[ProvisionServerResource ' . \implode(' ', $context) . ']';
    }
}
