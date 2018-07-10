<?php
include'welcome.php';
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$result=mysql_query('select * from bank') or die('Cannot run qry'.mysql_error());
while($row=mysql_fetch_array($result))
{
	echo $row['atmpassword'].'<br>';
	}


?>
</body>
</html>