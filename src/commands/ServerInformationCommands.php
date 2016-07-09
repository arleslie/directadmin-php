<?php

namespace arleslie\DirectAdmin\commands;

trait ServerInformation
{
    public function serverStats()
    {
        return $this->prase($this->guzzle->get('/CMD_API_ADMIN_STATS'));
    }
}
