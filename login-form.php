<?php
 $conn= mysql_connect("localhost",'root','') or die("cannot connect to localhost");
mysql_select_db("paytm") or die("cannot select database");
?>

<?php
if(isset($_POST["login"]))
{$i=1;

foreach($_POST as $key => $values)
{  
	if($values=="")
	{$i=0;
		}
	}
	if($i==1)
	{
		$sql="SELECT email,password FROM `paytm` WHERE email='".$_POST["username"]."'";
		echo $sql."<br>";
	$row = mysql_query($sql) or die("cant runn".mysql_error());
  while($r=mysql_fetch_array($row))
	{  $i=0;
		 if($r["password"]==$_POST["password"])
	      {//echo"log in successfull";
		  $error="0k";
		  
		  setcookie( "username", $r["email"], time()+3600);
	  setcookie( "password", $_POST["password"], time()+3600); 
	  header("Location:start.php");
		  }
	        
	  else{ //echo"password is incorrect";
	  $error=1;
          }
	}
	
	if($i)
	{// echo"you don't have a account for this email";
	$error=1;
	}
	
	//header("location:new.php");}
}else{
			//echo"something missed to enter";
			
			$error=2;}

}
// ****************************************   function to set value which are set by user in previous form**********************************  
	function setValue($field)
	{
		if(isset($_POST[$field]))
		{echo $_POST[$field];
			}
		}
		
        //***************************************validate form i.e. empty or not **********************************************
function valid($field,$form)
{
	if(isset($_POST["login"]) && $form==1)
 {
	if($_POST[$field]!="")
	{echo'<font color="#FFFFFF">';
	
	}
	else
	{ echo'<font color="#BD2F31">';}
	}	
	if(isset($_POST["signup"]) and $form==2)	 
	{
		if($_POST[$field]=="")
        {echo'<font color="red">';
	}
	else
	{ echo'<font color="#000000">';}
	
  }
}

?>


<!doctype html>
<html>
<head>
<link rel="stylesheet" href="form.css" type="text/css"> 
<meta charset="utf-8">
<title>Log In to Paytm</title>
</head>

<body bgcolor="#D2D5CD">
<?php
include'welcome.php';
?>
<div id="container" class="container">
<br><br>
<?php
if($error=="ok")
{
	echo'<div id="safe" class="cna" >';
	echo"U'r Logged in Successfully";
	echo"</div>";
	
	}


?>
<?php
if($error)
{  echo'<div id="error" class="error">';

if($error==1)
{
	echo"Please Check email or password is incorrect..!";
	}else if($error==2)
	{
		echo"Something missed to enter...!";}
echo"</div>";
}
?>

<div id="form" class="form">
<form method="post" action="login-form.php">
<div id="username">
<input type="email" placeholder="username" name="username"
class="input" value="<?php setvalue("username"); ?>"></div>
<div id="password">
<input type="password" placeholder="password" name="password" min-length="8"
class="input" value="<?php setvalue("password"); ?>">

</div>
<div id="button">
<input type="submit" name="login" value="Log In" class="Button">
</div>
</form>
</div>
<center>
  <strong><em>or</em></strong>
</center>
<div class="cna" id="cna"><strong><a style="color:#FFFFFF" href="createacc.php">Create New Account</a>
</strong></div><br>
<center><a href="forgotpass.php" >forgotten password?</a></center>

<br>

</div>
<br>
 <footer style="background-color:#A29596;" >
<br>
    <center>
    <pre>
<a href="help.html">help center </a>   |     <a href="aboutus.html">about us</a>   |  <a href="feedback.html">feedback</a><br><br><a href="termsnconditions.html">terms&conditions</a>
   <address>copyrights:2017-<?php echo date(y);?>
      <br>All rights reserved to Pavan Yewale
</address> 
   </center>
</footer>

</body>
</html>
