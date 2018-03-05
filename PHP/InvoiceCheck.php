<?php
require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

//Take invoices from a given date range; count number of lines per invoice number
//while the end date hasn't been reached do a query on an invoice date 
//while looping through results; if the invoice_number changes insert into the invoice_check table 
//the previous line count and invoice name


//initalize variables-----------------------------------------------------------

$line_counter = 0;
$current_Invoice;

$start_date = mysqli_real_escape_string($link,$_POST[date1_check]);
$end_date = mysqli_real_escape_string($link,$_POST[date2_check]);

$start_date_pieces = explode(('/'), $start_date); //splits on '/'
$end_date_pieces = explode(('/'), $end_date);

$start_day = $start_date_pieces[1];
$end_day = $end_date_pieces[1];

// clear table
$query = "TRUNCATE TABLE Invoice_Check;";
$res = mysqli_query($link,$query) or die("truncate error:" . mysqli_error($link));


//--------------------------------------------------------------------------------
//query monthly


if($start_date_pieces[0] == $end_date_pieces[0] && $start_date_pieces[1] <= $end_date_pieces[1]){
while($start_day <= $end_day){
$current_date = $start_date_pieces[0] .'/'. $start_day .'/'. $start_date_pieces[2];

$query = "select Invoice_Number, Invoice_Date from bills where Invoice_Date = '$current_date';";

$res = mysqli_query($link,$query) or die("selection error:" . mysqli_error($link));

$row = mysqli_fetch_array($res);
$current_Invoice = $row['Invoice_Number'];
$line_counter = $line_counter + 1;

$start_day = $start_day + 1;

if($count = $res->num_rows){
	
while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results

	if($current_Invoice != $row['Invoice_Number']){
$sql= "INSERT INTO Invoice_Check (Invoice_Num, Inv_Lines, Inv_Date) VALUES ( '$current_Invoice' ,'$line_counter', '$current_date')";
$res2 = mysqli_query($link,$sql) or die("insertion error:" . mysqli_error($link));
$current_Invoice = $row['Invoice_Number'];
$line_counter = 1;
}
else{
$line_counter = $line_counter + 1;
}
}

}

$res->free();
}
}

//------------------------------------------------------------------------------------------- 
//query through months

if($start_date_pieces[0] < $end_date_pieces[0]){
	$current_month = $start_date_pieces[0];
	$start_day = $start_date_pieces[1];
	$end_day = $end_date_pieces[1];
	while($current_month != $end_date_pieces[0]){


		while($start_day <= 31){
			$current_date = $current_month .'/'. $start_day .'/'. $start_date_pieces[2];

			$query = "select Invoice_Number, Invoice_Date from bills where Invoice_Date = '$current_date';";

			$res = mysqli_query($link,$query) or die("selection error:" . mysqli_error($link));

			$row = mysqli_fetch_array($res);
			$current_Invoice = $row['Invoice_Number'];
			$line_counter = $line_counter + 1;

			$start_day = $start_day + 1;

			if($count = $res->num_rows){
	
			while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results

				if($current_Invoice != $row['Invoice_Number']){
					$sql= "INSERT INTO Invoice_Check (Invoice_Num, Inv_Lines, Inv_Date) VALUES ( '$current_Invoice' ,'$line_counter', '$current_date')";
					$res2 = mysqli_query($link,$sql) or die("insertion error:" . mysqli_error($link));
					$current_Invoice = $row['Invoice_Number'];
					$line_counter = 1;
				}
				else{
					$line_counter = $line_counter + 1;
				}
			}

			}

$res->free();


		}

		$current_month = $current_month + 1;
		$start_day = 1;
	}

	while($start_day <= $end_day){

		$current_date = $current_month .'/'. $start_day .'/'. $start_date_pieces[2];

			$query = "select Invoice_Number, Invoice_Date from bills where Invoice_Date = '$current_date';";

			$res = mysqli_query($link,$query) or die("selection error:" . mysqli_error($link));

			$row = mysqli_fetch_array($res);
			$current_Invoice = $row['Invoice_Number'];
			$line_counter = $line_counter + 1;

			$start_day = $start_day + 1;

			if($count = $res->num_rows){
	
			while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results

				if($current_Invoice != $row['Invoice_Number']){
					$sql= "INSERT INTO Invoice_Check (Invoice_Num, Inv_Lines, Inv_Date) VALUES ( '$current_Invoice' ,'$line_counter', '$current_date')";
					$res2 = mysqli_query($link,$sql) or die("insertion error:" . mysqli_error($link));
					$current_Invoice = $row['Invoice_Number'];
					$line_counter = 1;
				}
				else{
					$line_counter = $line_counter + 1;
				}
			}

			}

$res->free();


	}
}

?>