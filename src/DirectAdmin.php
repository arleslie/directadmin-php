<?php

namespace arleslie\DirectAdmin;

use GuzzleHttp\Client as Guzzle;
use arleslie\DirectAdmin\Exceptions\InvalidLoginException;

class DirectAdmin
{
    use commands\AccountCommands,
        commands\IPCommands,
        commands\PackageCommands,
        commands\ServerInformationCommands;

    private $guzzle;

    public function __construct(string $host, string $username, string $password)
    {
        $this->guzzle = new Guzzle([
            'base_uri' => $host,
            'auth' => [
                $username,
                $password
            ]
        ]);
    }

    private function parse(\GuzzleHttp\Psr7\Response $return)
    {
        $headers = $return->getHeaders();
        if (isset($headers['X-DirectAdmin']) && $headers['X-DirectAdmin'][0] === 'unauthorized') {
            throw new InvalidLoginException();
        }

        parse_str((string) $return->getBody(), $return);

        return $return;
    }
}
