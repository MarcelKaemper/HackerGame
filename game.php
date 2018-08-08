<?php
    if(!isset($_SESSION["loggedin"])) {
        echo "<p>You are not logged in!</p>";
    } else {
        if($_SESSION["loggedin"] == true) {
            if(isset($_GET["content"])) {
                $content = $_GET["content"];
            } else {
                $content = "home";
            }

            $user_uuid = $_SESSION["uuid"];

            $db_link = mysqli_connect($db_host, $db_username, $db_password) or die("<p>Database not reachable</p>");
            $db_sel = mysqli_select_db($db_link, $db_name) or die("<p>Selection failed!</p>");

            $sql = "SELECT money, ipaddress FROM userdata WHERE uuid='".$user_uuid."';";
            $sql2 = "SELECT username FROM logins WHERE uuid='".$user_uuid."';";

            if(!$db_erg = mysqli_query($db_link, $sql)) {
                echo "<p>Error!</p>";
            }

            while($data = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
                $_SESSION["ipaddress"] = $data["ipaddress"];
                $_SESSION["money"] = $data["money"];
            }

            if(!$db_erg2 = mysqli_query($db_link, $sql2)) {
                echo "<p>Error!</p>";
            }

            while($data2 = mysqli_fetch_array($db_erg2, MYSQLI_ASSOC)) {
                $_SESSION["username"] = $data2["username"];
            }

            echo "<div class=\"container-fluid\">
                <div class=\"row\">
                <div class=\"col-sm-3\">
                <div id=\"game_info\">";
            echo "<p>Username: ".$_SESSION["username"]."</p>";
            echo "<p>Money: €".$_SESSION["money"]."</p>";
            echo "</div>
                </div>
                <div class=\"col-sm-9\">
                <div id=\"game_content\">";
            include("game/content.php");
            //echo "One of three colums";
            echo "</div>
                </div>
                </div>
                </div>";

            mysqli_close($db_link);
            
            //echo "<div id=\"game_content\">";
            //include("game/content.php");
            //echo "</div>";
        }
    }
?>