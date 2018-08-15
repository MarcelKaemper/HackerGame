<?php
    if(isset($_SESSION["loggedin"])) {
        if($_SESSION["loggedin"] == true) {
            echo "<p>You are already logged in!</p>";
            //echo "<p><a href=\"index.php?page=logout\">Logout</a></p>";
        }
    } else {
        if(isset($_POST['register'])) {
            if(isset($_POST['username']) && isset($_POST['password'])) {
                $db_link = mysqli_connect($db_host, $db_username, $db_password) or die("<p>Database not reachable</p>");
                $db_sel = mysqli_select_db($db_link, $db_name) or die("<p>Selection failed!</p>");

                $username = mysqli_real_escape_string($db_link, $_POST['username']);
                $password = mysqli_real_escape_string($db_link, $_POST['password']);
                $password = hash('sha256', $password);
                $email = mysqli_real_escape_string($db_link, $_POST['email']);
                $uuid = createUUID();
                $ipaddress = createIPAddress();
                $money = 0;

                $checkusername = "SELECT username FROM logins WHERE username='".$username."';";
                $checkemail = "SELECT email FROM logins WHERE email='".$email."';";

                if(!$db_erg_username = mysqli_query($db_link, $checkusername)) {
                    echo "<p>Error!</p>";
                }

                $rows_username = mysqli_num_rows($db_erg_username);

                if($rows_username == 0) {
                    if(!$db_erg_email = mysqli_query($db_link, $checkemail)) {
                        echo "<p>Error!</p>";
                    }

                    $rows_email = mysqli_num_rows($db_erg_email);

                    if($rows_email == 0) {
                        $gencount_ipaddress = true;
                        while($gencount_ipaddress) {
                            $checkipaddress = "SELECT ipaddress FROM userdata WHERE ipaddress='".$ipaddress."';";

                            if(!$db_erg_ipaddress = mysqli_query($db_link, $checkipaddress)) {
                                echo "<p>Error!</p>";
                            }
        
                            $rows_ipaddress = mysqli_num_rows($db_erg_ipaddress);
                            if($rows_ipaddress != 0) {
                                $ipaddress = createIPAddress();
                            } else {
                                $gencount_ipaddress = false;
                            }
                        }
                        if($gencount_ipaddress == false) {
                            $gencount_uuid = true;
                            while($gencount_uuid) {
                                $checkuuid = "SELECT uuid FROM logins WHERE uuid='".$uuid."';";
                                
                                if(!$db_erg_uuid = mysqli_query($db_link, $checkuuid)) {
                                    echo "<p>Error!</p>";
                                }
            
                                $rows_uuid = mysqli_num_rows($db_erg_uuid);
    
                                if($rows_uuid != 0) {
                                    $uuid = createUUID();
                                } else {
                                    $gencount_uuid = false;
                                }
                            }
                            if($gencount_uuid == false) {
                                $sql = "INSERT INTO logins (uuid, email, username, password) VALUES ('".$uuid."', '".$email."', '".$username."', '".$password."');";
                                $sql2 = "INSERT INTO userdata (uuid, ipaddress, money) VALUES ('".$uuid."', '".$ipaddress."', '".$money."');";

                                if(!$db_erg = mysqli_query($db_link, $sql)) {
                                    echo "<p>Error!</p>";
                                }
        
                                if(!$db_erg2 = mysqli_query($db_link, $sql2)) {
                                    echo "<p>Error!</p>";
                                }
        
                                echo "<p>User sucessfully registered!</p>";
        
                                successData();
                            }
                        }
                    } else {
                        echo "<p>Email already registered!</p>";
                        wrongData();
                    }
                } else {
                    echo "<p>Username already registered!</p>";
                    wrongData();
                }

                mysqli_close($db_link);
            } else {
                echo "<p>Something went wrong!</p>";
            }
        } else {
            wrongData();
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

    function wrongData() {
        echo "<form id=\"register_form\" action=\"index.php?page=register\" method=\"POST\">
                <input class=\"form_input box-style-input\" name=\"username\" type=\"text\" placeholder=\"Username\"><br />
                <input class=\"form_input box-style-input\" name=\"password\" type=\"password\" placeholder=\"Password\"><br />
                <input class=\"form_input box-style-input\" name=\"email\" type=\"email\" placeholder=\"Email\"><br />
                <input class=\"form_submit box-style-submit\" name=\"register\" type=\"submit\" value=\"Register\">
                </form>";
    }

    function successData() {
        echo "<script type=\"text/javascript\">
            window.setTimeout(function() {
            window.location.href='index.php?page=login';
            }, 1000);
            </script>";
    }
?>