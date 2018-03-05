<?php
$user = "foodused_Andrew";
$pass = "";
$server_name = "localhost";

$link = mysqli_connect($server_name,$user,$pass);
if(!$link)
{
echo "Connection Error..". mysqli_connect_error();
}

?>
