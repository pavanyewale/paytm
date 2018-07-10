<?php
include'welcome.php';
if(!$id)
{ ?>
<meta http-equiv='refresh' content=";URL=login-form.php"/> 
<?php	}
?>
<!doctype html>
<html>
<head>
<style>
.container{
	width:1350px;
	background-color:#D8D4D4;
	clear:both;
	}
	.container table th{
		
		background-color:#030456;
		color:#FFFFFF;
		width:200px;}
		.container table tr td{
			background-color:#E7C6C7;
			color:#1F1213;
			size:3px;}
</style>
<meta charset="utf-8">
<title>Paytm Cart</title>
</head>

<body>
<div class="container">
<center>
<div><font size="+3" color="#200043">Items in your Cart</font></div>
<?php $sql='select * from shipping_details where uid='.$id;
$result=mysql_query($sql) or die('cannot run query select '.mysql_error());
?>

<table><th>Product Name</th><th>Price</th><th>Delivary Info</th>
<?php 
$n=0;
while($row=mysql_fetch_array($result))
{  $sql='select * from sell where id='.$row['product_id'];
$n++;
$sell=mysql_fetch_array(mysql_query($sql));
  echo '
   <tr>
   <td>'.$sell['name'].'</td>
   <td>'.$sell['price'].'</td>
   <td>Delivered with in 3-4 days</td>

   </tr>';
    
	}
echo'<tr><td>Total:'.$n.'</td></tr>';

?>
</center>
</table></div>
<br>
</body>
</html>
<?php
include'footer.php';
?>