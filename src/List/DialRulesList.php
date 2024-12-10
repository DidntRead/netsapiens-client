<?php

namespace Didntread\NetSapiens\List;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Context\DialRulesContext;
use Didntread\NetSapiens\Data\DialRuleResource;

class DialRulesList extends ResourceList
{
    public function __construct(Client $client, string $domain, string $dial_plan)
    {
        parent::__construct($client);
        $this->meta['domain'] = $domain;
        $this->meta['dial_plan'] = $dial_plan;
    }

    /**
     * Retrieve a list of dial rules in this dial plan.
     * @return array<DialRuleResource>
     */
    public function list(): array
    {
        $response = $this->client->request('GET', "v2/domains/{$this->meta['domain']}/dialplans/{$this->meta['dial_plan']}/dialrules");
        $data = json_decode($response->getBody(), true);

        return array_map(function ($item) {
            return new DialRuleResource($this->client, $item);
        }, $data);
    }

    private function generate_id(array $options): string
    {
        $encoded_fields = [];

        if (isset($options['dail-rule-matching-to-uri'])) {
            $encoded_fields[] = $options['dail-rule-matching-to-uri'];
        }

        if (isset($options['dail-rule-matching-from-uri'])) {
            $encoded_fields[] = $options['dail-rule-matching-from-uri'];
        }

        if (isset($options['dial-rule-matching-day-of-week'])) {
            $encoded_fields[] = $options['dial-rule-matching-day-of-week'];
        }

        if (isset($options['dial-rule-matching-start-date'])) {
            $encoded_fields[] = $options['dial-rule-matching-start-date'];
        }

        if (isset($options['dial-rule-matching-end-date'])) {
            $encoded_fields[] = $options['dial-rule-matching-end-date'];
        }

        if (isset($options['dial-rule-matching-start-time'])) {
            $encoded_fields[] = $options['dial-rule-matching-start-time'];
        }

        if (isset($options['dial-rule-matching-end-time'])) {
            $encoded_fields[] = $options['dial-rule-matching-end-time'];
        }

        if (empty($encoded_fields)) {
            $string_to_encode = '*||*||*||*||*||*||*';
        } else {
            $string_to_encode = implode('||', $encoded_fields);
        }

        return base64_encode($string_to_encode);
    }

    public function create(string $matching_to_uri, string $translation_dest_user, array $options = []): string
    {
        if (!isset($options['dail-rule-matching-to-uri'])) {
            $options['dail-rule-matching-to-uri'] = $matching_to_uri;
        }

        if (!isset($options['dial-rule-translation-destination-user'])) {
            $options['dial-rule-translation-destination-user'] = $translation_dest_user;
        }

        if (!isset($options['dail-rule-matching-from-uri'])) {
            $options['dail-rule-matching-from-uri'] = '*';
        }

        $this->client->request('POST', "v2/domains/{$this->meta['domain']}/dialplans/{$this->meta['dial_plan']}/dialrules", [], $options);

        return $this->generate_id($options);
    }

    public function fetch(string $id): DialRuleResource
    {
        return (new DialRulesContext($this->client, $this->meta['domain'], $this->meta['dial_plan'], $id))->fetch();
    }

    public function update(string $id, array $options): void
    {
        (new DialRulesContext($this->client, $this->meta['domain'], $this->meta['dial_plan'], $id))->update($options);
    }

    public function delete(string $id): void
    {
        (new DialRulesContext($this->client, $this->meta['domain'], $this->meta['dial_plan'], $id))->delete();
    }
}
