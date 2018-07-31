<?php
    session_start();
    include('database.php');
    if(isset($_SESSION["loggedin"])) {
        if($_SESSION["loggedin"] == true) {
            echo "<p>Du bist bereits angemeldet!</p>";
            echo "<p><a href=\"index.php?page=logout\">Logout</a></p>";
        }
    } else {
        if(isset($_POST['login'])) {
            if(isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = hash('sha256', $_POST['password']);

                $db_link = mysqli_connect($db_host, $db_username, $db_password) or die("<p>Datenbank nicht erreichbar</p>");
                $db_sel = mysqli_select_db($db_link, $db_name) or die("<p>Auswahl fehlgeschlagen!</p>");

                $logins = "SELECT uuid, username, email FROM logins WHERE username='".$username."' AND password='" . $password . "';";

                if(!$db_erg = mysqli_query($db_link, $logins)) {
                    echo "<p>Fehler!</p>"; //.mysqli_error($db_link)."</p>";
                }

                $rows = mysqli_num_rows($db_erg);

                if($rows > 0 && $rows < 2) {
                    while($data = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $data["username"];
                        $_SESSION["uuid"] = $data["uuid"];
                        $_SESSION["email"] = $data["email"];
                        $uuidst = $_SESSION["uuid"];

                        $userdata = "SELECT uuid, ipaddress, money FROM userdata WHERE uuid='".$uuidst."';";
                        if(!$db_erg_userdata = mysqli_query($db_link, $userdata)) {
                            echo "<p>Fehler!</p>"; //.mysqli_error($db_link)."</p>";
                        }
                        while($data_userdata = mysqli_fetch_array($db_erg_userdata, MYSQLI_ASSOC)) {
                            $_SESSION["ipaddress"] = $data_userdata["ipaddress"];
                            $_SESSION["money"] = $data_userdata["money"];
                        }

                        echo "<p>Erfolgreich angemeldet!</p>";
                        echo "<p>Welcome ".$_SESSION["username"]."!</p>";
    
                        echo "<script type=\"text/javascript\">
                            window.setTimeout(function() {
                            window.location.href='index.php?page=game&content=interface';
                            }, 1000);
                            </script>";
                        
                        //$_SESSION["ipaddress"] = $data["ipaddress"];
                        //$_SESSION["ipaddress_json"] = $data["ipaddress_json"];
                    }
                } else {
                    echo "<p>Username or password wrong!</p>";
                    echo "<form id=\"login_form\" action\"index.php?page=login\" method=\"POST\">
                        <input class=\"form_input\" name=\"username\" type=\"text\" placeholder=\"Username\"><br />
                        <input class=\"form_input\" name=\"password\" type=\"password\" placeholder=\"Password\"><br />
                        <input class=\"form_submit\" name=\"login\" type=\"submit\" value=\"Login\">
                        </form>";
                }

                mysqli_close($db_link);
            } else {
                echo "<p>Something went wrong!</p>";
            }
        } else {
            echo "<form id=\"login_form\" action\"index.php?page=login\" method=\"POST\">
                <input class=\"form_input\" name=\"username\" type=\"text\" placeholder=\"Username\"><br />
                <input class=\"form_input\" name=\"password\" type=\"password\" placeholder=\"Password\"><br />
                <input class=\"form_submit\" name=\"login\" type=\"submit\" value=\"Login\">
                </form>";
        }
    }
?>