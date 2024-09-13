<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\MOHResource;
use Didntread\NetSapiens\Data\VoicemailGreetingResource;

class MusicOnHoldContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, ?string $user, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
        if ($user) {
            $this->meta['user'] = $user;
        }
    }

    private function buildUri(): string
    {
        if (isset($this->meta['user'])) {
            return "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/moh/{$this->meta['id']}";
        } else {
            return "v2/domains/{$this->meta['domain']}/moh/{$this->meta['id']}";
        }
    }

    public function fetch(): MOHResource
    {
        $response = $this->client->request('GET', $this->buildUri());
        $data = json_decode($response->getBody(), true);

        return new MOHResource($this->client, $data);
    }

    public function updateTTS(string $script, array $options): void
    {
        if (!isset($options['script'])) {
            $options['script'] = $script;
        }

        $this->client->request('PUT', $this->buildUri(), [], $options);
    }

    public function updateFile($file, array $options): void
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

        $this->client->multipartRequest('PUT', $this->buildUri(), [], $multipart);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', $this->buildUri());
    }
}
