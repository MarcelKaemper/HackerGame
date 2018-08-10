<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="index.php?page=home">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
                //session_start();
                if(isset($_SESSION["loggedin"])) {
                    if($_SESSION["loggedin"] == true) {
                        if($_SESSION["uuid"] == "qd2GnLAuRlAdZTHx" || $_SESSION["uuid"] == "lMaC4qebaekNe6OD"){
                            echo "<li><a href=\"index.php?page=game&content=adminarea\"><span class=\"glyphicon glyphicon-th\"></span> AdminArea</a></li>";
                        }
                        echo "<li><a href=\"index.php?page=game&content=console\"><span class=\"glyphicon glyphicon-tasks\"></span> Console</a></li>";
                        echo "<li><a href=\"index.php?page=game&content=shop\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Shop</a></li>";
                        echo "<li><a href=\"index.php?page=game&content=interface\"><span class=\"glyphicon glyphicon-user\"></span> Game</a></li>";
                        echo "<li><a href=\"index.php?page=logout\"><span class=\"glyphicon glyphicon-log-in\"></span> Logout</a></li>";
                    } else {
                        echo "<li><a href=\"index.php?page=register\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>";
                        echo "<li><a href=\"index.php?page=login\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                    }
                } else {
                    echo "<li><a href=\"index.php?page=register\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>";
                    echo "<li><a href=\"index.php?page=login\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                }
            ?>
            <!--
            <li><a href="index.php?page=register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="index.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            -->
        </ul>
    </div>
</nav>