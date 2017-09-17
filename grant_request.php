	<?php
	session_start();
		$branch_email_id=$_SESSION['bemail'];
	$shop_name=$_SESSION['shop_name'];
	$branch_name=$_SESSION['branch_name'];
	$item_id=$_REQUEST['item_id'];
	$item_name=$_REQUEST['item_name'];
	$base_price=$_REQUEST['base_price'];
	$sell_price=$_REQUEST['sell_price'];
	$quantity=$_REQUEST['quantity'];
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$n=count($quantity);
	
	for($i=1;$i<=$n;$i++){
		/*echo "'$item_id[$i]', 
	'$item_name[$i]',
	 $base_price[$i], 
	 $sell_price[$i],
	 $quantity[$i], 
	'$branch_name', 
	'$branch_email_id', 
	'$shop_name'<br/>";*/
	$r=mysql_query("INSERT INTO stock VALUES (
	'$item_id[$i]', 
	'$item_name[$i]',
	 $base_price[$i], 
	 $sell_price[$i],
	 $quantity[$i], 
	'$branch_name', 
	'$branch_email_id', 
	'$shop_name')")or die("Unable to connect".mysql_error());
	}
	$res=mysql_query("update `branch` set `r1_status`=1, `r2_status`=1 where manager_email_id='$branch_email_id'") or die("Error   ".mysql_error());
	header("Location:home.php");
	echo "Information stored<br/>";
	?>
