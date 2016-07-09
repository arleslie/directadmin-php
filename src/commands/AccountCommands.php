<?php

namespace arleslie\DirectAdmin\commands;

trait AccountCommands
{
    public function createAdminAccount($username, $email, $password, $notify = false)
    {
        return $this->parse($this->guzzle->post('/CMD_API_ACCOUNT_ADMIN', [
            'action' => 'create',
            'username' => $username,
            'email' => $email,
            'passwd' => $password,
            'passwd2' => $password,
            'notify' => ($notify ? 'yes' : 'no')
        ]));
    }

    public function createResellerAccount($username, $email, $password, $domain, $ip = 'shared', $notify = false)
    {
        return $this->parse($this->guzzle->post('/CMD_API_ACCOUNT_RESELLER', [
            'action' => 'create',
            'add' => 'Submit',
            'username' => $username,
            'email' => $email,
            'passwd' => $password,
            'passwd2' => $password,
            'domain' => $domain,
            'ip' => $ip,
            'notify' => ($notify ? 'yes' : 'no')
        ]));
    }

    public function createUserAccount($username, $email, $password, $domain, $package, $ip, $notify = false)
    {
        return $this->parse($this->guzzle->post('/CMD_API_ACCOUNT_USER', [
            'action' => 'create',
            'add' => 'Submit',
            'username' => $username,
            'email' => $email,
            'passwd' => $password,
            'passwd2' => $password,
            'domain' => $domain,
            'package' => $package,
            'ip' => $ip,
            'notify' => ($notify ? 'yes' : 'no')
        ]));
    }

    public function deleteAccount($users = [])
    {
        if (!is_array($users)) {
            $users = [$users];
        }

        $users = array_flip(array_map(function ($key) {
            return "select{$key}";
        }, array_flip($users)));

        return $this->parse($this->guzzle->post('/CMD_API_SELECT_USERS', [
            'confirmed' => 'Confirm',
            'delete' => 'yes'
        ] + $users));
    }

    public function suspendAccount($users = [])
    {
        if (!is_array($users)) {
            $users = [$users];
        }

        $users = array_flip(array_map(function ($key) {
            return "select{$key}";
        }, array_flip($users)));

        return $this->parse($this->guzzle->post('/CMD_API_SELECT_USERS', [
            'location' => 'CMD_RESELLER_SHOW',
            'suspend' => 'suspend'
        ] + $users));
    }

    public function unsuspendAccount($users = [])
    {
        if (!is_array($users)) {
            $users = [$users];
        }

        $users = array_flip(array_map(function ($key) {
            return "select{$key}";
        }, array_flip($users)));

        return $this->parse($this->guzzle->post('/CMD_API_SELECT_USERS', [
            'location' => 'CMD_RESELLER_SHOW',
            'suspend' => 'unsuspend'
        ] + $users));
    }

    public function listUserAccounts($reseller = false)
    {
        return $this->parse($this->guzzle->post('/CMD_API_SHOW_USERS', [
            'reseller' => $reseller
        ]));
    }

    public function listResellerAccounts()
    {
        return $this->parse($this->guzzle->post('/CMD_API_SHOW_RESELLERS'));
    }

    public function listAdminAccounts()
    {
        return $this->parse($this->guzzle->post('/CMD_API_SHOW_ADMINS'));
    }

    public function listAllAccounts()
    {
        return $this->parse($this->guzzle->post('/CMD_API_SHOW_ALL_USERS'));
    }
}
