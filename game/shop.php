<?php

$sql = "SELECT id, name, start_price, price_level_mul, description FROM shop;";
$sql2 = "SELECT item_level FROM items WHERE uuid='".$_SESSION['uuid']."';";

if(!$db_erg = mysqli_query($db_link, $sql)) {
    echo "<p>Error!</p>";
}

while($data = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    echo "<div style='border: 1px solid black; padding: 5px; margin: 5px;display: inline-block' title=".$data["description"]."> Name: ".$data["name"]."</div><br>";
}

if(!$db_erg2 = mysqli_query($db_link, $sql2)) {
    echo "<p>Error!</p>";
}

// while($data2 = mysqli_fetch_array($db_erg2, MYSQLI_ASSOC)) {
//     echo "<div style='border: 1px solid black; padding: 5px; margin: 5px;display: inline-block'>".$data2["item_level"]."</div><br>";
// }

?>