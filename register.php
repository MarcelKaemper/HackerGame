<?php
    session_start();
    include('database.php');
    if(isset($_SESSION["loggedin"])) {
        if($_SESSION["loggedin"] == true) {
            echo "<p>Du bist bereits angemeldet!</p>";
            echo "<p><a href=\"index.php?page=logout\">Logout</a></p>";
        }
    } else {
        if(isset($_POST['register'])) {
            if(isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = hash('sha256', $_POST['password']);
                $email = $_POST['email'];
                $uuid = createUUID();
                $ipaddress = createIPAddress();

                $db_link = mysqli_connect($db_host, $db_username, $db_password) or die("<p>Datenbank nicht erreichbar</p>");
                $db_sel = mysqli_select_db($db_link, $db_name) or die("<p>Auswahl fehlgeschlagen!</p>");

                $sql = "INSERT INTO logins (uuid, email, username, password, ipaddress) VALUES ('".$uuid."', '".$email."', '".$username."', '".$password."', '".$ipaddress."');";

                if(!$db_erg = mysqli_query($db_link, $sql)) {
                    echo "<p>Fehler: ".mysqli_error($db_link)."</p>";
                }

                mysqli_close($db_link);
                
                echo "<p>Benutzer wurde erfolgreich registriert!</p>";
            } else {
                echo "<p>Something went wrong!</p>";
            }
        } else {
            echo "<form id=\"register_form\" action=\"index.php?page=register\" method=\"POST\">
                <input class=\"form_input\" name=\"username\" type=\"text\" placeholder=\"Username\"><br />
                <input class=\"form_input\" name=\"password\" type=\"password\" placeholder=\"Password\"><br />
                <input class=\"form_input\" name=\"email\" type=\"email\" placeholder=\"Email\"><br />
                <input class=\"form_submit\" name=\"register\" type=\"submit\" value=\"Register\">
                </form>";
        }
    }

    function createUUID() {
        $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $uuid = "";
        for($i = 0; $i < 16; $i++) {
            $uuid .= $charset[rand(0, strlen($charset)-1)];
        }
        return $uuid;
    }

    function createIPAddress() {
        $ipaddress = "";
        for($i = 0; $i < 4; $i++) {
            if($i != 3) {
                $ipaddress .= "".rand(0,255).".";
            } else {
                $ipaddress .= "".rand(0,255);
            }
        }
        return $ipaddress;
    }
?>