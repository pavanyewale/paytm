
<?php include'welcome.php'; 
if(!$id)
{ ?>
<meta http-equiv='refresh' content=";URL=login-form.php"/> 
<?php 
echo'You have to log in first....!';
die();	}
function setvalue($field)
	{
		if(isset($_POST[$field]))
		{echo $_POST[$field];
			}
		}
	
?>
<!doctype html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="createacc.css">

<meta charset="utf-8">
<title>PAYTM</title>
</head>

<body>
<div class="container">
<div class="form">
<br>
<br>
<?php
if(isset($_POST['confirm']))
{
	$sql='update bank set amount =amount+'.$_POST["amount"].' where accountno='.$_POST["accno"];
	 echo $sql;
                    $s=mysql_query($sql) or die("cannot update bank ".mysql_error());	
	                  if($s)
	                     {
							 
							  $sql='update paytm set amount=amount-'.$_POST['amount'].' where userid='.$id;
		  
							  $s=mysql_query($sql) or die('cannot update paytm'.mysql_error());
		                         if($s)
		                             {
$date=date("d").date("M").date("Y");
										 $sql="insert into passbook(userid,ttype,tdate,tamount,tfor) values (".$id.",'bank transfer','".$date."',".$_POST['amount'].",'".$_POST['accno']."')";
										 echo $sql;
										 
			
mysql_query($sql) or die("cannot update passbook ".mysql_error());
										 
										  ?>
										
<meta http-equiv='refresh' content=";URL=addmoney.php?id=bank&success=1"/>                              
                        <?php                
			                     die();
	header("location:addmoney.php?sucess=1");
			                          }
			                      else{
				                       $error='Trasaction failed';
				                       } 
							 
						 }else
						 {
							 $error='transaction failed';
							 }

}
?>
<?php
if(isset($_POST["addtobank"]))
{ 
$i=1;
foreach($_POST as $key =>$values)
{
	if($values=="")
	{$error='something missed to enter';
	$i=0;
	break;
	}
}

if($i==1)
{   
if($data[6]>$_POST['amount'])
{	$sql='select * from bank where accountno='.$_POST['accountno'];
	$result=mysql_query($sql) or die("cannot execute query".mysql_error());
   if($result)
     {
		  $data=mysql_fetch_row($result);
		  
		
			?>
            <div>
            <table>
            <tr><td>
           
           NAME</td><td>:&nbsp;  <?php echo $data[1]." ".$data[0];?></td></tr>
            
          <tr><td>  Account No.</td><td>:&nbsp;<?php echo $data[5];?></td></tr>
           
         <tr><td>   Amount</td><td>: &nbsp;<?php echo $_POST['amount'];?></td></tr>
    </table></div>
    <form method="post" action="addmoney.php">
    <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
    <input type="hidden" name="accno" value="<?php echo $_POST['accountno'];?>">
    <div>
    <input type="submit" class="Button" name="confirm" value="confirm"></div>
    </form>
            
            <?php  
			die();  
			  }
		  else
		  {
			  $error='please enter a valid account no';
			  }	
}
else
{
	$error='you dont have enough balance in paytm';
	}
	 
	 }
	 else
	 {
		 $error='something missed to enter.!';
		 }
	 }
		  ?>
