<?php

namespace Didntread\NetSapiens\Context;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\CallLogV2Resource;

class CallLogV2Context extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function fetch(): ?CallLogV2Resource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/cdrs", [
            'start_date' => Carbon::now()->subHours(24)->toIso8601ZuluString(),
            'end_date' => Carbon::now()->toIso8601ZuluString(),
        ]);
        $data = json_decode($response->getBody(), true);
        $cdr = array_filter($data, fn ($item) => $item['id'] === $this->getId());

        if (count($cdr) === 0) {
            return null;
        }

        return new CallLogV2Resource($this->client, reset($cdr));
    }
}
