<?php
    switch($content) {
        case "adminArea":
            include('adminArea.php');
            break;
        case "interface":
        default:
            include('game/interface.php');
            break;
    }
?>