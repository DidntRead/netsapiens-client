<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Data\AnswerRules\AnswerRules;

class Deserialize
{
    public static function bool(string $value): bool
    {
        return $value === 'yes';
    }

    public static function answer_rules(array $value): AnswerRules
    {
        return AnswerRules::deserialize($value);
    }
}
