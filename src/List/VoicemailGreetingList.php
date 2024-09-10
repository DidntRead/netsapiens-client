<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\VoicemailGreetingContext;
use Didntread\NetSapiens\Data\VoicemailGreetingResource;

class VoicemailGreetingList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $user)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    /**
     * Retrieve a list of voicemail greetings.
     * @return array<VoicemailGreetingResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new VoicemailGreetingResource($this->client, $item);
        }, $data);
    }

    public function createTTS(string $script, array $options = []): void
    {
        if (!isset($options['script'])) {
            $options['script'] = $script;
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings", [
            'json' => $options,
        ]);
    }

    public function createFile($file, array $options = []): void
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

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/users/{$this->meta['user']}/greetings", [
            'multipart' => $multipart,
        ]);
    }

    public function fetch($id): VoicemailGreetingResource
    {
        return (new VoicemailGreetingContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->fetch();
    }

    public function updateTTS($id, string $script, array $options): void
    {
        (new VoicemailGreetingContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->updateTTS($script, $options);
    }

    public function updateFile($id, $file, array $options): void
    {
        (new VoicemailGreetingContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->updateFile($file, $options);
    }

    public function delete($id): void
    {
        (new VoicemailGreetingContext($this->client, $this->meta['domain'], $this->meta['user'], $id))->delete();
    }
}
