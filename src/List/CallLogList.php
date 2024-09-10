<?php

namespace Didntread\NetSapiens\List;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\CallLogContext;
use Didntread\NetSapiens\Data\CallLogResource;
use Didntread\NetSapiens\Data\CallRecordingResource;
use Didntread\NetSapiens\Enum\CallLogType;

class CallLogList extends ResourceList
{
    public function __construct(Client $client, string $domain)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
    }

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
            return new CallLogResource($this->client, $item);
        }, $data);
    }

    public function listRecordings(string $call_id): array
    {
        $resp = $this->client->request('POST', '', [
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

    public function fetch(string $id): CallLogResource
    {
        return (new CallLogContext($this->client, $this->meta['domain'], $id))->fetch();
    }
}