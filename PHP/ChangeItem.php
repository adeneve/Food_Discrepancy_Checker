<?php

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_SharkysIngredients") or die("cant connect to database". mysqli_error($link));

$name = mysqli_real_escape_string($link,$_POST['menu_name']);
$Qty = mysqli_real_escape_string($link,$_POST['Qty']);
$product = mysqli_real_escape_string($link,$_POST['product']);

$sql = "UPDATE $product SET Qty = $Qty WHERE ItemName = '$name'";

mysqli_query($link, $sql) or die(mysqli_error($link));


header('Location: ../MenuInterface.html');


?>