<?php

namespace App\Helpers\Phones\AnswerRules;

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
}
