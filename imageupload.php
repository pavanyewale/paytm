<?php
$conn=mysql_connect("localhost","root","")or die("cannot connect to database");
mysql_query("use personalprofile",$conn) or die("cannot create database".mysql_error());


$table=mysql_query("CREATE TABLE upload (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(30) NOT NULL,
 type VARCHAR(30) NOT NULL,
 size INT NOT NULL,
content MEDIUMBLOB NOT NULL,
 PRIMARY KEY(id)
 )",$conn);
?>
<html>
<head><title>
IMAGE UPLOADING
</title>
</head>
<body>
<?php
 if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
 {
 $fileName = $_FILES['userfile']['name'];
 $tmpName  = $_FILES['userfile']['tmp_name'];
 $fileSize = $_FILES['userfile']['size'];
 $fileType = $_FILES['userfile']['type'];

 $fp      = fopen($tmpName, 'r');
 $content = fread($fp, filesize($tmpName));
$content = addslashes($content);
 fclose($fp);

 if(!get_magic_quotes_gpc())
 {
     $fileName = addslashes($fileName);
 }

 $query = "INSERT INTO upload (name, size, type, content ) VALUES ('".$fileName."', '".$fileSize."', '".$fileType."','".$content."')";

mysql_query($query) or die('Error, query failed'.mysql_error()); 


 echo "<br>File $fileName uploaded<br>";
 } 
 


?>

<form method="post" enctype="multipart/form-data" action="imageupload.php">

 <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
 <tr> 
 <td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
 <input name="userfile" type="file" id="userfile"> 
 </td>
 <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
 </tr>
 </table>
 </form>
</body>
</html>