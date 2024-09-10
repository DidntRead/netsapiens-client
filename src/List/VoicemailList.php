<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\VoicemailContext;
use Didntread\NetSapiens\Data\VoicemailResource;

class VoicemailList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $user, string $folder)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
        $this->meta['folder'] = $folder;
    }

    /**
     * Retrieve a list of voicemails.
     * @return array<VoicemailResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/voicemails/{$this->meta['folder']}");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new VoicemailResource($this->client, $item);
        }, $data);
    }

    public function fetch(string $filename): VoicemailResource
    {
        return (new VoicemailContext($this->client, $this->meta['domain'], $this->meta['user'], $this->meta['folder'], $filename))->fetch();
    }

    public function delete(string $filename): void
    {
        (new VoicemailContext($this->client, $this->meta['domain'], $this->meta['user'], $this->meta['folder'], $filename))->delete();
    }

    public function save(string $filename): void
    {
        (new VoicemailContext($this->client, $this->meta['domain'], $this->meta['user'], $this->meta['folder'], $filename))->save();
    }

    public function forward(string $filename, int $extension): void
    {
        (new VoicemailContext($this->client, $this->meta['domain'], $this->meta['user'], $this->meta['folder'], $filename))->forward($extension);
    }
}
