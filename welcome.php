<?php
 $conn= mysql_connect("localhost",'root','') or die("cannot connect to localhost");
mysql_select_db("paytm") or die("cannot select database");
if(isset($_COOKIE['username'])&&isset($_COOKIE['password']))
{ 
	$sql='select *  from paytm where email="'.$_COOKIE['username'].'"';
	$result=mysql_query($sql)or die('cannot run query'.mysql_error());
	$data=mysql_fetch_array($result);
	
	if($data['password']==$_COOKIE['password'])
	{
		$id=$data['userid'];
		
		}
	
	}
	



?>

<!doctype html>
<html>
<head>

<style>

*{
	margin-top: 0px;
	margin-right: 0px;
	margin-left: 0px;
	margin-bottom: 0px;
	padding: 0px;
	}
	.balance
	{
	color: #FFFFFF;
	float: right;
	width: auto;
	height: 30px;
	margin-top: 5px;
	margin-right: 5px;
	margin-left: 5px;
	margin-bottom: 5px;
		}
	.list{
	/* [disabled]width:100%; */
		}
#list ul li:hover
{
	background-color: #E8E3F0;
	color: #E11D09;
	}
.list
{
	margin-top: -5px;
	margin-right: 5%;
	margin-left: 5%;
	margin-bottom: 0%;
	height: 40px;
	width: 81%;
	border: 1px outset black;
	background-color: #E3DDDD;
	}
#list ul{
	align-content:center;
	align-items:center;
	align-self:center;}
#list ul  li{
	text-align: center;
	font-size: 17px;
	float: left;
	background-color: #EEE6F1;
	color: #000000;
	border: 2px solid white;
	list-style: none;
	background-size: 14px auto;
	align-content: center;
	width: 16%;
	height: 20px;
	font-style: italic;
	font-size: 16px;
	font-family: 'Yanone Kaffeesatz', arial, sans-serif;
	text-shadow: 1px 1px 0px #FFFFFF;
}
#list ul ul li{
	text-align: center;
	font-size: 17px;
	float: none;
	background-color:#FFF7F7;
	color: #000000;
	border:1px solid #000000;
	list-style: none;
	width: auto;
	height: auto;
	/* [disabled]margin-top: 0px; */
	background-size: 16px auto;
	align-content: center;
	width: 100%;
	height: auto;
}
#list ul ul{
display:none
;	
	}
	#list ul li:hover > ul{
		display:block;
		visibility:visible;
		position:relative;
		}
body{
	background-color:#FFFFFF;
	margin-left: -5px;
	margin-top: 0px;
}
.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 1; /* Stay on top */
    top: 0;
    left: 0;
    background-color: #111; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 16px;
    color: #818181;
    display: block;
    transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
	position: absolute;
	top: 0;
	right: 25px;
	font-size: 36px;
	margin-left: 50px;
	float: right;
	width: 8px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
    transition: margin-left .5s;
    padding: 20px;
}


/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
.profile{
	margin-top: 8px;
	margin-right: 9px;
	width: 32px;
	background-color: white;
	height: 32px;
	border-radius: 50%;
	float: right;
	}
.header{
	background-color: #1D1E72;
	width: 100%;
	margin-top: -6px;
	margin-left: -6px;
	margin-bottom: -5px;
	height: 50px;
	margin-right: 0px;
	font-size: 13px;
	}
.subheader{
	color: white;
	float: left;
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;
	width: 3pt;
	height: auto;
	margin-top: 5px;
	margin-right: 6px;
	margin-left: 15px;
	margin-bottom: 0px;
	font-size: 21pt;
	}
.menuicon{
	float: left;
	display: inline-block;
	margin-top: 9px;
	margin-left: 18px;
	cursor: pointer;
	}
	.bar1,.bar2,.bar3{
	width: 30px;
	height: 5px;
	margin-top: 19%;
	margin-right: 0px;
	margin-left: o;
	margin-bottom: 17%;
	background-color: #FFFFFF;
	transition: 0.4s;
		}.search
		
		{
	width: 54%;
	/* [disabled]height: 10px; */
	/* [disabled]margin-top: 3px; */
	margin-right: 3px;
	/* [disabled]margin-left: 3px; */
	border: thin solid #675353;
	/* [disabled]margin-bottom: 3px; */
}
	
	.searchb{
	/* [disabled]margin-top: -1px; */
	/* [disabled]margin-right: -1px; */
	margin-left: 1px;
	margin-bottom: 0px;
	color: white;
	width: 50px;
	/* [disabled]height: 10px; */
	background-image: auto;
	border: thin solid #766D6E;
	background-color: #564848;
		}	.change .bar1 {     -webkit-transform: rotate(-45deg) translate(-9px, 6px) ;     transform: rotate(-45deg) translate(-9px, 6px) ; } 
