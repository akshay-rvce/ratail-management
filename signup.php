<?php
	$email=$_GET['email_id'];
	$name=$_GET['name'];
	$oname=$_GET['owner_name'];
	$gender=$_GET['gender'];
	$city=$_GET['city'];
	$address=$_GET['address'];
	$pword=$_GET['pword'];
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	print "<h1>Information stored</h1>";
	$resl=mysql_query("INSERT INTO `shop`(`email_id`, `shop_name`, `owner_name`, `gender`, `address`, `city`, `password`) VALUES ('$email','$name','$oname','$gender','$city','$address','$pword')");
	header("Location:index.php");	
?>
