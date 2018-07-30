<?php
    session_start();
    if(!isset($_SESSION["loggedin"])) {
        echo "<p>Du bist nicht angemeldet!</p>";
    } else {
        if($_SESSION["loggedin"] == true) {
            if(isset($_GET["content"])) {
                $content = $_GET["content"];
            } else {
                $content = "home";
            }
            include("game/content.php");
        }
    }
?>