<?php

require "dbconnect.php";

$sql = "INSERT into products( product_num, price_per_unit, Description, Inv_date )
select Distinct Product_Number, Unit_Price, Description, Invoice_Date from bills";

if(mysqli_query($con,$sql))
{ ?>
<script>alert('Load success!'); window.location= 'homeinterface.html';</script><?php

}
else
{
echo "Data insertion error...".mysqli_error($con);
}
