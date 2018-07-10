<?php

include 'welcome.php';
?>
<?php

if($id)
{?>
	<meta http-equiv='refresh' content=";URL=showselldata.php"/> 
	
	<?php }
   function confirm()
{
	 
	echo'<div class="container">';
	echo'<div class="form">';
	echo'<form method="post" action="createacc.php">';
	foreach($_POST as $key=>$values)
	{
		echo'<input type="hidden" name="'.$key.'" value="'.$values.'">';}
		$code=rand(100000,999999);
		$header="From:paytm497@gmail.com";
		$to=$_POST["email"];
		$subject="confirmation of email for eplacement account";
		$body="Hiiiiii \n you just sign in to eplacement .This is email confirmation email.By entering the code you will finish the process of sign up and you will be the member of eplacement.\n The confirmation code is ".$code."\n <p>Thank u for visit us.........!</p>";
		$mail=mail($to,$subject,$body,$header);
		if($mail)
		{
			echo"mail sent successfully";
			}else
			{
				echo"<br>you are at localhost.  <br>  mail could not send \n The demo mail is as follows<br>\n".$body;
				
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

if(isset($_POST[confirm]))
{
if($_POST["confirmcode"]==$_POST["code"])
{
	echo"code confirmation complete your code matched";
$name=$_POST["fname"].' '.$_POST['lname'];
	 $sql="insert into paytm (name,email,password,gender,mobileno,amount) values('".$name."','".$_POST["email"]."','".$_POST["cpassword"]."','".$_POST["gender"]."','".$_POST["mobile"]."',0) ";
	 mysql_query($sql) or die("cannot insert data".mysql_error());
	echo'<br>database is updated';
	setcookie( "username", $_POST["email"], time()+3600);
	  setcookie( "password", $_POST["cpassword"], time()+3600);  
	  ?>
      <meta http-equiv='refresh' content=";URL=createacc.php?success=1"/>
      <?php
	 // header("Location:welcome.php");
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
<title>paytm</title>
</head>

<body bgcolor="#D2D5CD">

<div id="container" class="container">

<div id="head" class="hdr"><strong>Sign up for <font color="#F7373A">pay</font><font color="#FFD00E">tm</font></strong></div>

<?php
if(isset($_POST["signup"]))
{$i=1;


foreach($_POST as $key => $values)
{
	if($values=="")
	{
		$i=0;
		
		
		}
	}
	if($i==1)
	
	{if($_POST["cpassword"]==$_POST["confirm_password"])
	{
		$row=mysql_query("select email from paytm where email='".$_POST[email]."'");
		$k=1;
		if(mysql_fetch_array($row))
		{$k=0;}
		if($k)
	{
		
	confirm();
	}
	else{
		$error=2;
		//echo'<blink>Allready have an account for this email</blink>,<br>please check the email or log in with this email,<br> if you forgot password for this email account please click on "forgot password" link and change your password';
		}}
		else{
			$error=3;
			//echo"Password don't match,please check the password and confirm password field should be same";
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
{echo"Allready have an account for this email...! <a href='login-form.php'>Log In</a> ";
	}
	if($error==3){
		echo"password and confirm password should be same...!";
		}
	
echo'</div>';
	}
?>
<div id="form" class="form">

<form method="post" action="createacc.php">
 <div class="lbl"><label><strong>Name</strong></label></div>
 <div id="fname"><input name="fname" type="text" placeholder="first" size="10" maxlength="10" value="<?php setvalue("fname"); ?>" class="input"></div>
 <input name="lname" class="input" type="text" placeholder="last" size="10" maxlength="10" value="<?php setvalue("lname"); ?>">
 <div class="lbl"> <label><strong>Gender</strong></label></div><div id="gender"><input type="radio" name="gender" value="male" <?php if(isset($_POST['signup']))
  {
if(isset($_POST["gender"]) && $_POST["gender"]=="male"){
	echo'checked="1"';}}?>> Male<input type="radio" name="gender" value="female"  <?php if(isset($_POST['signup']))
  {
if(isset($_POST["gender"]) and $_POST["gender"]=="female"){
	echo'checked="1"';}}?>>Female
    </div>
 <div class="lbl"> <label><strong>Email</strong></label></div><input name="email"  class="input" type="email" placeholder="email addresss" value="<?php setvalue("email"); ?>">
  <div class="lbl"><label><strong>New Password</strong></label></div>
  <input name="cpassword"  class="input" type="password" placeholder="password" maxlength="8"value="<?php setvalue("cpassword"); ?>"><br>
 <div class="lbl"> <label>
    <strong>
      Confirm Password
    </strong></label></div><input name="confirm_password" class="input" type="password" maxlength="8"placeholder="confirm-password" value="<?php setvalue("confirm_password"); ?>" >
    <div class="lbl"><strong>Mobile No</strong></div>
    <input name="mobile" class="input" type="number" maxlength="10"placeholder="Mobile no" value="<?php setvalue("mobile"); ?>" >
  <input class="Button" type="submit" name="signup" value="sign up" >
</form>
</div>
<div class="form">
<center> <a href="login-form.php">Allready have an account ?</a></center>

</div>


</div>
<br>
<?php include"footer.php";
?>
</body>
</html>
