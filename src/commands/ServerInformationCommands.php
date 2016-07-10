<?php

namespace arleslie\DirectAdmin\commands;

trait ServerInformationCommands
{
    public function serverStats()
    {
        return $this->parse($this->guzzle->get('/CMD_API_ADMIN_STATS'));
    }
}
