<?php

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_SharkysIngredients") or die("cant connect to database". mysqli_error($link));



$sql="SHOW TABLES";
$result = mysqli_query($link,$sql);


while($row = mysqli_fetch_array($result)) {

	
    echo "<option  value=". $row[0].">" . $row[0]. "</option>" ;


}

mysqli_close($link);
?>