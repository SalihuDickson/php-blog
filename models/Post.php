<?php

namespace app\models;

use app\Database;

class Post
{
    public ?int $id;
    public ?string $title;
    public ?string $desc;
    public ?string $img;
    public ?string $cat;
    public Database $db;
    public static bool $instanciated;

    public function __construct(array $postData)
    {
        $this->id = $postData["id"];
        $this->title = $postData["title"];
        $this->desc = $postData["desc"];
        $this->img = $postData["img"];
        $this->db = Database::$db;
        self::$instanciated = true;
    }

    public function updated(array $postData)
    {

    }
}