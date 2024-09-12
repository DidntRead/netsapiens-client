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
        $response = $this->client->request('POST', '', [
            'object' => 'cdr2',
            'action' => 'read',
            'id' => $this->getId(),
            'start_date' => Carbon::now()->subHours(24)->toIso8601ZuluString(),
            'end_date' => Carbon::now()->toIso8601ZuluString(),
        ]);
        $data = json_decode($response->getBody(), true);

        return new CallLogResource($this->client, $data[0]['CdrR']);
    }
}
