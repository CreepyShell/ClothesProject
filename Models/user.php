<?php

declare(strict_types=1);
class User
{
    public int $id;
    public string $email;
    public string $password;

    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
}
