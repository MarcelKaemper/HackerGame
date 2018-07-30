<style>
    div{
        height: 100px;
        width: 100px;
        border-radius: 50px;
        background: radial-gradient(circle, red, orange);
        margin: auto;
        box-shadow: 0 9px #999;
    }
    div:active{
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
    echo "<b><u>Registered users:<br></b></u>";
    include("../database.php");
    // Create connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT username FROM logins";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Username: " . $row["username"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>

<label id="onlineUsers"></label>

<div></div>