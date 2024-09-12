<?php

namespace Didntread\NetSapiens\List;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\CallLogV2Context;
use Didntread\NetSapiens\Data\CallLogResource;
use Didntread\NetSapiens\Data\CallLogV2Resource;
use Didntread\NetSapiens\Data\CallRecordingResource;
use Didntread\NetSapiens\Enum\CallLogType;

class CallLogV2List extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

    /**
     * Retrieve a list of call logs.
     * @param  Carbon  $start  - Start date
     * @param  Carbon  $end  - End date
     * @param  CallLogType|null  $type  - Call type
     * @return array<CallLogResource>
     */
    public function list(Carbon $start, Carbon $end, ?CallLogType $type): array
    {
        $query = [
            'datetime-start' => $start->toIso8601String(),
            'datetime-end' => $end->toIso8601String(),
        ];
        if ($type) {
            $query['type'] = $type->value;
        }
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/cdrs", $query);
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new CallLogV2Resource($this->client, $item);
        }, $data);
    }

    /**
     * Retrieve a list of call recordings.
     * @return array<CallRecordingResource>
     */
    public function listRecordings(string $call_id): array
    {
        $resp = $this->client->request('POST', '', [], [
            'object' => 'recording',
            'action' => 'read',
            'domain' => $this->meta['domain'],
            'callid' => $call_id,
        ]);

        $data = json_decode($resp->getBody()->getContents(), true);

        return array_map(function ($item) {
            return new CallRecordingResource($this->client, $item);
        }, $data);
    }

    public function fetch(string $id): ?CallLogV2Resource
    {
        return (new CallLogV2Context($this->client, $this->meta['domain'], $id))->fetch();
    }
}
