<?php
session_start();
	//$shop_email_id=$_SESSION['email'];
	//$shop_name=$_SESSION['shop_name']
	$_SESSION['branch_name']=$_GET['branch_name'];
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$b=$_SESSION['branch_name'];
	$e=$_SESSION['email'];
	$res=mysql_query("select manager_email_id from branch where branch_name='$b' and shop_email_id='$e'") or die("".mysql_error());
	while($row=mysql_fetch_row($res))
	{
		$_SESSION['bemail']=$row[0];
	}
?>
<html>
		<head>
			<title></title>
			<script src="addInput.js" language="Javascript" type="text/javascript"></script>
				 <link rel="stylesheet" href="css/bootstrap.min.css">
				<script src="js/jquery.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<style>
					td{
							min-width:200px;
						}
					</style>
		</head>
		<body style="background-image:url('web.jpg');">
			<div class="page-header">
					<h1 style="font-size:200%;">Retail Manager</h1>
					<p>We care your business</p>
			</div>
			<h3>Insert items</h3>
			<table>
				<tr><td><label>Item Id</labell></td><td colspan="3"><label>Item Name </label></td><td colspan="3"><label>Base price</label></td><td colspan="3"><label>Sell price</label></td><td colspan="3"><label>Quantity</label></td></tr>
				</table>
			<form  action="store.php">
				<!--<?php
						$b=$_SESSION['bemail'];
						echo "em=$b";
				?>*/-->
				<div id="dynamicInput">
					<table>
					<tr><td><input type="text" name="item_id[1]"></td>
					<td><input type="text" name="item_name[1]"></td>
					<td><input type="text" name="base_price[1]"></td>
					<td><input type="text" name="sell_price[1]"></td>
					<td><input type="text" name="quantity[1]"></td></tr></table>
				</div>
	<input type="submit" value="add item" name="add_item">
     <input type="button" value="Add another text input" onClick="addInput('dynamicInput');">
			</form>
		</body>
		
