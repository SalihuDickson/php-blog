<?php

namespace app;

use \PDO;
use app\models\User;

class Database {
    public PDO $pdo;
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=blog", "salihu", "123456");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getPosts(array $params){
        $cat = $params["cat"] ?? null;
        $id = $params["id"] ?? null;

        if($cat){
            $statement = $this->pdo->prepare("SELECT * FROM posts WHERE cat=:cat");
            $statement->bindValue(":cat", $cat);
        }else if($id){
            $statement = $this->pdo->prepare("SELECT *, u.img AS userImage FROM users u JOIN posts p ON u.id = p.uid WHERE p.id=:id");
            $statement->bindValue(":id", $id);
        }
        else{
            $statement = $this->pdo->prepare("SELECT * FROM posts ORDER BY date DESC");
        }
        
        // get all posts and order by date"

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getPost


    public function createUser(array $user){
        $errors = [];
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $statement->bindValue(":email", $user["email"]);
        $statement->execute();
        $registeredUser = $statement->fetchAll();
        if(!empty($registeredUser)){
            $errors[] = "user already exists";
            return $errors;
        }

        $statement = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

        $statement->bindValue(":username", $user["username"]);
        $statement->bindValue(":email", $user["email"]);
        $statement->bindValue(":password", $user["password"]);
        $statement->execute();
    }

    public function loginUser(array $user){
        $errors = [];
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $statement->bindValue(":email", $user["email"]);
        $statement->execute();
        $registeredUser = $statement->fetchAll(PDO::FETCH_ASSOC)[0] ?? null;
        if (empty($registeredUser)) {
            $errors[] = "user not found";
            return $errors;
        }

        $verifyPassword = password_verify($user["password"], $registeredUser["password"]);
        if(!$verifyPassword){
            $errors[] = "incorrect password";
            return $errors;
        }

        $user = new User($registeredUser);
        print_r(User::$currentUser);
        return $user;
    }

    public function createPost(array $post){
        $statement = $this->pdo->prepare("INSERT INTO posts(title, img, blog.posts.desc, cat, uid) VALUES (:title, :image, :description, :cat, :uid)");
        $statement->bindValue(":title", $post["title"]);
        $statement->bindValue(":image", $post["image"]);
        $statement->bindValue(":description", $post["description"]);
        $statement->bindValue(":cat", $post["cat"]);
        $statement->bindValue(":uid", User::$currentUser->id);
        $statement->execute();
    }

    public function updatePost(array $post){
        $statement = $this->pdo->prepare("UPDATE posts SET title = :title, img = :image, blog.posts.desc = :description, cat = :cat WHERE id = :id");
        $statement->bindValue(":title", $post["title"]);
        $statement->bindValue(":image", $post["image"]);
        $statement->bindValue(":description", $post["description"]);
        $statement->bindValue(":cat", $post["cat"]);
        $statement->bindValue(":id", $post["id"]);
        $statement->execute();
    }

    public function deletePost($id){
        $statement = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}
