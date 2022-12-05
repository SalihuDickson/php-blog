<?php

namespace app\controllers;

use app\models\Post;
use app\Router;
use app\Database;
use app\models\User;

class PostController
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::$db;
    }

    public function index(Router $router)
    {
        $cat = $_GET["cat"] ?? "";
        $posts = $this->db->getPosts(["cat" => $cat]);
        $router->renderView("posts/index", ["posts" => $posts]);
    }

    public function getPost(Router $router)
    {
        $id = $_GET["id"] ?? "";
        if (!$id) {
            return $router->renderPageNotFound();
        }

        $post = $this->db->getPosts(["id" => $id])[0];
        $similarPosts = $this->db->getPosts(["cat" => $post["cat"]]);
        $router->renderView("posts/post", ["post" => $post, "similarPosts" => $similarPosts]);
    }

    public function write(Router $router)
    {
        $user = $_SESSION["user"] ?? "";
        $id = $_POST["id"] ?? "";
        $edit = $_POST["edit"] ?? "";
        if (!$user) {
            header("Location: /login");
        }

        if ($edit) {
            $this->editPost($router);
            return;
        }

        $post = [
            "id" => "",
            "title" => "",
            "desc" => "",
            "img" => "",
            "cat" => "",
        ];

        if ($id) {
            $postData = $this->db->getPosts(["id" => $id])[0];
            $post = [...$postData, "userImage" => "", "password" => ""];
            new Post($post);
        }

        $router->renderView("posts/write", ["post" => $post]);
    }

    public function editPost(Router $router)
    {
        $errors = [];
        print_r($_POST);
        print_r($_FILES);

        $image = $_FILES["image"] ?? null;
        $imageName = $_POST["img"];

        if (!empty($errors)) {
            $router->renderView("posts/write", ["errors" => $errors, "post" => [...$_POST, "desc" => $_POST["description"]]]);
            return;
        }

        if ($image && $image["tmp_name"]) {
            unlink('uploads/' . $imageName);
            $imageName = time() . $image['name'];
            $imagePath = 'uploads/' . $imageName;

            move_uploaded_file($image["tmp_name"], $imagePath);
        }

        $this->db->updatePost([...$_POST, "image" => $imageName]);
        header("location: /");
    }

    public function deletePost(Router $router)
    {
        $id = $_POST["id"] ?? null;
        if (!$id) {
            header("Location: /");
            exit;
        }

        $this->db->deletePost($id);
        header("Location: /");
    }

    public function createPost(Router $router)
    {
        $errors = [];

        $cat = $_POST["cat"] ?? null;
        $image = $_FILES["image"];

        if (!$cat) {
            $errors[] = "please select a category";
        }

        if ($image && $image["error"]) {
            $errors[] = "please select a valid image";
        }

        if (!is_dir("uploads")) {
            mkdir("uploads");
        }

        if (!empty($errors)) {
            $router->renderView("posts/write", ["errors" => $errors]);
            return;
        }

        if ($image && $image["tmp_name"]) {
            $imageName = time() . $image['name'];
            $imagePath = 'uploads/' . $imageName;

            echo $imagePath;
            echo move_uploaded_file($image["tmp_name"], $imagePath);
        }

        $this->db->createPost([...$_POST, "image" => $imageName]);
        header("location: /");
    }
}