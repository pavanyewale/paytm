<?php
 $conn= mysql_connect("localhost",'root','') or die("cannot connect to localhost");
mysql_select_db("paytm") or die("cannot select database");
?>
<?php include'welcome.php'; 
if(!$id)
{ ?>
<meta http-equiv='refresh' content=";URL=login-form.php"/> 
<?php	}
if(isset($_GET['clear']))
{

	$sql='delete from passbook where userid='.$id;
	mysql_query($sql) or die('cannot clear data'.mysql_error());;
	
	}
?><!doctype html>
<html>
<head>
<link rel="stylesheet" href="createacc.css" type="text/css">
<style>
#t1 th{
	background-color:#4B4949;
	background-size:250px;
	width:180px;
	color:#FFFFFF;
	text-align:center;
	height:40px;
	}
	#t1 tr{
		
		text-align:center;
		background-color:#85CFCE;
		height:35px;}
</style> 
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<body bgcolor="#D2D5CD">
<div id="container" class="container">
<div class="form">
<?php
$sql='select * from passbook where userid='.$id;
$result=mysql_query($sql) or die("cannt access passbook".mysql_error());

?><br><br>
<table id="t1" cellpadding="4px" cellspacing="4px">
<th>Sr.no.</th><th>Transaction Type</th><th>Transaction Date</th><th>Transaction Amount</th><th>Account,mobile,other</th>
<?php
$n=0;
$amount=0;
while($row=mysql_fetch_row($result))
{	echo'<tr><td>'.++$n.'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td></tr>';
	$amount=$amount+$row[3];
	
	}
	echo'<tr><td>Total Transactions Amount: Rs.'.$amount.'/-</td><td><a href="http://localhost/paytm/passbook.php?clear=1">clear Record</td></td></tr>';
?>

</table><br><br></div></div>

<?php
include 'footer.php';
?>
</body>
</html>