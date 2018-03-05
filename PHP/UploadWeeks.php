<?php

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));



	$sql ="LOAD DATA LOCAL INFILE '../CSV_files/Weekbeginendcalc2016.csv' INTO TABLE Week_conversion
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'";

	mysqli_query($link,$sql) or die("Upload error:".mysqli_error($link));

 ?> <script>alert("Successfully uploaded into database"); window.location= '../homeinterface(admin).html';</script> <?php 







?>