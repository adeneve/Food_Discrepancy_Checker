<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="https://pbs.twimg.com/profile_images/3596354243/36d8c7d11ff1e743dd3a8b18bf8be20a_400x400.png">
  <title>Sharky's Database</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.2">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/Styles.css">
<script src="scripts/menu_interact.js"></script>



<div id='Navbar'></div>
  
</head>
</html>




<?php

/* Objective: Do a bill search of the store, date range, and product number and return the Cases purchased
              Add the purchased cases to the starting inventory and subtract the ending inventory, this is the used product

              Gather the menu_item counts of the corresponding week number 
              check to see if each menu_item contains the product specified,
              if so multiply the count of the item by its corresponding qty value times 1/%yield.
              Add this to a running total.

*/

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

$store = mysqli_real_escape_string($link,$_POST[store_num]);
$start_date = mysqli_real_escape_string($link,$_POST[date1]);
$end_date = mysqli_real_escape_string($link,$_POST[date2]);
$Product = mysqli_real_escape_string($link,$_POST[products]);
$yield = mysqli_real_escape_string($link,$_POST[yield3]);
$startInv = mysqli_real_escape_string($link,$_POST[startInv]);
$endInv = mysqli_real_escape_string($link,$_POST[endInv]);
$conv = mysqli_real_escape_string($link,$_POST[conversion]);

$week_num = mysqli_real_escape_string($link,$_POST[weekNum]);

$start_date_pieces = explode(('/'), $start_date);
$end_date_pieces = explode(('/'), $end_date);

$start_day = $start_date_pieces[1];
$end_day = $end_date_pieces[1];

$start_month = $start_date_pieces[0];
$end_month = $end_date_pieces[0];


// Get the product numbers bought from the bills
$products = array();

$sql = "Select * from ProductRelation WHERE Pname = '$Product'";
$res = mysqli_query($link, $sql) or die(mysqli_error($link));

while($row = mysqli_fetch_array($res)){
	array_push($products, $row['Pnum']);
}

$Total_Qty;
$unit;
$ext_price;
$unit_price;
$unit_qty;

echo "<table class='table'>"; // start a table tag in the HTML
echo "<tr><td><p class='text-info'>" . "Quantity Ordered" . "</p></td><td><p class='text-info'>" . "Unit Price" . "</p></td><td><p class='text-info'>" . "Extended Price" . "</p></td><td><p class='text-info'>" . "Description" . "</p></td><td><p class='text-info'>" . "Date" . "</p></td></tr>";

