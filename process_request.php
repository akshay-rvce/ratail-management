<?php
	session_start();
	$b=$_GET['b'];
	$_SESSION['bemail']=$b;
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$res=mysql_query("select request1,request2,r1_status,r2_status from branch where manager_email_id='$b'") or die("Error");;
	while($row=mysql_fetch_row($res))
	{
			$r1=$row[0];
			$r2=$row[1];
			$rs1=$row[2];
			$rs2=$row[3];
	}
	
	
?>
<html>
		<head>
			<title></title>
			<script src="addInput.js" language="Javascript" type="text/javascript"></script>
				 <link rel="stylesheet" href="css/bootstrap.min.css">
				<script src="js/jquery.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<script>
							function myFunction()
							{
									 return confirm("Are your sure that this is the item(s) requested");
							}
					</script>
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
				<tr><td><label>Item Id</label></td><td><label>Item Name </label></td><td><label>Base price</label></td><td><label>Sell price</label></td><td><label>Quantity</label></td></tr>
				<form  action="grant_request.php" onsubmit=" return myFunction()">
								<?php
										if($rs1==0)
										{
												echo "<tr><td><input type=\"text\" name=\"item_id[1]\"></td>
					<td><input type=\"text\" name=\"item_name[1]\"></td>
					<td><input type=\"text\" name=\"base_price[1]\"></td>
					<td><input type=\"text\" name=\"sell_price[1]\"></td>
					<td><input type=\"text\" name=\"quantity[1]\"></td></tr>";
										}
													if($rs1==0)
										{
												echo "<tr><td><input type=\"text\" name=\"item_id[2]\"></td>
					<td><input type=\"text\" name=\"item_name[2]\"></td>
					<td><input type=\"text\" name=\"base_price[2]\"></td>
					<td><input type=\"text\" name=\"sell_price[2]\"></td>
					<td><input type=\"text\" name=\"quantity[2]\"></td></tr>";
										}
								?>
								</table>
								<input type="submit" value="store" name="sbm">
				</form>
			</table>
		</body>
</html>
