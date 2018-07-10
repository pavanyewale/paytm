<?php
 $conn= mysql_connect("localhost",'root','') or die("cannot connect to localhost");
mysql_select_db("paytm") or die("cannot select database");
?>
<?php include'welcome.php'; 
if(!$id)
{ ?>
<meta http-equiv='refresh' content=";URL=login-form.php"/> 
<?php	}
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
<?php
if(isset($_POST['confirm']))
{
	$sql='update paytm set amount =amount+'.$_POST["amount"].' where userid='.$_POST["userid"];
	 echo $sql;
                    $s=mysql_query($sql) or die("cannot update paytm ".mysql_error());	
	                  if($s)
	                     {
							 
							  $sql='update paytm set amount=amount-'.$_POST['amount'].' where userid='.$id;

							  $s=mysql_query($sql) or die('cannot update paytm'.mysql_error());
		                         if($s)
		                             {
$date=date("d").date("M").date("Y");
										 $sql="insert into passbook(userid,ttype,tdate,tamount,tfor) values (".$id.",'paytm to paytm transfer','".$date."',".$_POST['amount'].",'"."userid:".$_POST['userid']."')";
										 echo $sql;
										 
			
mysql_query($sql) or die("cannot update passbook ".mysql_error());

$sql="insert into passbook(userid,ttype,tdate,tamount,tfor) values (".$_POST['userid'].",'Received from Paytm','".$date."',".$_POST['amount'].",'".$_COOKIE['username']."')";
										 echo $sql;
										 
			
mysql_query($sql) or die("cannot update passbook ".mysql_error());
										 
										  ?>
										
<meta http-equiv='refresh' content=";URL=sendmoney.php?success=1"/>                              
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


<body>
<div class="container">
<div class="form">
<?php
if(isset($_POST['send']))
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
{if(strlen($_POST['mobileno'])==10)
{	$sql='select * from paytm where mobileno='.$_POST['mobileno'];
	$result=mysql_query($sql) or die("cannot execute query".mysql_error());
   if(mysql_fetch_array($result))
     {
		  $data=mysql_fetch_array($result);
		  
		
			?>
            <div>
            <table>
            <tr><td>
           
           NAME</td><td>:&nbsp;  <?php echo $data['name'];?></td></tr>
            
          <tr><td>  Gender</td><td>:&nbsp;<?php echo $data['gender'];?></td></tr>
           
         <tr><td>   Mobile no.</td><td>: &nbsp;<?php echo $_POST['mobileno'];?></td></tr>
         <tr><td> Amount to send </td><td>: &nbsp;<?php echo $_POST['amount'];?></td></tr>
    </table></div>
    <form method="post" action="sendmoney.php">
    <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
    <input type="hidden" name="userid" value="<?php echo $data['userid'];?>">
    <div>
    <input type="submit" class="Button" name="confirm" value="confirm"></div>
    </form>
            
            <?php  
			die();  
			  }
		  else
		  {
			  $error='please enter a valid mobile number of another person which u want to send a money';
			  }	
}else{
	$error='please enter a valid mobile number';
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
<br><br>
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

<br>
<form method="post" action="sendmoney.php">
<input type="number" class="input" placeholder="Enter Amount" name="amount" value="<?php setvalue("amount"); ?>">
  <input type="number" class="input" placeholder="Mobile 
No" name="mobileno" value="<?php setvalue("mobileno"); ?>">



<input type="submit" class="Button" name="send" value="SEND">
<br>
<br>
</form>


</div>
</div>
<?php 
include'footer.php';
?>


</body>
</html>