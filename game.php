<?php
    session_start();
    if(!isset($_SESSION["loggedin"])) {
        echo "<p>Du bist nicht angemeldet!</p>";
    } else {
        if($_SESSION["loggedin"] == true) {
            echo "Username: ".$_SESSION["username"]."<br />";
            echo "UUID: ".$_SESSION["uuid"]."<br />";
            echo "IP-Address: ".$_SESSION["ipaddress"]."<br />";
            echo "Email-Address: ".$_SESSION["email"];
        }
    }
?>