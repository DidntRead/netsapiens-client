<?php


use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Exceptions\ConfigurationException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function test_throws_no_username_and_password()
    {
        $this->expectException(ConfigurationException::class);
        $client = new Client();
    }

    public function test_throws_no_username()
    {
        $this->expectException(ConfigurationException::class);
        $client = new Client(null, null, null, 'password');
    }
}