/* Fade out the second bar */ .change .bar2 {     opacity: 0; } 
/* Rotate last bar */ .change .bar3 {     -webkit-transform: rotate(45deg) translate(-8px, -8px) ;     transform: rotate(45deg) translate(-8px,
-8px) ; }

	.p{
		border-radius:50%;	
		}
		.t3{
	position: absolute;
	padding-top: -15px;
	padding-right: 0px;
	padding-left: 0px;
	padding-bottom: 0px;
	/* [disabled]margin-top: 5px; */
	margin-right: 45px;
	/* [disabled]margin-left: -2px; */
	background-color:#BCBBBB;
	float: left;
	margin-top: -55px;
	margin-right: px;
	margin-left: 31px;
	margin-bottom: -10px;
	font-size: 20px;
}


</style>
<meta charset="utf-8" name="viewport" content="width=device.width,initial-scale=1.0">
<title>paytm</title>
</head>
<body>
<div id="header" class="header">



 <div id="mySidenav" class="sidenav">
 <div class="t3">
 <font color="#0064FF" face="Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif">
 <?php
 
 if($id)
 {echo '<b>'.$data['name'].'</b>';
 echo "<br>₹.<b>".$data['amount']."</b>/-";
 
 
	}else
 {echo'<b>Hello</b><br>please'.'<a href="login-form.php">login</a>';
 } 
 ?>
 </font>
 </div><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
 <br><br> <a href="start.php">HOME</a>
 <a href="cart.php">Your Cart</a>
 <a href="sell_on_paytm.php">SELL ON PAYTM</a>
 <a href='orders.php'>View Orders</a>
  <a href="#">FEEDBACK</a><a href="#">ABOUT US</a>
<a href="#">HELP</a>
<?php
if($id){
echo'<a href="logout.php">LogOut</a>';
}?></div>

<!---- Use any element to open the sidenav -->
<span onclick="openNav()"><div id="menuicon" class="menuicon">
<div class="bar1"></div>
<div class="bar2"></div>
<div class="bar3"></div>

</div></span>

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->

<script>
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 
<div id="subheader" class="subheader">
  <B><font color="#E0F31B">Pay</font><font color="#4FC3DB">tm</font></B> </div>
  <div class="balance">
 <font size="+1">
<?php

if($id)
{ 
	
echo "paytm wallet<br>";
echo "Rs.<b>".$data['amount'].'</b>';
}else
	{ echo '<font size="+1">Hello<br>';
echo '<a href="login-form.php"><font color="white"><b>Login<b></font></a>/<a href="createacc.php"><b><font color="white">Create Account</font></b></a></font>';
	} ?>
</div>
</font>


<br>
<div id="search"><form style="width: 57%; margin-top: 0px; margin-right: 0px; margin-left: 0px; margin-bottom: 0px; height: 25px; float: right; font-size: smaller;" method="get">

<input type="search" placeholder="search" class="search" name="search"><input type="submit" value="search"class="searchb"></form></div>


</div>
<div id="list" class="list">
<ul>
<li>ADD MONEY 
  <ul>
  <a href="addmoney.php?id=wallet"><li>
    Add to Wallet
  </li></a><a href="addmoney.php?id=bank">
  <li>
    Add to Bank
  </li></a>
  </ul>
  
</li>


  <li>RECHARGE 
    
    <ul><a href='recharge.php?id=prepaid'><li>
      Mobile Prepaid
      </li></a>
      <a href='notnow.php?id=postpaid'><li>
        Mobile Postpaid</li></a>
      <a href='notnow.php?id=dth'><li>
        DTH
        </li></a>
      </ul>     
</li><a href="sendmoney.php">
<li> SEND MONEY </li>
</a>
<li>SHOP
  <ul>
    <a href="showselldata.php?type=ALL PRODUCTS"><li>ALL PRODUCTS</li></a>
    <a href="showselldata.php?type=MOBILE ACCESSORIES"><li>MOBILE ACCESSORIES</li></a>
    <a href="showselldata.php?type=ELECTRONICS"><li>ELECTRONICS</li></a>
    <a href="showselldata.php?type=MENS FASHION"><li>MENS FASHION</li></a>
    <a href="showselldata.php?type=WOMENS FASHION"><li>WOMENS FASHION</li></a>
    <a href="showselldata.php?type=BAZAAR"><li>BAZAAR</li></a>
    <a href="showselldata.php?type=HOME KITCHEN"><li>HOME & KITCHEN</li></a>
    <a href="showselldata.php?type=BABY KIDS"><li>BABY & KIDS</li></a>
    </ul>
</li>

<a href="passbook.php"><li>
PASSBOOK
</li></a>
  
</ul>
</div>
</div>

</body>
</html>
