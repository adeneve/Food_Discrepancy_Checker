<?php

$db_name="foodused_users";
$mysql_user="foodused_Andrew";
$mysql_pass="Alejandro123";
$server_name="localhost";

$link = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);

if(!$link) {
	die('Could not connect: ' . mysql_error() );
}

$value2 =   $_POST[Password];

$value =  $_POST[ID];

$get_hash = "SELECT * from user_info where user_name = '$value';";
$res = mysqli_query($link,$get_hash);
$row = mysqli_fetch_array($res);

$check = password_verify($value2,$row['user_pass']);


if($check && $row['Admin'])
{ ?>
<script>alert('login success!'); window.location= '../homeinterface(admin).html';</script><?php

}
if($check && !$row['Admin']){
	?>
<script>alert('login success!'); window.location= '../homeinterface.html';</script><?php
}
else
{
echo "not registered";
echo $value2;
}

?>