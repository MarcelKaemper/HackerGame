<?php

$sql = "SELECT id, name, start_price, price_level_mul, description FROM shop;";

if(!$db_erg = mysqli_query($db_link, $sql)) {
    echo "<p>Error!</p>";
}

while($data = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    echo "<div style='border: 1px solid black; padding: 5px' title=".$data["description"]."> Name: ".$data["name"]."</div><br>";
}

?>