<?php if($_SESSION["uuid"] == "lMaC4qebaekNe6OD" || $_SESSION["uuid"] == "qd2GnLAuRlAdZTHx"){ ?>
<style>
    #btn{
        height: 100px;
        width: 100px;
        border-radius: 50px;
        background: radial-gradient(circle, red, orange);
        margin: auto;
        float: right;
        box-shadow: 0 9px #666;
    }
    #btn:active{
        background-color: #3e8e41;
        box-shadow: 0 2px #666;
        transform: translateY(4px);
    }
    #container{
        border: 1px solid #000;
        display: inline-block;
        padding: 5px 10px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#btn").click(function(){
            location.reload();
        });
    });
</script>
<?php

$sql = "SELECT username FROM logins;";
$result = $db_link->query($sql);

if ($result->num_rows > 0) {
    echo "<div id='container'>";
    echo "<b><u>Registered users:<br></b></u>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"]. "<br>";
    }
    echo "</div>";
} else {
    echo "0 results";
}
?>

<div id="btn"></div>
<?php 
} else {
    echo "<h4 align='center'> Permission denied </h4>";
}
?>
