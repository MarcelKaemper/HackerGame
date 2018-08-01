<?php
    switch($content) {
        case "adminarea":
            include('adminarea.php');
            break;
        case "interface":
        default:
            include('interface.php');
            break;
    }
?>