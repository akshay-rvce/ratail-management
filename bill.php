<?php
	session_start();
	$sname=$_SESSION['sname'];
	$bname=$_SESSION['bname'];
	$cname=$_SESSION['cname'];
	$sname=$_SESSION['sname'];
	$inv=$_SESSION['inv'];
	$amt=$_SESSION['amt'];
	$dt=$_SESSION['dt'];
	$ti=$_SESSION['ti'];
	
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);?>
<!DOCTYPE html>
	<head>
			  <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
		th,td{
				   border: 1px solid black;
				  	text-align: left;
				  	padding: 5px;
			}
			table{
					border: 1px solid black;
					max-height: 100%;
				  	min-width:100%;
				}
	  </style>
	</head>
	<body>
		<body style="background-image:url('web.jpg');">
		<div class="page-header">
		<h1 style="font-size:200%;">Retail Manager</h1>
		<p>We care your business</p>
		</div>


	<?php
		echo "<label class=\"label label-default\" style=\"font-size:120%;\">Shop name: $sname    </label> ";
		echo "<label class=\"label label-default\" style=\"font-size:120%;text-align: right;\">Branch name:$bname    </label> <br/><br/>";
		echo "<label class=\"label label-default\" style=\"font-size:120%;\">Name:$cname </label>";
		echo "<label class=\"label label-default\" style=\"font-size:120%;text-align: right;\">Date:$dt</label><br/><br/>";
		echo "<label class=\"label label-default\" style=\"font-size:120%;\">Time:$ti</label>";
		echo "<label class=\"label label-default\" style=\"font-size:120%;text-align: right;\">Invoice number:$inv</label><br/><br/>";
		?>
	<table style="border: 1px solid black;
				  	padding: 10px;" class="table-condensed">
		<tr>
			<th>item name</th><th>Quantity</th><th>amount</th>
		</tr>
		<?php
					$res=mysql_query("SELECT *
FROM `order`
WHERE inv_no=$inv
LIMIT 0 , 30") or die("error".mysql_error());
					while($row=mysql_fetch_row($res))
					{
							echo "<tr><td>$row[3]</td><td>$row[6]</td><td>$row[7]</td></tr>";
					}
					echo "</table><br/>";
					echo "<label class=\"label label-info\" style=\"font-size:175%\">Total:$amt</label><br/>";
		?>
		<center><h3>Thank you....!</h3></center>
</body>
</html>
