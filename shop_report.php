<?php
	session_start();
	$email=$_SESSION['email'];
	$bname=$_GET['branch_name'];
	$stype=$_GET['rtype'];	
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
								$res=mysql_query("select manager_email_id from branch where branch_name='$bname' and shop_email_id='$email'");
								while($row=mysql_fetch_row($res))
								{
										$bemail=$row[0];
								}
								echo "<center><h1>$stype Report</h1></center>";
								//echo "Manager email:$bemail<br/>";
								//echo "Branch name:$bname<br/>";	
				?>
				<table>
					
						<?php
								$report=0;
								if($stype=="sales")
								{
									echo "<tr><th>Invoice number</th><th>orderid</th><th>item_id</th><th>item_name</th><th>Base price</th><th>Sell price</th><th>quantity</th><th>amount</th><th>date</th><th>time</th></tr>";
									$res=mysql_query("SELECT o.inv_no, `orderid`, `item_id`, `item_name`, `base_price`, sell_price,`quantity`, `amount`,s.date,s.time FROM `order` o,sales s,branch b WHERE o.inv_no=s.inv_no and s.manager_email_id=b.manager_email_id and b.shop_email_id='$email' ") or die("Error".mysql_error());
									while($row=mysql_fetch_row($res))
									{			$report=$report+$row[5]*$row[6];
											echo "<tr><th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th><th>$row[4]</th><th>$row[5]</th><th>$row[6]</th><th>$row[7]</th><th>$row[8]</th><th>$row[9]</th></tr>";
										}
										echo "</table>";
										echo "<h3>Total sales:$report</h3>";
								}
								else
								{
									//echo "$bemail";
									 echo "<tr><th>item_id</th><th>item_name</th><th>Base price</th><th>Sell price</th><th>quantity</th><th>branch name</th></tr>";
									$res=mysql_query("SELECT distinct `item_id`, `item_name`, `base_price`, sell_price,`quantity`,b.branch_name FROM stock s,branch b WHERE s.manager_email_id=b.manager_email_id and b.shop_email_id='$email'") or die("Error".mysql_error());
									while($row=mysql_fetch_row($res))
									{			$report=$report+$row[3]*$row[4];
											echo "<tr><th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th><th>$row[4]</th><th>$row[5]</th></tr>";
										}
										echo "</table>";
										echo "<h3>Total stock:$report</h3>";
										
								}
						?>
					</table>
		</body>
		<html>

