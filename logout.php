<?php
    if(!isset($_SESSION["loggedin"])) {
        echo "<p>You are not logged in!</p>";
    } else {
        if($_SESSION["loggedin"] == true) {
            //session_destroy();
            session_unset($_SESSION);
            session_destroy();

            echo "<p>Successfully logged out!</p>";

            echo "<script type=\"text/javascript\">
                window.setTimeout(function() {
                window.location.href='index.php?page=login';
                }, 1000);
                </script>";
        }
    }
?>