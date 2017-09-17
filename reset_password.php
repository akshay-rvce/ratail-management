<?php
session_start();
$email = $_SESSION['email'];
$op=$_GET['opss'];
$np=$_GET['npss'];
$con=mysql_connect("localhost","root","mcamysql");
mysql_select_db("retail",$con);
echo "$email $op $np";
$res=mysql_query("select password from shop where email_id='$email'");
while($row=mysql_fetch_row($res))
{
			echo "-----$row[0]----";
			if($row[0]==$op)
			{
					$res1=mysql_query("update shop  set password='$np' where email_id='$email'");	
			}
			else
			   echo "Password setting failed";
}
?>
