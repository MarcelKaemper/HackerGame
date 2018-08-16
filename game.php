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
            //echo "<p>Username: ".$_SESSION["username"]."</p>";
            //echo "<p>Money: €".$_SESSION["money"]."</p>";

            echo "<h4>Information</h4>";
            echo "<table id=\"show_static_information\">";
            echo "<tr>";
            echo "<td>Time</td>";
            echo "<td id=\"interface_curtime\"></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Username</td>";
            echo "<td>".$_SESSION["username"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Money</td>";
            echo "<td>€".$_SESSION["money"]."</td>";
            echo "</tr>";
            echo "</table>";

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
<script type="text/javascript">
    setInterval(function() {
        var currentTime = new Date ( );    
        var currentHours = currentTime.getHours ( );   
        var currentMinutes = currentTime.getMinutes ( );   
        var currentSeconds = currentTime.getSeconds ( );

        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

        currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
        currentHours = ( currentHours == 0 ) ? 12 : currentHours;

        //var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
        var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;

        var currentDateDay = currentTime.getDate();
        var currentDateMonth = currentTime.getMonth();
        var currentDateYear = currentTime.getFullYear();

        currentDateMonth = (currentDateMonth + 1);
        if(currentDateMonth < 10) {
            currentDateMonth = "0" + currentDateMonth;
        }

        if(currentDateDay < 10) {
            currentDateDay = "0" + currentDateDay;
        }

        var currentDateString = currentDateYear + "/" + currentDateMonth + "/" + currentDateDay;

        document.getElementById("interface_curtime").innerHTML = currentTimeString;
        document.getElementById("interface_curtime").title = currentDateString;
    }, 1000);
</script>