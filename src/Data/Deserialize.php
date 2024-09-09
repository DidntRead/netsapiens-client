<?php

namespace Didntread\NetSapiens\Data;

class Deserialize
{
    public static function bool(string $value): bool
    {
        return $value === 'yes';
    }
}
