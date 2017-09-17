<?php
session_start();
$branch=$_GET['branch_name'];
$email=$_SESSION['email'];
$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	echo "$branch";
	echo "---$email";
	$res=mysql_query("select manager_email_id from branch where shop_email_id='$email' and branch_name='$branch'") or die("Error in getting manager email id".mysql_error());
	while($row=mysql_fetch_row($res))
	{
			echo "$row[0]";
			$bemail=$row[0];
	}
	$res=mysql_query("update branch set branch_status=0 where manager_email_id='$bemail'") or die("Cant delete".mysql_error());
	header("Location:home.php");
?>
