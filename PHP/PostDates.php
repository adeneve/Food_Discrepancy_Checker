<?php


require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_Sharkys") or die("cant connect to database". mysqli_error($link));



$sql="SELECT * FROM Week_conversion";
$result = mysqli_query($link,$sql);

echo "<table class='table' style='position:relative;'>
<tr>
<th>Week Number</th>
<th>Begin Date</th>
<th>End Date</th>

</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['weekNum'] . "</td>";
    echo "<td>" . $row['beginDate'] . "</td>";
    echo "<td>" . $row['endDate'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>