<?php
		session_start();
		$bemail=$_SESSION['bemail'];
		$bname=$_SESSION['bname'];
?>
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
				<div class="page-header">
				<h1 style="font-size:200%;">Retail Manager</h1>
				<p>We care your business</p>
				</div>
				<?php
								$con=mysql_connect("localhost","root","mcamysql");
								mysql_select_db("retail",$con);
								echo "<center><h1>Sales Report</h1></center>";
								echo "Manager email:$bemail<br/>";
								echo "Branch name:$bname<br/>";	
				?>
				<table>
					<tr><th>Invoice number</th><th>orderid</th><th>item_id</th><th>item_name</th><th>quantity</th><th>amount</th><th>date</th><th>time</th></tr>
						<?php
								$report=0;
								$res=mysql_query("SELECT o.inv_no, `orderid`, `item_id`, `item_name`, `quantity`, `amount`,s.date,s.time FROM `order` o,sales s WHERE o.inv_no=s.inv_no and s.manager_email_id='$bemail'") or die("Error".mysql_error());
								while($row=mysql_fetch_row($res))
								{			$report=$report+$row[5];
											echo "<tr><th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th><th>$row[4]</th><th>$row[5]</th><th>$row[6]</th><th>$row[7]</th></tr>";
								}
								 echo "</table>";
								echo "<h3>Total sales:$report</h3>";
						?>
					</table>
		</body>
		<html>
