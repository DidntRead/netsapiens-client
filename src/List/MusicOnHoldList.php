<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\MusicOnHoldContext;
use Didntread\NetSapiens\Context\VoicemailGreetingContext;
use Didntread\NetSapiens\Data\MOHResource;
use Didntread\NetSapiens\Data\VoicemailGreetingResource;

class MusicOnHoldList extends ResourceList
{
    public function __construct(Client $client, string $domain, ?string $user)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    private function buildUri(): string
    {
        if (isset($this->meta['user'])) {
            return "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/moh";
        } else {
            return "v2/domains/{$this->meta['domain']}/moh";
        }
    }

    /**
     * Retrieve a list of music on hold files.
     * @return array<MOHResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', $this->buildUri());
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new MOHResource($this->client, $item);
        }, $data);
    }

    public function createTTS(string $script, array $options = []): void
    {
        if (!isset($options['script'])) {
            $options['script'] = $script;
        }

        $this->client->request('POST', $this->buildUri(), [], $options);
    }

    public function createFile($file, array $options = []): void
    {
        $multipart = [
            [
                'name' => 'File',
                'contents' => $file,
                'filename' => $options['filename'] ?? 'uploaded_file',
            ],
        ];

        foreach ($options as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        $this->client->multipartRequest('POST', $this->buildUri(), [], $multipart);
    }

    public function fetch($id): MOHResource
    {
        return (new MusicOnHoldContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->fetch();
    }

    public function updateTTS($id, string $script, array $options): void
    {
        (new MusicOnHoldContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->updateTTS($script, $options);
    }

    public function updateFile($id, $file, array $options): void
    {
        (new MusicOnHoldContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->updateFile($file, $options);
    }

    public function delete($id): void
    {
        (new MusicOnHoldContext($this->client, $this->meta['domain'], $this->meta['user'] ?? null, $id))->delete();
    }
}
