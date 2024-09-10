<?php

namespace Didntread\NetSapiens\Exceptions;

class HttpException extends NetSapiensException
{
    public function __construct(string $method, string $uri, array $data, int $code)
    {
        $message = "HTTP request failed: {$method} {$uri} with code {$code} and data: " . json_encode($data);
        parent::__construct($message, $code, null);
    }
}
