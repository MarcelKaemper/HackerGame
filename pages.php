<?php
    switch($page) {
        case "login":
            include('login.php');
            break;
        case "register":
            include('register.php');
            break;
        case "logout":
            include('logout.php');
            break;
        case "game":
            include('game.php');
            break;
        case "home":
        default:
            include('home.php');
            break;
    }
?>