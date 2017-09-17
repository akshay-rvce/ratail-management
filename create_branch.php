<?php
	session_start();
	$shop_email_id=$_SESSION['email'];
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$res=mysql_query("select shop_name from shop where email_id='$shop_email_id'");
	while($row=mysql_fetch_row($res))
	{
			$shop_name=$row[0];
	}
	$_SESSION['shop_name']=$shop_name;
	print "$shop_name";
	print "$shop_email_id";
	$manager_name=$_GET['manager_name'];
	$branch_name=$_GET['branch_name'];
	$branch_address=$_GET['branch_address'];
	$branch_city=$_GET['branch_city'];
	$branch_emailid=$_GET['branch_emailid'];
	$branch_phone=$_GET['branch_phone'];
	$branch_password=$_GET['branch_password'];
	print "<h1>Information stored $shop_name</h1>";
	$resl=mysql_query("INSERT INTO branch values(
	'$shop_name',
	'$shop_email_id',
	'$branch_emailid',
	'$branch_name',
	'$manager_name',
	'$branch_address',
	'$branch_city',
	$branch_phone,
	'$branch_password',
	NULL,NULL,NULL,NULL,NULL)") or die("".mysql_error());
	//header("Location:home.php");	
?>
