<?php

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

	$query = "TRUNCATE TABLE Menu_Items;";
    $res = mysqli_query($link,$query) or die("truncate error:" . mysqli_error($link));



	$sql ="LOAD DATA LOCAL INFILE '../CSV_files/Hollywmenuitemlisty16w32.csv' INTO TABLE Menu_Items
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'";

	mysqli_query($link,$sql) or die("Upload error:".mysqli_error($link));




?>