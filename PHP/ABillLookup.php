<html>
<head>
  <link rel="icon" href="https://pbs.twimg.com/profile_images/3596354243/36d8c7d11ff1e743dd3a8b18bf8be20a_400x400.png">
  <title>Sharky's Database</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/Styles.css">
<style>

</style>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="icon-bar"><img src="http://sharkys.gimmegrub.com/pages/images/sharkys/images/sharkys_logo.gif" style="width:100px;height:50px;"></span>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</head>
</html>

<?php
require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));

$store = mysqli_real_escape_string($link,$_POST[store]);
$start_date = mysqli_real_escape_string($link,$_POST[date1]);
$end_date = mysqli_real_escape_string($link,$_POST[date2]);
$P_num = mysqli_real_escape_string($link,$_POST[P_num]);
$Total_Qty = 0;

$start_date_pieces = explode(('/'), $start_date);
$end_date_pieces = explode(('/'), $end_date);

$start_day = $start_date_pieces[1];
$end_day = $end_date_pieces[1];
echo "<table class='table'>"; // start a table tag in the HTML
echo "<tr><td><p class='text-info'>" . "Quantity" . "</p></td><td><p class='text-info'>" . "Description" . "</p></td><td><p class='text-info'>" . "Date" . "</p></td></tr>";

if($start_date_pieces[0] == $end_date_pieces[0] && $start_date_pieces[1] <= $end_date_pieces[1]){
while($start_day <= $end_day){
$current_date = $start_date_pieces[0] .'/'. $start_day .'/'. $start_date_pieces[2];

if(strlen($P_num) <1){
$query = "select Qty_Ordered,Qty_Shipped,Sales_Uom,Product_Number,Description,Pack_Size,Label,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date';";
$res = mysqli_query($link,$query);
}
else{
  $query = "select Qty_Ordered,Qty_Shipped,Sales_Uom,Product_Number,Description,Pack_Size,Label,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date' and Product_Number = '$P_num';";
$res = mysqli_query($link,$query);
}

$start_day = $start_day + 1;

if($count = $res->num_rows){
	
while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['Qty_Ordered'] . "</td><td>" . $row['Description'] . "</td><td>" . $current_date . "</td></tr>";  //$row['index'] the index here is a field name
$Total_Qty = $Total_Qty + $row['Qty_Ordered'];
}

}

$res->free();
}
}


if($end_date_pieces[0] - $start_date_pieces[0] ==1){ //go up to day 31
while($start_day <= 31){
$current_date = $start_date_pieces[0] .'/'. $start_day .'/'. $start_date_pieces[2];

if(strlen($P_num) <1){
$query = "select Qty_Ordered,Qty_Shipped,Sales_Uom,Product_Number,Description,Pack_Size,Label,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date';";
$res = mysqli_query($link,$query);
}
else{
  $query = "select Qty_Ordered,Qty_Shipped,Sales_Uom,Product_Number,Description,Pack_Size,Label,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date' and Product_Number = '$P_num';";
$res = mysqli_query($link,$query);
}

$start_day = $start_day + 1;

if($count = $res->num_rows){
  
while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['Qty_Ordered'] . "</td><td>" . $row['Description'] . "</td><td>" . $current_date . "</td></tr>";  //$row['index'] the index here is a field name
$Total_Qty = $Total_Qty + $row['Qty_Ordered'];
}


}
$res->free();

}
$start_day = 1;
while($start_day <= $end_day){
$current_date = $end_date_pieces[0] .'/'. $start_day .'/'. $start_date_pieces[2];

if(strlen($P_num) <1){
$query = "select Qty_Ordered,Qty_Shipped,Sales_Uom,Product_Number,Description,Pack_Size,Label,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date';";
$res = mysqli_query($link,$query);
}
else{
  $query = "select Qty_Ordered,Qty_Shipped,Sales_Uom,Product_Number,Description,Pack_Size,Label,Price_Uom from bills where Customer_Number = '$store' and Invoice_Date = '$current_date' and Product_Number = '$P_num';";
$res = mysqli_query($link,$query);
}

$start_day = $start_day + 1;

if($count = $res->num_rows){
  
while($row = mysqli_fetch_array($res)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['Qty_Ordered'] . "</td><td>" . $row['Description'] . "</td><td>" . $current_date . "</td></tr>";  //$row['index'] the index here is a field name
$Total_Qty = $Total_Qty + $row['Qty_Ordered'];
}

}
$res->free();
}
}
echo "<tr><td><p class='text-info'>" . "Total Quantity:" . "</p>" . $Total_Qty . "</td></tr>";
echo "</table>"; //Close the table in HTML
?>
