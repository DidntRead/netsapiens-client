<?php

namespace Didntread\NetSapiens\Data\AnswerRules;

class Feature
{
    private bool $enabled;

    public function __construct(bool $enabled)
    {
        $this->enabled = $enabled;
    }

    public function isEnabled(): string
    {
        return $this->enabled ? 'yes' : 'no';
    }

    public static function deserialize(array $data): static
    {
        return new static($data['enabled'] === 'yes');
    }
}
