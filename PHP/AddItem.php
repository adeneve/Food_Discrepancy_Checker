<?php
require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_SharkysIngredients") or die("cant connect to database". mysqli_error($link));

$item_string = $_POST['item'];
$product = $_POST['product'];

$array = explode('|', $item_string);

$plu = $array[0];
$name = $array[1];

echo var_dump();
echo $_POST['product'];

echo $name;
echo "hi";
echo $product;
echo $plu;
	

$sql = "SELECT * from $product";

if(mysqli_query($link, $sql)){

$sql = "INSERT INTO $product (ItemName,plu,Qty) VALUES ('$name','$plu', 0)";

mysqli_query($link,$sql) or die(mysqli_error($link));

} else{

$sql= "CREATE TABLE $product (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,ItemName VARCHAR(30) NOT NULL,plu INT(10) NOT NULL,Qty VARCHAR(10))";

mysqli_query($link, $sql) or die(mysqli_error($link));

$sql = "INSERT INTO $product (ItemName,plu,Qty) VALUES ('$name','$plu', 0)";

mysqli_query($link,$sql) or die(mysqli_error($link));

}

header('Location: ../MenuInterface.html');

?>