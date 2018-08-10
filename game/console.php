<?php
    if(!isset($_SESSION["command_log"])) {
        $_SESSION["command_log"] = "";
    }

    if(isset($_POST["enter"])) {
        if($_POST["command"] <> "") {
            $command_old = $_POST["command"];
            $command = explode(" ", $command_old);
            
            switch($command[0]) {
                case "help":
                    $_SESSION["command_log"] = "";
                    $_SESSION["command_log"] = "help ~ Shows this help page
clear ~ Clears the commandlog
";
                    break;
                case "clear":
                    $_SESSION["command_log"] = "";
                    break;
                case "scan":
                    //echo "<script type=\"text/javascript\">$('#commandlog').html('Loool');</script>";
                    $_SESSION["command_log"] .= $_SESSION["username"]." <".$_SESSION["ipaddress"]."> ".$_POST["command"]."\n";
                    if(isset($command[1]) && $command[1] <> "") {
                        $scanned_ip = $command[1];
                        $pos_ip = strpos($scanned_ip, ".");
                        if($pos_ip !== false) {
                            $sql_scan = "SELECT uuid, ipaddress, money FROM userdata WHERE ipaddress='".$scanned_ip."';";

                            if(!$db_erg_scan = mysqli_query($db_link, $sql_scan)) {
                                echo "<p>Error!</p>";
                            }

                            while($data_scan = mysqli_fetch_array($db_erg_scan, MYSQLI_ASSOC)) {
                                $scanned_data_ip = $data_scan["ipaddress"];
                                $scanned_data_money = $data_scan["money"];
                            }

                            $_SESSION["command_log"] .= "IPAddress: ".$scanned_data_ip."\n";
                            $_SESSION["command_log"] .= "Money: €".$scanned_data_money."\n";

                            $scanned_data_ip = "";
                            $scanned_data_money = "";
                        } else {
                            $_SESSION["command_log"] .= "You need to enter a valid ipaddress!\n";
                        }
                    }
                    break;
                case "moneytr":
                    $_SESSION["command_log"] .= $_SESSION["username"]." <".$_SESSION["ipaddress"]."> ".$_POST["command"]."\n";
                    if(isset($command[1]) && $command[1] <> "") {
                        $scanned_ip = $command[1];
                        $pos_ip = strpos($scanned_ip, ".");
                        if($pos_ip !== false) {
                            $sql_moneytr = "SELECT uuid, ipaddress, money FROM userdata WHERE ipaddress='".$scanned_ip."';";

                            if(!$db_erg_moneytr = mysqli_query($db_link, $sql_moneytr)) {
                                echo "<p>Error!</p>";
                            }

                            $rows_moneytr = mysqli_num_rows($db_erg_moneytr);

                            if($rows_moneytr > 0) {
                                while($data_moneytr = mysqli_fetch_array($db_erg_moneytr, MYSQLI_ASSOC)) {
                                    $scanned_data_ip = $data_moneytr["ipaddress"];
                                    $scanned_data_money = $data_moneytr["money"];
                                }
    
                                $perc_money = $scanned_data_money * 0.05;
                                $perc_money = round($perc_money);
    
                                $new_self_money = $_SESSION["money"] + $perc_money;
                                $new_target_money = $scanned_data_money - $perc_money;

                                $sql_upload_target_money = "UPDATE userdata SET money='".$new_target_money."' WHERE ipaddress='".$scanned_data_ip."';";
                                $sql_upload_self_money = "UPDATE userdata SET money='".$new_self_money."' WHERE ipaddress='".$_SESSION['ipaddress']."';";

                                if(!$db_erg_upload_target_money = mysqli_query($db_link, $sql_upload_target_money)) {
                                    echo "<p>Error!</p>";
                                }

                                if(!$db_erg_upload_self_money = mysqli_query($db_link, $sql_upload_self_money)) {
                                    echo "<p>Error!</p>";
                                }
    
                                $_SESSION["command_log"] .= "Successfully transfered €".$perc_money." from ".$scanned_data_ip."!\n";
    
                                $scanned_data_ip = "";
                                $scanned_data_money = "";
    
                                $new_self_money = 0;
                                $new_target_money = 0;
                            } else {
                                $_SESSION["command_log"] .= "Target not found!\n";
                            }
                        } else {
                            $_SESSION["command_log"] .= "You need to enter a valid ipaddress!\n";
                        }
                    }
                    break;
                default:
                    $_SESSION["command_log"] .= $_SESSION["username"]." <".$_SESSION["ipaddress"]."> ".$_POST["command"]."\n";
                    break;
            }
        }
    }
?>
<style type="text/css">
    .hack_input {
        background: #F2F2F2;
        border: 1px solid #CCCCCC;
        border-radius: 5px;
        outline: none;
        color: #737373;
        letter-spacing: 1px;
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    #commandlog {
        resize: none;
    }
</style>
<form action="index.php?page=game&content=console" method="post">
    <textarea class="hack_input" id="commandlog" name="commandlog" size=50 cols="75" rows="20" readonly autocomplete="off"><?php echo $_SESSION["command_log"]; ?></textarea><br />
    <input class="hack_input" type="text" name="command" size="73" required minlength="1" autofocus autocomplete="off">
    <input class="hack_input_submit" type="submit" name="enter" hidden>
</form>
<script type="text/javascript">
    document.getElementById('commandlog').scrollTop=document.getElementById('commandlog').scrollHeight;
</script>