<?php
	session_start();
	$val=$_GET['vc'];
	$value=$_GET['bname'];
	$arr = array();
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$res=mysql_query("SELECT item_name,sell_price,quantity FROM `stock` where manager_email_id='$value' and item_id='$val'");
	while($row=mysql_fetch_row($res))
	{
			$arr[0]=$row[0];
			$arr[1]=$row[1];
			$arr[2]=$row[2];
	}
	//$arr[0] = "Mark Reed";
	//$arr[1] = "34";
	//$arr[2] = "Australia";

	echo json_encode($arr);
	//echo " hello $arr[0]";
	//echo "Hello";
	exit();
	
?>
