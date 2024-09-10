<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;

/**
 * Properties for the call recording details.
 *
 * @property string $status The current status of the call recording (e.g., in-progress, completed).
 * @property string $call_id The unique identifier for the call associated with the recording.
 * @property Carbon $time_open The timestamp when the call recording started.
 * @property Carbon $time_close The timestamp when the call recording ended.
 * @property int $duration The duration of the call recording in seconds.
 * @property string $url The URL where the call recording can be accessed or downloaded.
 */
class CallRecordingResource extends JsonResource
{
    public function __construct(Client $client, array $data)
    {
        parent::__construct($client);

        $this->meta = [
            'id' => $data['call_id'],
        ];

        $this->properties = [
            'status' => $data['status'],
            'call_id' => $data['call_id'],
            'time_open' => Carbon::parse($data['time_open']),
            'time_close' => Carbon::parse($data['time_close']),
            'duration' => $data['duration'],
            'url' => $data['url'],
        ];
    }
}
