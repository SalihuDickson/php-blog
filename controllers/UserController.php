<?php

namespace app\controllers;

use app\Database;
use app\models\User;
use app\Router;

class UserController
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::$db;
    }

    public function signup(Router $router)
    {
        $router->renderView("user/signup");
    }

    public function login(Router $router)
    {
        $router->renderView("user/login");
    }

    public function createUser(Router $router)
    {
        $errors = [];
        $username = trim($_POST["username"]);
        $email = $_POST["email"];
        $password = trim($_POST["password"]);

        if (!$username) {
            $errors[] = "a username is required";
        }

        if (!$email) {
            $errors[] = "a email is required";
        }

        if (!$password) {
            $errors[] = "a password is required";
        }

        if (!$errors) {
            $user = $this->db->createUser([
                "username" => $username,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT)
            ]);

        }

        if (!is_object($user)) {
            $router->renderView("user/signup", ["errors" => $user]);
        } else {
            $_SESSION["user"] = $user;

            header("Location: /login");
        }
    }

    public function loginUser(Router $router)
    {
        $errors = [];
        $email = $_POST["email"];
        $password = trim($_POST["password"]);

        if (!$email) {
            $errors[] = "a username is required";
        }

        if (!$password) {
            $errors[] = "a password is required";
        }

        if (!$errors) {
            $user = $this->db->loginUser([
                "email" => $email,
                "password" => $password
            ]);
        } else {
            $router->renderView("user/login", [$errors]);
        }

        if (!is_object($user)) {
            $router->renderView("user/login", ["errors" => $user]);
        } else {
            $_SESSION["user"] = $user;

            header("Location: /");
        }

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /");
    }
}