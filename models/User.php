<?php

namespace app\models;

class User
{
    public int $id;
    public string $username;
    public string $email;
    public ?string $img;
    public static User $currentUser;
    public static bool $instanciated = false;

    public function __construct(array $userData)
    {
        $this->id = $userData["id"];
        $this->username = $userData["username"];
        $this->email = $userData["email"];
        $this->img = $userData["img"];
        self::$currentUser = $this;
        self::$instanciated = true;
    }
}