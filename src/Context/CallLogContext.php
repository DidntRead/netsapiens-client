<?php

namespace Didntread\NetSapiens\Context;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\CallLogResource;

class CallLogContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): CallLogResource
    {
        $response = $this->client->request('POST', '/', [
            'object' => 'cdr2',
            'action' => 'read',
            'id' => $this->getId(),
            'start_date' => Carbon::createFromTimestamp(0)->toIso8601String(),
            'end_date' => Carbon::createFromTimestamp(PHP_INT_MAX)->toIso8601String(),
        ]);
        $data = json_decode($response->getBody(), true);

        return new CallLogResource($this->client, $data[0]['CdrR']);
    }
}
