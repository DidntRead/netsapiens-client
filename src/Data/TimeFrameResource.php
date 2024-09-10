<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\TimeFrameType;

/**
 * @property string $user The user associated with the properties.
 * @property string $domain The domain associated with the properties.
 * @property int $timeframe_id The ID of the timeframe.
 * @property string $timeframe_name The name of the timeframe.
 * @property string $timeframe_type The type of the timeframe, converted to a TimeFrameType instance.
 * @property array $timeframe_days-of-week-array An array of days of the week for the timeframe (optional, defaults to an empty array if not provided).
 */
class TimeFrameResource extends JsonResource
{
    public function __construct(Client $client, array $properties)
    {
        parent::__construct($client);
        $this->meta = [
            'id' => $properties['timeframe-id'],
            'domain' => $properties['domain'],
        ];

        if ($properties['user'] !== '*') {
            $this->meta['user'] = $properties['user'];
        }

        $this->properties = [
            'user' => $properties['user'],
            'domain' => $properties['domain'],
            'timeframe_id' => $properties['timeframe-id'],
            'timeframe_name' => $properties['timeframe-name'],
            'timeframe_type' => TimeFrameType::from($properties['timeframe-type']),
            'timeframe_days_of_week_array' => $properties['timeframe-days-of-week-array'] ?? [],
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }

        return '[TimeFrameResource ' . \implode(' ', $context) . ']';
    }
}
