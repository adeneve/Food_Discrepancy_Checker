<?php
$q = intval($_GET['q']);

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

$lower_bound = $q - 16;

$sql="SELECT * FROM Menu_Items";
$result = mysqli_query($link,$sql);


while($row = mysqli_fetch_array($result)) {

	$row['name'] = str_replace(' ', '_', $row['name']);
    echo "<option value=". $row['plu']. "|". $row['name'].">" . $row['name']. "</option>" ;


}

mysqli_close($link);
?>