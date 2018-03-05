<?php

$db_name="foodused_users";
$mysql_user="foodused_Andrew";
$mysql_pass="Alejandro123";
$server_name="localhost";

$link = mysqli_connect($server_name, $mysql_user, $mysql_pass);

if(!$link) {
	die('Could not connect: ' . mysqli_error($link) );
}
$db_selected = mysqli_select_db( $link, "foodused_users") or die("cant connect to database". mysqli_error($link));




$value3 = $_POST[Code];

$value2 =   $_POST[Password];

$value =  $_POST[ID];

$value2 = password_hash($value2, PASSWORD_BCRYPT);

$sql= mysqli_query($link,"SELECT * from Company_Codes where Code = '$value3'");

if(mysqli_num_rows($sql)>0)
{

$sql= "INSERT INTO user_info (user_name, user_pass, Code) VALUES ( '$value' ,'$value2', '$value3')";


if(mysqli_query($link,$sql))
{ ?>
<script>alert('Registration success!'); window.location= '../homeinterface.html';</script><?php

}
else
{
echo "Data insertion error...".mysqli_error($link);
}
}
else{
	?>
	<script>alert('Company code does not exist.'); window.location= '../../'</script><?php
}




?>

