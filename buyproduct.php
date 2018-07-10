
<?php
 
include'welcome.php';	

if(!$id)
{ ?>
<meta http-equiv='refresh' content=";URL=login-form.php"/> 
<?php	}

//if(isset)

?>
<!doctype html>
<html>
<head>
<style>
.error1{
	
	margin-top: 15px;
	
	background-color: red;
	color: white;
	width: auto;
	border: thin  #640600;
	text-align: center;
	height: 17px;
	font-size: 13px;
	color-profile: white;
	text-emphasis-color: white;
	}

.details{
	
	width:40%;
	float:left;
	}
.details2{
width:60%;
float:right;
	
	}
#body{
width:1350px;	
	}
.container{
	clear:both;
	width:100%;
	}
</style>
<link rel="stylesheet" type="text/css" href="createacc.css">
<meta charset="utf-8">
<title>Add shipping Address</title>
</head>

<body>
	
<div class="container">

<?php
if(isset($_GET['success']))
{
echo'<div class="cna">Order placed Sucessfully</div>';
die();
}
$sql='select * from sell where id='.$_GET['id'];
$row=mysql_query($sql);
$data=mysql_fetch_array($row);

?>
<div class="details">
<img src="<?php  echo $data['photopath'].$data['id'].".jpg"; ?>" width="100%" height=auto>

</div>
<div class="details2">
<?php
$i=1;
if(isset($_POST['placeorder']))
{
	foreach($_POST as $key => $values)
{
	if($values=="")
	{
		$i=0;
		
		
		}
	}
if($i==0)
{
	echo'<div class="error1">please fill all the fields</div>';
	}
	else
	{
		
		
		$sql="INSERT INTO `paytm`.`shipping_details`(
`seller_id` ,`product_id` ,`mobile` ,`address` ,`name`,`uid`)VALUES ('".$data['seller_id']."', '".$data['id']."', '".$_POST['mobile']."', '".$_POST['shipping_address']."', '".$_POST['name']."','".$id."')";
echo $sql.'<br>';
mysql_query($sql) or die("cannot insert data in shipping details".mysql_error());
		$sql='update bank set amount=amount+'.$data['price']*0.05.' where accountno=1';
		echo $sql.'<br>';
		mysql_query($sql) or die("cannot update bank".mysql_error());
		$amount=$data['price']-$data['price']*$data['discount']+50;
		
		$amt=$data['price']-$data['price']*$data['discount']/100+50-$data['price']*0.05;
		if($data[4]!=0)
{   
	$price=$data[4]*$data[2]/100;
$price=$data[2]-$price;
$price=round($price);
}else
$price=$data[2];
$price=$price+50;
		$sql='update paytm set amount=amount-'.$price.' where userid='.$id;
		echo $sql.'<br>';
		mysql_query($sql) or die("cannot update table paytm".mysql_error());
		$sql='update paytm set amount=amount+'.
		$amt.'where id='.$data['seller_id'];
	echo $sql.'<br>';
		mysql_query($sql);
		$sql="Insert into passbook(userid,ttype,tdate,tamount,tfor) values ('".$data['seller_id']."','accepted for selling product','".date('d').'/'.date('m').'/'.date('y')."','".$data['price']."','".$_POST['name']."')";
		echo $sql.'<br>';
		mysql_query($sql) or die('cannot added to passbook '.mysql_error());
		?>
        <meta http-equiv='refresh' content=";URL=buyproduct.php?success=1"/>
        <?php
		}
	
	}

?>
<div class="fields"><font size="7px"><font color="#074600">
&nbsp;&nbsp;<?php echo $data['name'];?>
</font></font></div>
<div class="fields">
<font size="+1">&nbsp;&nbsp;</strong>Total Amount to Paid:
Rs.<?php if($data[4]!=0)
{   
	$price=$data[4]*$data[2]/100;
$price=$data[2]-$price;
$price=round($price);
}else
$price=$data[2];
echo $price+50;

 ?></div>
<?php
function setvalue($field)
	{
		if(isset($_POST[$field]))
		{echo $_POST[$field];
			}
		}

?>
<div >
 &nbsp;&nbsp;<font
 color="#0A44FF" size="6px">Shipping Details</font></div>
<div class="form">
<form method="post" action="buyproduct.php?id=<?php echo $_GET['id']; ?>">
 <div class="lbl"><label><strong>Name</strong></label></div>
 <div id="fname"><input name="name" type="text" placeholder="your  name" value="<?php setvalue("name"); ?>" class="input"></div>
 
<div class="lbl"><strong>Mobile No</strong></div>
    <input name="mobile" class="input" type="number" maxlength="10"placeholder="Mobile no" value="<?php setvalue("mobile"); ?>" >
<div class="lbl"><strong>Shipping Address</strong></div>

    <div><textarea class="textarea" name="shipping_address" placeholder=" Shippping Address"  ><?php setvalue("shipping_address"); ?></textarea></div>
  <input class="Button" type="submit" name="placeorder" value="place Order" >
</form>  </div>
</div>
</body>
</html>





<?php

include 'footer.php';

?>