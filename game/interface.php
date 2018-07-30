<?php
    //echo "Username: ".$_SESSION["username"]."<br />";
    //echo "UUID: ".$_SESSION["uuid"]."<br />";
    //echo "IP-Address: ".$_SESSION["ipaddress"]."<br />";
    //echo "Email-Address: ".$_SESSION["email"]."<br />";
    echo "<p>Username: ".$_SESSION["username"]."</p>";
    echo "<p>IP: ".$_SESSION["ipaddress"]."</p>";

    echo "<p><a href=\"index.php?page=logout\">Logout</a></p>";

    /*
    echo "<br />";
    echo "<br />";
    echo "<br />";
    
    echo generateIPv6();
    function generateIPv6() {
        $charset = "abcdef0123456789";
        $uuid = "2001:0db8:";
        for($i = 0; $i < 6; $i++) {
            $x = 0;
            for($x = 0; $x < 4; $x++) {
                $uuid .= $charset[rand(0, strlen($charset)-1)];
            }
            if($i != 5) {
                $uuid .= ":";
            }
        }
        return $uuid;
    }
    */
?>