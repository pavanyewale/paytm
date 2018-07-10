<?php
include'welcome.php';
if(!$id)
{?>
	<meta http-equiv='refresh' content=";URL=login-form.php"/> 
	
	<?php }

?><!doctype html>
<html>
<style>
.container ul li{
	/* [disabled]margin-top: auto; */
	margin-right: 5px;
	margin-left: 5px;
	background-color:#130C27;
	
	/* [disabled]margin-bottom: auto; */
}
.container ul li a{
	color:#BCBBBB;	}


.container table th
{
	background-color:#015155;
	width:150px;
	 color:#FBFBFB;
	}
	.container table tr a{
		color:#2B1841;
		}
	.container table tr
{
	background-color:#946364;
	width:150px;
	align-content:center;
	}
	.container ul li a:hover{
		
		background-color:#803B3D;}
	.title{
		clear:both;
		
	width:100%;	
		}
</style>
<head>
<link rel="stylesheet" href="createacc.css" type="text/css"> 
<meta charset="utf-8">
<title>admin page</title>
</head>

<body bgcolor="#D2D5CD"><br>
<div id="container" class="container">

<?php


   


// ****************************************   function to set value which are set by user in previous form**********************************  
	function setValue($field)
	{
		if(isset($_POST[$field]))
		{echo $_POST[$field];
			}
		}
		
        
?>
<?php
if(isset($_GET["delete"]))
{
	$sql='select * from sell where id='.$_GET["delete"];
	$result=mysql_query($sql) or die('cannot run query'.mysql_error());
	while($data=mysql_fetch_array($result))
	{
		$image=$data['photopath'].$data['id'].".jpg";
	}
	
	
	$sql='delete from sell where id='.$_GET["delete"].' and seller_id='.$id;
	$ok=mysql_query($sql) or die("cannot delete".mysql_error());
	if($ok)
	{ unlink($image);
	}
	
	
	}

?>
<?php
if(isset($_GET["id"]))
{
	$n=1;
if($_GET["type"]=="ALL PRODUCTS")
{$sql="select * from sell where seller_id=".$id;}
else 
{
	$sql="select * from sell where category='".$_GET["type"]."' and seller_id=".$id;
	}

$sql=mysql_query($sql);

?>

	
	<div class="title"><font size="+3" color="#4E0063"><center>Your Items on Paytm for Sell</center></font></div><div>
  <center>
    <div class="cna">
    <a href="http://localhost/paytm/sell_on_paytm.php" style="font-color="white""
   ><font color="#FFFFFF">Add new Item</font></a></div>
  </center>

</div>
<br>
<div><ul><li><a href="sell_on_paytm.php?type=ALL PRODUCTS&id=1">ALL PRODUCTS</a></li><li>
  <a href="sell_on_paytm.php?type=MOBILE ACCESSORIES&id=1">MOBILE ACCESSORIES</a></li><li>
  <a href="sell_on_paytm.php?type=ELECTRONICS&id=1">ELECTRONICS</a></li><li>
  <a href="sell_on_paytm.php?type=MENS FASHION&id=1">MENS FASHION</a></li><li>
<a href="sell_on_paytm.php?type=WOMENS FASHION&id=1">WOMENS FASHION</a></li><li>
  <a href="sell_on_paytm.php?type=BAZAAR&id=1">BAZAAR</a></li>
  <li><a href="sell_on_paytm.php?type=HOME KITCHEN&id=1">HOME & KITCHEN</a></li><li>
  <a href="sell_on_paytm.php?type=BABY KIDS&id=1">BABY & KIDS</a></li></ul>
 <div></div>
<p>&nbsp;</p>
<center>
<table bordercolor="#000000" border="1px" cellpadding="4px" cellspacing="4px" align="center" frame="hsides" >
<th>
sr.no.
</th><th>name</th><th>price</th><th>contity</th><th>discount</th><th>Category</th><th>option delete</th>
<?php 
while($d=mysql_fetch_array($sql))
{?>
<tr><td><?php echo$n;?></td><td><?php echo $d['name'];?></td><td><?php echo $d['price'];?></td><td><?php echo $d['contity'];?></td><td><?php echo $d['discount'];?>%</td><td><?php echo $d['category'];?></td><td><a href='sell_on_paytm.php?id=1&type=<?php echo $_GET['type'];?>&delete=<?php echo $d['id'];?>'>delete</a></td></tr>

<?php
$n++;
}
$n--;
echo'<tr><td>Total:'.$n.'</td></tr></table>';
include'footer.php';	
die(); }
?>
</table>
</center>







<?php
if(isset($_POST["add"]))
{$i=1;


foreach($_POST as $key => $values)
{
	if($values=="")
	{$i=0;
		}
	}
	if($i==1)
	
	{  
	     
	/////////  insert information  
	$photopath=$_POST["category"]."/";
	$sql='insert into sell ( name,price,photopath,discount,description,contity,category,seller_id ) values ( "'.$_POST["name"].'",'.$_POST["price"].',"'.$photopath.'","'.$_POST["discount"].'","'.$_POST["description"].'",'.$_POST["contity"].',"'.$_POST['category'].'",'.$id.')';
	echo $sql;
	echo'<br>';
	$query=mysql_query($sql) or die("cannot insert data".mysql_error());
	if($query)
	{
		echo'inserted succeessfully';
		
		// uploading image to folder
		
		$sql='select max(id) from sell';
		$row=mysql_query($sql) or die("cannot select :".mysql_error());
		while($data=mysql_fetch_row($row))
		{
			$name=$data[0];
			}
$_FILES["image"]["name"]=$name.".jpg";
$target_dir = $photopath;
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
         $error ="File is not an image.";
        $uploadOk = 0;
    }
if($uploadOk)
{
// Check if file already exists
if (file_exists($target_file)) {
   
   $error= "Sorry, file already exists.";
    $uploadOk = 0;
}}
if($uploadOk)
{
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $error= "Sorry, your file is too large.";
    $uploadOk = 0;
}}
// Allow certain file formats

if($uploadOk)
{
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk) {
    $error="uploading";
// if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		$UPLOAD=1;
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			$error=0;
			?>
            <meta http-equiv='refresh' content=";URL=sell_on_paytm.php?upload=ok"/>
            <?php
			header("location:admin-paytm.php?upload=ok");
    } else {
		
       $error ="Sorry, there was an error uploading your file.";
    }
}
if($error)
{
	$sql='delete from sell where id='.$name;
	$query=mysql_query($sql) or die('cannot delte account'.mysql_error());
	echo'deleted successfully';
}

	}	
	
	}
	else{
			$error="something missed to enter";
			}


}
if(isset($_GET['upload']))
{
	echo'<div class="cna">uploaded successfully</div>';
	}
