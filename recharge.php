
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="createacc.css">
<link rel="stylesheet" type="text/css" href="form.css">
<meta charset="utf-8">
<title>paytm</title>
</head>
<?php include'welcome.php'; 
if(!$id)
{
	?>
    <meta http-equiv='refresh' content=";URL=login-form.php"/>                              
	<?php }

function setvalue($field)
	{
		if(isset($_POST[$field]))
		{echo $_POST[$field];
			}
		}
	

?>
<?php
if(isset($_POST['recharge']))
{
	$i=1;
	foreach($_POST as $key=>$values)
	{
		if($values=="")
		{
			$i=0;
		}
	}
	
	if($i)
	{
		if(strlen($_POST["mobileno"])==10)
		{   
		
		$sql='update paytm set amount=amount-'.$_POST['amount'];
			mysql_query($sql) or die("cannot update paytm transaction failed");
			
						 $date=date("d").date("M").date("Y");
										 $sql="insert into passbook(userid,ttype,tdate,tamount,tfor) values (".$id.",'RECHARGE TO MOBILE','".$date."',".$_POST['amount'].",'".$_POST['mobileno']."')";
										 echo $sql;
										 
			
mysql_query($sql) or die("cannot update passbook ".mysql_error());
?>
<meta http-equiv='refresh' content=";URL=recharge.php?id=prepaid&success=1"/>

<?php
			
			}
			else
			{
				$error='please insert a valid mobile number';
				}
		
		
		}else
		{
			$error='something missed to enter';
			}
}
?>
<body>

<div class="container">
<div class="form"><br>
<?php 
  if($error)
  {echo'<div class="error"><b>';
  echo $error.'
  </b></div>';
	  
	  }
if(isset($_GET['success']))
{
	echo'<div class="cna">Recharge is Successful..!</div>';
	
	}	
?>
<br>

<?php
if($_GET['id']=='prepaid')
{	

?>
<form method="post" action="recharge.php?id=prepaid">
<select class="input" name="operator">
<option value=''>--select operator--</option>
<option value="Aircel">Aircel
</option>
<option value="Airtel">Airtel
</option>
<option value="BSNL">BSNL
</option>
<option value="IDEA">IDEA
</option>
<option value="RELIANCE">RELIANCE
</option>
<option value="Telenor">Telenor
</option>
<option value="vodafone">vodafone
</option>
<option value="TATA Docomo">TATA Docomo
</option>
<option value="MTNL">MTNL
</option>
<option value="MTS">MTS
</option></select>
<input type="number" class="input" name="mobileno" maxlength="10" placeholder="Mobile number" value="<?php setvalue("mobileno"); ?>">
<input type="number" placeholder="Amount" class="input" maxlength="10" name="amount" value="<?php setvalue("amount"); ?>">
<input type="submit" class="Button" name="recharge" value="PROCEED TO RECHARGE">
<br>
<br>
</form>
<?php
}

?>
</div>
</div>
<?php
include'footer.php';

?>
</body>
</html>