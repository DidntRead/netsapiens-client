<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\DeviceType;
use Didntread\NetSapiens\Enum\PhoneBrand;

/**
 * @property bool $device_models_visible_in_portal
 * @property PhoneBrand $device_models_brand
 * @property string $device_models_brand_and_model
 * @property DeviceType $device_models_type
 * @property string $device_models_config_format
 */
class PhoneModelResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = ['id' => $parameters['device-models-brand-and-model']];

        $this->properties = [
            'device_models_visible_in_portal' => Deserialize::bool($parameters['device-models-visible-in-portal']),
            'device_models_brand' => PhoneBrand::tryFrom($parameters['device-models-brand']),
            'device_models_brand_and_model' => $parameters['device-models-brand-and-model'],
            'device_models_type' => DeviceType::tryFrom($parameters['device-models-type']),
            'device_models_config_format' => $parameters['device-models-config-format'],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[PhoneModelResource ' . \implode(' ', $context) . ']';
    }
}
