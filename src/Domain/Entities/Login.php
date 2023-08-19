<?php

namespace src\Domain\Entities;
class Login
{
    public $uuid;
    public $username;
    public $password;
    public $salt;
    public $md5;
    public $sha1;
    public $sha256;

    public function __construct($uuid, $username, $password, $salt, $md5, $sha1, $sha256)
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->md5 = $md5;
        $this->sha1 = $sha1;
        $this->sha256 = $sha256;
    }
}