<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\SubscriptionResource;
use Didntread\NetSapiens\Data\VoicemailResource;

class VoicemailContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $user, string $folder, string $filename)
    {
        parent::__construct($client, $filename);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
        $this->meta['folder'] = $folder;
    }

    public function fetch(): VoicemailResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/voicemails/{$this->meta['folder']}/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new VoicemailResource($this->client, $data);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/voicemails/{$this->meta['folder']}/{$this->meta['id']}");
    }

    public function save(): void
    {
        $this->client->request('PATCH', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/voicemails/{$this->meta['folder']}/{$this->meta['id']}/save");
    }

    public function forward(int $extension): void
    {
        $this->client->request('PATCH', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/voicemails/{$this->meta['folder']}/{$this->meta['id']}/forward", [
            'json' => [
                'voicemail-forward-new-destination' => $extension,
            ],
        ]);
    }
}
