<?php
if(isset($_COOKIE['username']))
{

		  setcookie( username,"", time()+360);
	  setcookie( password, "", time()+360); 
	
	header("location:start.php");
	
	
	}
	
header("location:start.php");

?>