<?php

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

$file = basename( $_FILES['fileToUpload']['name']);
$file_destination = "../ItemCountUploads/" . $file;
$FileType = pathinfo($file_destination,PATHINFO_EXTENSION);
$tmp_name = $_FILES['fileToUpload']['tmp_name'];


if(move_uploaded_file($tmp_name, $file_destination)){


	$sql ="LOAD DATA LOCAL INFILE '$file_destination' INTO TABLE Menu_Item_Count
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'";

	mysqli_query($link,$sql) or die("Upload error:".mysqli_error($link));

 ?> <script>alert("Successfully uploaded into database"); window.location= '../homeinterface(admin).html';</script> <?php 

}

else{
	?> <script> alert("there was an error uploading the file"); window.location= '../homeinterface(admin).html';</script><?php
}



?>