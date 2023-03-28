<?php

switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'home.php';
        break;
    case '/login.php':
        require 'login.php';
        break;
    case '/register.php':
        require 'register.php';
        break;
    case '/forum.php':
        require 'forum.php';
        break;
    case '/logout.php':
        require 'logout.php';
        break;
    case '/user.php':
        require 'user.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}

?>

