<?php
	session_start();
	$bemail = $_SESSION['bemail'];
	$sname = $_SESSION['sname'];
	$bname=$_SESSION['bname'];
	$r1=$_GET['r1'];
	$r2=$_GET['r2'];
	$m=$_GET['m'];
	//echo "$r1 $r2 $m";
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$res=mysql_query("update `branch` set `request1`='$r1', `request2`='$r2', `request3`='$m',`r1_status`=0, `r2_status`=0 where manager_email_id='$bemail'") or die("Error   ".mysql_error());
	header("Location:branch_home.php");
