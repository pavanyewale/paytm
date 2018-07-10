<?php
 $conn= mysql_connect("localhost",'root','') or die("cannot connect to localhost");
mysql_select_db("personalprofile") or die("cannot select database");


   function confirm()
{
	 
	echo'<div class="container">';
	echo'<div class="form">';
	echo'<form method="post" action="forgotpass.php">';
	foreach($_POST as $key=>$values)
	{
		echo'<input type="hidden" name="'.$key.'" value="'.$values.'">';}
		$code=rand(100000,999999);
		$header="From:eplacement497@gmail.com";
		$to=$_POST["email"];
		$subject="confirmation of email for eplacement account";
		$body="Hiiiiii \n you just sign in to eplacement .This is email confirmation email.By entering the code you will finish the process of sign up and you will be the member of eplacement.\n The confirmation code is ".$code."\n <p>Thank u for visit us.........!</p>";
		$mail=mail($to,$subject,$body,$header);
		if($mail)
		{
			echo"mail sent successfully";
			}else
			{
				echo"<br>you are at localhost.  <br>  mail could not send ;0
				
				}
		
		
		
		
		echo'<input type="hidden" name="code" value="'.$code.'">';
		echo"<br>Enter the code sent to email address ".$_POST["email"];
		echo'<br>for trial code='.$code;
	
	if(isset($_POST["confirm"]))
{	if(($_POST['confirmcode']==""))
        {
			echo'<div class="error">';
			echo"please enter the code";
	echo'</div>';}
}
	echo'<div class="lbl"> confirm code</div><div id="code"><input class="input" type="varchar" name="confirmcode"> </div><div id="btn"><input type="submit" class="Button" name="confirm" ></div>';
	
		echo'</div></div>';
		include "footer.php";
	die();
	} ?>



<?php

// ****************************************   function to set value which are set by user in previous form**********************************  
	function setValue($field)
	{
		if(isset($_POST[$field]))
		{echo $_POST[$field];
			}
		}
		
        
?>


<!doctype html>
<html>
<head>
<link rel="stylesheet" href="createacc.css" type="text/css"> 
<meta charset="utf-8">
<title>Sign Up for Butterfly</title>
</head>

<body bgcolor="#D2D5CD">
<?php include "welcome.html";?>
<div id="container" class="container">

<div id="head" class="hdr"><strong>Find Password</strong></div>
<?php if(isset($_POST[confirm]))
{
if($_POST["confirmcode"]==$_POST["code"])
{
header("Location:forgotpass.php");
die();	}	else
	{
		if($_POST["confirmcode"]!="")
		{
		echo'<div class="error">';
		echo'entered code is wrong...!<br>please check email carefully for valid code'; 
		echo'</div>';}
		confirm();}
	}

//***********************************************************************************************//
?>

<?php
if(isset($_POST["sendotp"]))
{$i=1;


foreach($_POST as $key => $values)
{
	if($values=="")
	{$i=0;
		}
	}
	if($i==1)
	
	{
		$row=mysql_query("select email from person where email='".$_POST[email]."'");
		$k=0;
		if(mysql_fetch_array($row))
		{$k=1;}
		if($k)
	{
		
	confirm();
	}
	else{
		$error=2;
		//echo'<blink>Allready have an account for this email</blink>,<br>please check the email or log in with this email,<br> if you forgot password for this email account please click on "forgot password" link and change your password';
		}
	}
		else{
			$error=1;
			//echo"something missed to enter";
			}


}
?>

<?php if($error)
{ echo'<div id="error" class="error">';

if($error==1)
{echo"Something missed to enter";}
if($error==2)
{echo"Email not registered with us please enter valid email..!";
	}
	
echo'</div>';
	}
?>
<div id="form" class="form">

<form method="post" action="forgotpass.php">
 <div class="lbl"> <label><strong>Email</strong></label></div><input  type="email" value="<?php setValue("email");?>" name="email"  class="input"  placeholder="email addresss" >
  
 <div class="lbl">
   <input class="Button" type="submit" name="sendotp" value="send OTP" >
</div>
</form>
</div>
<div class="form">
<center> We will send mail to this email which contain the  confirmation code you have to use that code to change your password</center>

</div>



</div>
<br>
<?php include"footer.php";
?>
</body>
</html>
