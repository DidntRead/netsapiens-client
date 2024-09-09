<?php

namespace App\Helpers\Phones\AnswerRules;

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
}
