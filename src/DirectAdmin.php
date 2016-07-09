<?php

namespace arleslie\DirectAdmin;

use \Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as Guzzle;

class DirectAdmin
{
    use commands\AccountCommands,
        commands\IPCommands,
        commands\ServerInformationCommands;

    private $guzzle;

    public function __construct($host, $username, $password)
    {
        $this->guzzle = new Guzzle([
            'base_uri' => $host,
            'defaults' => [
                'auth' => [
                    $username,
                    $password
                ]
            ]
        ]);
    }

    private function parse($return)
    {
        return $return;
    }
}