?>

<?php if($error)
{ echo'<div id="error" class="error">';

echo $error;
	
echo'</div>';
	}
	
?>
<div id="form" class="form">

<form method="post" action="sell_on_paytm.php" enctype="multipart/form-data" >
 <div class="lbl"><label><strong>Name</strong></label></div>
 <div id="fname"><input name="name" type="text" placeholder="first"  value="<?php setvalue("name"); ?>" class="input"></div>
 <div class="lbl"><label><strong>Category
</strong></label></div><div> <select  name="category" id="type" class="input"> 
<?php if(isset($_POST["add"]))
{
if($_POST["category"]!="")
{   
  echo'<option  value="'.$_POST["category"].'" selected="selected">'.$_POST["category"].'</option>';  }
else
{
	echo'<option value="" selected="selected">-- Select Category --</option>';}}
	else
	{echo'<option value="" selected="selected">-- Select Category --</option>';}			?>
								<option value="MOBILE ACCESSORIES">MOBILE ACCESSORIES</option>
                                                                <option value="ELECTRONICS">ELECTRONICS</option>
                                                                <option value="MENS FASHION">MENS FASHION</option>
                                                                <option value="WOMENS FASHION">WOMENS FASHION</option>
                                                                <option  value="HOME KITCHEN">HOME & KITCHEN</option>
                                                                <option  value="BABY KIDS">BABY & KIDS</option>							
 <option  value="BAZZAR">BAZZAR</option>
</select></div >
<div class="lbl"> <label><strong>Contity</strong></label>
 </div>
 <input name="contity"  class="input" type="number" placeholder="Available Contity" value="<?php setvalue("contity"); ?>">
 <div class="lbl"> <label><strong>price</strong></label>
 </div>
 <input name="price"  class="input" type="number" placeholder="price in rupees" value="<?php setvalue("price"); ?>">
  <div class="lbl"><strong>Discount</strong></div>
  <input name="discount"  class="input" type="float" placeholder="Discount in %" maxlength="2" value="<?php setvalue("discount"); ?>"><br>
 <div class="lbl"> <label>
    <strong>
     Description
    </strong></label></div><div class="textarea"><textarea class="textarea" name="description" placeholder="Description"  ><?php setvalue("description"); ?></textarea></div>
    <div class="lbl"><label><strong>Image</strong></label></div> 
 <div> <input class="input" type="file" name="image" value="<?php setvalue("image");?>" placeholder="browse image"></div>  
    <input class="Button" type="submit" name="add" value="Add" >
</form>
</div>
<div class="form">
  <center>
    <div class="cna">
    <a href="http://localhost/paytm/sell_on_paytm.php?type=ALL%20PRODUCTS&id=1" style="font-color="white""
   ><font color="#FFFFFF">Show All Data</font></a></div>
  </center>

</div>



</div>
<br>
</body>
</html>
<?php
include'footer.php';
?>
