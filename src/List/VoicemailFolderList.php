<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;

class VoicemailFolderList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $user)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['user'] = $user;
    }

    public function saved(): VoicemailList
    {
        return new VoicemailList($this->client, $this->meta['domain'], $this->meta['user'], 'saved');
    }

    public function new(): VoicemailList
    {
        return new VoicemailList($this->client, $this->meta['domain'], $this->meta['user'], 'new');
    }

    public function deleted(): VoicemailList
    {
        return new VoicemailList($this->client, $this->meta['domain'], $this->meta['user'], 'trash');
    }
}
