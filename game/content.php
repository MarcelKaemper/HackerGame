<?php
    switch($content) {
        case "adminarea":
            include('adminarea.php');
            break;
        case "shop":
            include('shop.php');
            break;
        case "console":
            include('console.php');
            break;
        case "interface":
        default:
            include('interface.php');
            break;
    }
?>