<?php
if(isset($_POST["addtowallet"]))
{ 
$i=1;
foreach($_POST as $key =>$values)
{
	if($values=="")
	{$error='something missed to enter';
	$i=0;
	break;
	}
	}

if($i==1)
{
	$sql='select * from bank where atmno='.$_POST['atmno'];
	$result=mysql_query($sql) or die("cannot execute query".mysql_error());
   if($result)
     {
		  $data=mysql_fetch_row($result);
	   
          if($data[11]==$_POST["atmpassword"] && $data[7]==$_POST["cvvno"] && $data[8]==$_POST["month"] && $data[9]==$_POST["year"])
            { 
			
			 if($data[6]>$_POST["amount"])
                {
				 $sql='update bank set amount =amount-'.$_POST["amount"].' where atmno='.$_POST["atmno"];
                    $s=mysql_query($sql) or die("cannot update bank ".mysql_error());	
	                  if($s)
	                     {
							 
							  $sql='update paytm set amount=amount+'.$_POST['amount'].' where userid='.$id;
		                  
						      $s=mysql_query($sql) or die('cannot update paytm'.mysql_error());
		                         if($s)
		                             {
										 $date=date("d").date("M").date("Y");
										 $sql="insert into passbook(userid,ttype,tdate,tamount,tfor) values (".$id.",'added to wallet','".$date."',".$_POST['amount'].",'".$_POST['atmno']."')";
										 echo $sql;
										 
			
mysql_query($sql) or die("cannot update passbook ".mysql_error());
										  ?>
										
<meta http-equiv='refresh' content=";URL=addmoney.php?id=wallet&success=1"/>                              
                        <?php                
			                          header("location:addmoney.php?sucess=1");
			                          }
			                      else{
				                       $error='Trasaction failed';
				                       } 
							 
						 }else
						 {
							 $error='transaction failed';
							 }
					
				}
				else
				{
					$error='you do not enough balance in your bank account';
					}
			
			}
			else
			{
				$error='2222please enter correct information';
				}
		 
	 }
	 else
	 {
		 $error='1111please insert a correct information';
		 }
	
}
else
{
	$error='Something missed to enter';
	}
}?>
    
  <?php 
  if($error)
  {echo'<div class="error"><b>';
  echo $error.'
  </b></div>';
	  
	  }
	  if(isset($_GET['success']))
	  {
		  echo'<div class="cna"><b>Transaction successful.....!</b></div>';
		  }
  
  ?>  
  <?php if($_GET['id']=='wallet')
  {
	  ?>
<form method="post" action="addmoney.php?id=wallet">
<select class="input" name="amount">
<option value=''>--select money--</option>
<option value="10">10
</option>
<option value="20">
20
</option>
<option value="50">50
</option>
<option value="100">100
</option>
<option value="200">200
</option>
<option value="500">500
</option>
<option value="1000">1000
</option>
<option value="2000">2000
</option>
<option value="5000">5000
</option>
<option value="10000">10000
</option></select>
<input type="number" class="input" name="atmno" maxlength="16" placeholder="ATM number" value="<?php setvalue("atmno"); ?>">
<input type="password" placeholder="ATM Password" class="input" name="atmpassword" value="<?php setvalue("atmpassword"); ?>">
<input type="number" placeholder="CVV no" class="input" maxlength="3" name="cvvno" value="<?php setvalue("cvvno"); ?>">
<input type="number" class="date" placeholder="mm" maxlength="2" name="month" value="<?php setvalue("month"); ?>">
<input placeholder="yyyy" type="number" class="date" maxlength="4" name="year" value="<?php setvalue("year"); ?>">
<input type="submit" class="Button" name="addtowallet" value="ADD to Wallet">
<br>
<br>
</form>
<?php
  } ?>
  <?php
  if($_GET['id']=='bank')
  {
  ?>
  <form method="post" action="addmoney.php?id=bank">
<select class="input" name="amount">
<option value="">--select money--</option>
<option value="10">10
</option>
<option value="20">
20
</option>
<option value="50">50
</option>
<option value="100">100
</option>
<option value="200">200
</option>
<option value="500">500
</option>
<option value="1000">1000
</option>
<option value="2000">2000
</option>
<option value="5000">5000
</option>
<option value="10000">10000
</option></select>
<input type="text" class="input" placeholder="Account Holders Name" name="acountholdersname" value="<?php setvalue("acountholdersname"); ?>">

<input type="number" class="input" name="accountno" placeholder="Account number" value="<?php setvalue("accountno"); ?>">
<input type="text" placeholder="IFSC code" class="input"  name="ifsccode" value="<?php setvalue("ifsccode"); ?>">

<input type="submit" class="Button" name="addtobank" value="ADD to Bank">
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