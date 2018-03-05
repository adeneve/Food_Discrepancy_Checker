<?php
$q = $_GET['q'];

require "dbconnect.php";
$db_selected = mysqli_select_db( $link, "foodused_SharkysIngredients") or die("cant connect to database". mysqli_error($link));



$sql="SELECT * FROM $q";
$result = mysqli_query($link,$sql);

echo "<table class='table' style='position:relative;'>
<tr>
<th>plu</th>
<th>name</th>
<th>Qty</th>

</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['plu'] . "</td>";
    echo "<td>" . $row['ItemName'] . "</td>";
    echo "<td>" . $row['Qty'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>