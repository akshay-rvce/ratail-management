<?php
session_start();
$email = $_SESSION['email'];
$bn=$_GET['branch_name'];
$np=$_GET['npss'];
$con=mysql_connect("localhost","root","mcamysql");
mysql_select_db("retail",$con);
//echo "$email $op $np";
$res=mysql_query("select manager_email_id from branch where shop_email_id='$email' and branch_name='$bn'") or die("error in fetching manager email id");
while($row=mysql_fetch_row($res))
{

					$res1=mysql_query("update branch  set password='$np' where manager_email_id='$row[0]'")or die("error in setting password");	
			
}
header("Location:home.php");
?>
