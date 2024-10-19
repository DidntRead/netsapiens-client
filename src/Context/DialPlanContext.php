<?php

namespace Didntread\NetSapiens\Context;

use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRules;
use Didntread\NetSapiens\Data\AnswerRules\AnswerRulesResource;
use Didntread\NetSapiens\List\DialRulesList;

class DialPlanContext extends ResourceContext
{
    public function __construct(Client $client, string $domain, string $id)
    {
        parent::__construct($client, $id);
        $this->meta['domain'] = $domain;
    }

    public function dial_rule(string $id): DialRulesContext
    {
        return new DialRulesContext($this->client, $this->meta['domain'], $this->meta['id'], $id);
    }

    public function dial_rules(): DialRulesList
    {
        return new DialRulesList($this->client, $this->meta['domain'], $this->meta['id']);
    }
}
