<?php

namespace Didntread\NetSapiens\Data\AnswerRules;

class ForwardFeature extends Feature
{
    private $parameters;

    public function __construct(bool $enabled, array $parameters)
    {
        parent::__construct($enabled);
        $this->parameters = $parameters;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public static function deserialize(array $data): static
    {
        return new static($data['enabled'] === 'yes', $data['parameters']);
    }
}
