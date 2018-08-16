<?php
    //echo "<p>Username: ".$_SESSION["username"]."</p>";
    //$ipv4 = replicateIPv4($_SESSION["ipaddress_json"]);
    //$ipv6 = replicateIPv6($_SESSION["ipaddress_json"]);
    //echo "<p>IPv4: ".$ipv4."</p>";
    //echo "<p>IPv6: ".$ipv6."</p>";
    //echo "<p>IP: ".$_SESSION["ipaddress"]."</p>";
    //echo "<p>Money: €".$_SESSION["money"]."</p>";
    //echo "<br />";

    echo "<h4>Newtwork</h4>";
    echo "<table id=\"show_network\">";
    echo "<tr>";
    echo "<td>Connected to</td>";
    echo "<td>Internet</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>IP Address</td>";
    echo "<td>".$_SESSION["ipaddress"]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Gateway IP</td>";
    echo "<td>N/A</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Gateway Status</td>";
    echo "<td>Offline</td>";
    echo "</tr>";
    echo "</table>";

    //echo "<p><a href=\"index.php?page=logout\">Logout</a></p>";

    function replicateIPv4($session) {
        $ipjson = json_decode($_SESSION["ipaddress_json"], true);
        $ipv4_dis = "";
        for($k = 0; $k < 4; $k++) {
            if($k != 3) {
                $ipv4_dis .= $ipjson["addresses"]["ipv4"][$k].".";
            } else {
                $ipv4_dis .= $ipjson["addresses"]["ipv4"][$k];
            }
        }
        return $ipv4_dis;
    }

    function replicateIPv6($session) {
        $ipjson = json_decode($_SESSION["ipaddress_json"], true);
        $ipv6_dis = "";
        for($k = 0; $k < 7; $k++) {
            if($k != 6) {
                $ipv6_dis .= $ipjson["addresses"]["ipv6"][$k].":";
            } else {
                $ipv6_dis .= $ipjson["addresses"]["ipv6"][$k];
            }
        }
        return $ipv6_dis;
    }
?>