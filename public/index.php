<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\Database;
use app\models\User;
use app\Router;
use app\controllers\PostController;
use app\controllers\UserController;

new Database();
$router = new Router();

session_start();
$userData = $_SESSION["user"] ?? "";
if ($userData) {
    $userArray = (array) $userData;
    $userId = $userArray["id"] ?? null;
    if ($userId) {
        new User($userArray);
    }

}

$router->get("/", [new PostController, "index"]);
$router->get("/post", [new PostController, "getPost"]);
$router->get("/signup", [new UserController, "signup"]);
$router->get("/login", [new UserController, "login"]);
$router->get("/logout", [new UserController, "logout"]);
$router->get("/create", [new PostController, "write"]);

$router->post("/edit", [new PostController, "write"]);
$router->post("/posts/delete", [new PostController, "deletePost"]);
$router->post("/signup", [new UserController, "createUser"]);
$router->post("/login", [new UserController, "loginUser"]);
$router->post("/create", [new PostController, "createPost"]);

$router->resolve();