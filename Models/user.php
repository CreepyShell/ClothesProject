<?php

declare(strict_types=1);
class User
{
    public int $id;
    public string $email;
    public string $password;

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
