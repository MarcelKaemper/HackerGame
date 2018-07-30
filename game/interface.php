<?php
    echo "Username: ".$_SESSION["username"]."<br />";
    echo "UUID: ".$_SESSION["uuid"]."<br />";
    echo "IP-Address: ".$_SESSION["ipaddress"]."<br />";
    echo "Email-Address: ".$_SESSION["email"]."<br />";

    echo "<p><a href=\"index.php?page=logout\">Logout</a></p>";
?>