
<?php
include'welcome.php';
?>
<!doctype html>
<html>
<head>
<style>
.sell1
{
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
	border:1px thin #646060;
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





.container{
	
	width:100%;}
.details
{
	border: solid 1px #8D8D8D;
	width: 48%;
	height: auto;
	float: left;
	}
	#buy{
	background-color: #F37100;
	width: 30%;
	text-align: center;
	font-size: 30px;
	margin-left: 30%;
	border: solid 1px #000000;
	height: 35px;
	color: white;
		}
		.fields
		{
	margin-top: 7px;
	/* [disabled]margin-right: 7px; */
	margin-left: 25px;
	font-size:22px;
	margin-bottom: 17px;
			}
			#body{
				
				width:100%;}
				@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
.break{
	width: 100%;
	height: 21px;
	background-color: #555555;
	clear: both;
}
</style>
<link rel="stylesheet" href="createacc.css" type="text/css"> 
<meta charset="utf-8">
<title>datails of the product</title>
</head>

<body><br><br>
<div class="container">
<?php
$sql='select * from sell where id='.$_GET['id'];
$row=mysql_query($sql);
$data=mysql_fetch_array($row);

?>
<div class="details">
<img src="<?php  echo $data['photopath'].$data['id'].".jpg"; ?>" width="100%" height="auto">

</div>
<div class="details"><div class="fields"><font size="+4"><font color="#620103">
<?php echo $data['name'];?>
</font></font></div>
<div class="fields">
<font size="+3">
₹<?php echo $data['price'];?>/-</font>
</div>
<div class="fields">
<font size="4px">
Additional Rs.50/- shipping charges will applied.</font>
</div>
<div class="fields">
<?php echo $data['discount'];?>% discount
</div>
<div class="fields" style="border:1px solid #737171 ">
Description:
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $data['description'];?>
</p>
</div>
<div class="fields">
<a href="buyproduct.php?id=<?php echo $_GET['id']; ?>"><div id="buy">BuyNow
</div></a>
</div></div>
<div class='break'><font size="+3" color="#FFFFFF" style="animation:cubic-bezier(x1,y1,x2,y2); animation-delay:5;"><center>Similar products</center></font></div>
<?php
// *************simillar products**************


	$sql="select * from sell where category='".$data['category']."'";
	

$result=mysql_query($sql);

?>


<?PHP

echo'<div class="sell1">';

while($data=mysql_fetch_array($result))
{
?>
<a href="details_of_the_product.php?id=<?php echo $data['id'] ?>">
<font color="#000000">
<div class="sell">
<div class="discount"><?php
echo $data['discount'];
?>
% OFF</div>
<div class="image">
<img  src="<?php  echo $data['photopath'].$data['id'].".jpg"; ?>" height="160" width="150">
</div>
<div class='name' ><?php  echo $data['name']; ?></div>
<div >Rs.
<?php if($data['discount']!=0)
{   
	$price=$data['discount']*$data['price']/100;
$price=$data['price']-$price;
$price=round($price);
}else
$price=$data['price'];
echo $price;

 ?>/-
 <?php echo'&nbsp;&nbsp;
&nbsp;<font color="#646262">'; echo $data['price'].'</font>';?>
</div>


<div class="stock">
<?php if($data['contity']==0)
{echo'out of stock';
	
	}else{
echo'only &nbsp;';
echo $data['contity']."&nbsp; left in stock";
	}?>
</div>
</div></font></a>
<?php } ?>

</div>



<?php


 include 'footer.php';  ?>
</div>

</body>
</html>