foreach ($products as &$value) {
	#Go through the date range picking up cases
		
		if($start_date_pieces[0] == $end_date_pieces[0] && $start_date_pieces[1] <= $end_date_pieces[1]){
		while($start_day <= $end_day){
		$current_date = $start_date_pieces[0] .'/'. $start_day .'/'. $start_date_pieces[2];

		
		$query = "select Qty_Ordered,Description,Unit_Price,Extended_Price,Price_Uom,Product_Number from bills where Customer_Number = '$store' and Invoice_Date = '$current_date' and Product_Number= $value;";
		$res = mysqli_query($link,$query) or die(mysqli_error($link));
		

		$start_day = $start_day + 1;

		if($count = $res->num_rows){
			
		while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results
		echo "<tr><td>" . $row['Qty_Ordered'] . "</td><td>" . $row['Unit_Price'] . "</td><td>" . $row['Extended_Price'] . "</td><td>" . $row['Description'] . "</td><td>" . $current_date . "</td></tr>";  //$row['index'] the index here is a field name
		

		$ext_price = $row['Extended_Price'];
		$unit_price = $row['Unit_Price'];
		$unit = $row['Price_Uom'];

		if($ext_price != 0){
			$unit_qty = $ext_price/$unit_price;
			$Total_Qty = $Total_Qty + $unit_qty;
		}
		
		}

		}

		$res->free();
		}
		$start_day = $start_date_pieces[1];
		}

		if($start_month < $end_month){
			while($start_month < $end_month){
				while($start_day < 31){
					$current_date = $start_month .'/'. $start_day .'/'. $start_date_pieces[2];

		
					$query = "select Qty_Ordered,Description,Unit_Price,Extended_Price,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date' and Product_Number= $value;";
					$res = mysqli_query($link,$query) or die(mysqli_error($link));
					

					$start_day = $start_day + 1;

					if($count = $res->num_rows){
						
					while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results
					echo "<tr><td>" . $row['Qty_Ordered'] . "</td><td>" . $row['Unit_Price'] . "</td><td>" . $row['Extended_Price'] . "</td><td>" . $row['Description'] . "</td><td>" . $current_date . "</td></tr>";  //$row['index'] the index here is a field name
					

					$ext_price = $row['Extended_Price'];
					$unit_price = $row['Unit_Price'];
					$unit = $row['Price_Uom'];

					if($ext_price != 0){
						$unit_qty = $ext_price/$unit_price;
						$Total_Qty = $Total_Qty + $unit_qty;
					}
					
					}

					}

					$res->free();



				}
				$start_day = 1;
				$start_month = $start_month + 1;
			}
			while($start_day <= $end_day){

				$current_date = $start_month .'/'. $start_day .'/'. $start_date_pieces[2];

		
					$query = "select Qty_Ordered,Description,Unit_Price,Extended_Price,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date' and Product_Number= $value;";
					$res = mysqli_query($link,$query) or die(mysqli_error($link));
					

					$start_day = $start_day + 1;

					if($count = $res->num_rows){
						
					while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results
					echo "<tr><td>" . $row['Qty_Ordered'] . "</td><td>" . $row['Unit_Price'] . "</td><td>" . $row['Extended_Price'] . "</td><td>" . $row['Description'] . "</td><td>" . $current_date . "</td></tr>";  //$row['index'] the index here is a field name
					

					$ext_price = $row['Extended_Price'];
					$unit_price = $row['Unit_Price'];
					$unit = $row['Price_Uom'];

					if($ext_price != 0){
						$unit_qty = $ext_price/$unit_price;
						$Total_Qty = $Total_Qty + $unit_qty;
					}
					
					}

					}

					$res->free();

			}
			$start_day = $start_date_pieces[1];
			$start_month = $start_date_pieces[0];
		}



}
echo "</table>";




echo "<table class='table'>"; // start a table tag in the HTML
echo "<tr><td><p class='text-info'>" . "Menu_Item" . "</p></td><td><p class='text-info'>" . "Register Count" . "</p></td><td><p class='text-info'>" . "Qty of product used" . "</p></td><td><p class='text-info'>" . "Date" . "</p></td></tr>";

$db_selected = mysqli_select_db( $link, "foodused_SharkysIngredients") or die("cant connect to database". mysqli_error($link));

$menu_item = array();

$sql = "Select * from $Product";

$res = mysqli_query($link, $sql) or die(mysqli_error($link));


$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

$Total_Register;

while($row = mysqli_fetch_array($res)){
	$item = $row['ItemName'];
	$item_qty = $row['Qty'];

	$item = str_replace('_', ' ', $item);
	
	$sql="Select * from Menu_Item_Count where store='$store' and name='$item' and Week_Num='$week_num'";
	$res2 = mysqli_query($link, $sql) or die(mysqli_error($link));

	echo"<tr><td>".$item. "</td>";
	while($row2 = mysqli_fetch_array($res2)){

		$newQty = $row2['quantity'] * $item_qty;
		$Total_Register = $Total_Register + $newQty;

		echo "<td>". $row2['quantity']."</td><td>" . $item_qty ."</td><td>".$week_num."</td></tr>";
	}
	

}
echo "</table>";
$newQty_yield = $Total_Register;

if($yield != 0){
$newQty_yield = $Total_Register * (1/$yield);
}
if($conv == 0){
	$conv =1;
}
echo "<br><h3>Starting Inventory: " . $startInv."</h3><br>";
echo "<br><h3>Total qty of: " . $Product." purchased:".$Total_Qty." ". $unit."</h3><br>";
echo "<br><h3>Ending Inventory: " . $endInv."</h3><br>";
echo "<br><h3>Total qty of " . $Product."Actual used (without yield):".$Total_Register/$conv." ".$unit. "</h3><br>";
echo "<br><h3>Total qty of " . $Product."Actual used (with yield):".$newQty_yield/$conv." ". $unit. "</h3><br>";
$Reported = $startInv + $Total_Qty - $endInv;
echo "<br><h3>Total qty of " . $Product."Reported used:".$Reported." ". $unit."</h3><br>";

/* for each menu item select the week number and store from the menu item count and select the count for that week and multiply it by the.. QUERIED item qty */


?>