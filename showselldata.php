<?php
include 'welcome.php';
?>

<?php $conn= mysql_connect("localhost",'root','') or die("cannot connect to localhost");
mysql_query('CREATE DATABASE paytm');
mysql_select_db("paytm") or die("cannot select database");

?>


<!doctype html>
<html>
<head>
<style>
.sell1
{ clear:both;
width:100%;	
	}
.stock
{
background-color:#ECECEC;
color:#630507;
width:150px;	
	}
.sell
{
	border:2px solid #535050;
	float: left;
	width: 150px;
	padding-top: 5px;
	padding-right: 10px;
	padding-left: 10px;
	padding-bottom: 9px;
	margin-top: 11px;
	margin-right: 11px;
	margin-left: 11px;
	margin-bottom: 11px;
	border: 1PX;
	height: 233px;
	}
	.discount
	{
	width: 150px;
	background-color: #F4E40F;
		}
	.name
	{
	background-color: #B8B3B3;
	width: 150px;
		}
		.image
		{
	width: 149px;
			}
			@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
.break{
	
	width:100%;
	height:10px;
	clear:both;
	background-color:#5E5C5C;}
</style>
<meta charset="utf-8">
<title> PAYTM </title>
</head>
<div class="break"></div>
<?php
if($_GET["type"]=="ALL PRODUCTS")
{$sql="select * from sell";}
else 
{
	$sql="select * from sell where category='".$_GET["type"]."'";
	}

$result=mysql_query($sql);

?>
<body>

<?PHP

echo'<div class="sell1">';

while($data=mysql_fetch_row($result))
{
?>
<a href="details_of_the_product.php?id=<?php echo $data[0] ?>">
<font color="#000000">
<div class="sell">
<div class="discount"><?php
echo $data[4];
?>
% OFF</div>
<div class="image">
<img  src="<?php  echo $data[3].$data[0].".jpg"; ?>" height="160" width="150">
</div>
<div class='name' ><?php  echo $data[1]; ?></div>
<div >Rs.
<?php if($data[4]!=0)
{   
	$price=$data[4]*$data[2]/100;
$price=$data[2]-$price;
$price=round($price);
}else
$price=$data[2];
echo $price;

 ?>/-
 <?php echo'&nbsp;&nbsp;
&nbsp;<font color="#646262">'; echo $data[2].'</font>';?>
</div>


<div class="stock">
<?php if($data[6]==0)
{echo'out of stock';
	
	}else{
echo'only &nbsp;';
echo $data[6]."&nbsp; left in stock";
	}?>
</div>
</div></font></a>
<?php } ?>

</div>
<div class="break"></div>
</body>
</html>
<?php
include'footer.php';
?>