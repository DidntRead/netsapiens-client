<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\VoicemailGreetingResource;

class VoicemailGreetingContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $user, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    public function fetch(): VoicemailGreetingResource
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings/{$this->meta['id']}");
        $data = json_decode($response->getBody(), true);

        return new VoicemailGreetingResource($this->client, $data);
    }

    public function updateTTS(string $script, array $options): void
    {
        if (!isset($options['script'])) {
            $options['script'] = $script;
        }

        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings/{$this->meta['id']}", [
            'json' => $options,
        ]);
    }

    public function updateFile($file, array $options): void
    {
        if (!is_resource($file) || get_resource_type($file) !== 'stream') {
            throw new \InvalidArgumentException('The file must be a resource.');
        }

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

        $this->client->request('PUT', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings/{$this->meta['id']}", [
            'multipart' => $multipart,
        ]);
    }

    public function delete(): void
    {
        $this->client->request('DELETE', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings/{$this->meta['id']}");
    }
}
