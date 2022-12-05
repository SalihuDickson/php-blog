<?php

namespace app;

use app\models\User;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $currentUrl = $_SERVER["REQUEST_URI"] ?? null;
        $method = $_SERVER["REQUEST_METHOD"];

        if (strpos($currentUrl, "?")) {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, "?"));
        }

        if ($method === "GET") {
            $fn = $this->getRoutes[$currentUrl];
        } else if ($method === "POST") {
            $fn = $this->postRoutes[$currentUrl];
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            $this->renderPageNotFound();
        }


    }

    public function renderView($view, $params = [])
    {
        $errors = [];
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        // these are embeded in the html in the php files
        $links = ["art", "science", "tech", "cinema", "design", "food"];
        $createLink = "/create";
        $logoutLink = "/logout";
        $loginLink = "/login";
        $signupLink = "/signup";
        $home = "/";
        $user = "";
        $menu = __DIR__ . "/views/partials/menu.php";
        if (User::$instanciated) {
            $user = (array) User::$currentUser;
        }

        ob_start();
        include_once __DIR__ . "/views/partials/navbar.php";
        include_once __DIR__ . "/views/$view.php";
        include_once __DIR__ . "/views/partials/footer.php";
        $content = ob_get_clean();

        include_once __DIR__ . "/views/_layout.php";
    }

    public function renderPageNotFound()
    {
        echo "page not found";
    }
}