<?php

namespace src\Domain\Entities;

use src\Domain\BaseEntity;

class Login extends BaseEntity
{
    private $uuid;
    private $username;
    private $password;
    private $salt;
    private $md5;
    private $sha1;
    private $sha256;

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
    public function toJson()
    {
        $data = [
            'uuid' => $this->uuid,
            'username' => $this->username,
            'password' => $this->password,
            'salt' => $this->salt,
            'md5' => $this->md5,
            'sha1' => $this->sha1,
            'sha256' => $this->sha256,
        ];

        return json_encode($data);
    }
}