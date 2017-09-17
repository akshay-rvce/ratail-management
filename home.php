<?php
session_start();
$email = $_SESSION['email'];
if( isset($email))
{
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$res=mysql_query("select owner_name,shop_name from shop where email_id='$email'");
	while($row=mysql_fetch_row($res))
	{
			$name=$_SESSION['name']=$row[0];
			$_SESSION['shop_name']=$row[1];
	}
	

	
	//echo "Welcome $email<br/>";
	//echo "<a href=\"logout.php\">logout</a>";
	
}
else
{
				header("Location:index.php");
}
?>
<html>
<head>
  <title>Retail Manager</title>
  <meta charset="utf-8">
 <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
 
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
		function checkb()
		{
				var b=document.getElementById("dbranch").value;
				return confirm("Are you sure you want to delete "+b+"?");
		}
		function checkpass(pass1,pass2)
		{
					//alert("In check pass");
					var p1=document.getElementById(pass1).value;
					var p2=document.getElementById(pass2).value;
					if(p1==p2)
						return true
					else
					{
							alert("new password did not get matched ");
							return false;
						}	
		}
	  </script>
  <style>
  #margin{
		border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: solid;
    height:200%;
	  }
	  #right {
    position: absolute;
    right: 2%;
    width: 44.5%;
    top:2.8%;
    height:23.3%;
}
	  #last {
    position: absolute;
    top:26%;
    width:96%;
}
	</style>
</head>
<body style="background-image:url('web.jpg');">
		<div class="page-header">
		<h1 style="font-size:200%;">Retail Manager</h1>
		<p>We care your business</p>
		</div>
		<div class="container">
			<div class="row">
						<div class="col-sm-4">
						<?php echo "<span class=\"glyphicon glyphicon-user\"></span>"."$name ";
						?>
						<a href="logout.php">logout</a><br/><br/>
						<span class="label label-success" style="font-size:125%;">Branch Score</span><br/><br/>
								<table class="table">
									<tr><th>Branch_name</th><th>Stock inventory</th><th>profit</th></tr>
									<?php
												$res=mysql_query("select branch_name,manager_email_id from branch where shop_email_id='$email' and branch_status=1");
												while($row=mysql_fetch_row($res))
												{
															echo "<tr><td>$row[0]</td>";
															$stock=mysql_query("select sum(s.sell_price*s.quantity) from stock s,branch b,shop sh where b.branch_status=1 and s.manager_email_id='$row[1]' and b.manager_email_id='$row[1]' and sh.email_id='$email' ");
															while($stock_sum=mysql_fetch_row($stock))
															{
																echo "<td>$stock_sum[0]</td>";
															}
															//echo "<td>Under construction</td></tr>";
															$profit=mysql_query("select sum((o.sell_price-o.base_price)*o.quantity) from branch b,shop sh,`order` o,sales s where b.branch_status=1 and o.inv_no=s.inv_no and s.manager_email_id='$row[1]' and b.manager_email_id='$row[1]' and sh.email_id='$email' ") or die("Error in profit sum:".mysql_error());
															while($profit_sum=mysql_fetch_row($profit))
															{
																echo "<td>$profit_sum[0]</td>";
															}
												}
									?>
									</table>
									<form action="branch_report.php">
										<h3>Branch reports</h3>
										<?php $res=mysql_query("select branch_name from branch where shop_email_id='$email' and branch_status=1") or die("error");
														
																	echo "Select branch:<select name=\"branch_name\" id=\"dbranch\">";
																	
																	while($row=mysql_fetch_row($res))
																	{
																
																			echo "<option value=\"$row[0]\">$row[0]</option>";
																			
																	}
																	echo "</select><br/>";
										?>
										<input type="radio" name="rtype" value="sales">Sales report
										<input type="radio" name="rtype" value="stock">Stock report<br/>
										<input type="submit" name="s" value="Show report">
										</form>
						</div>
						<div class="col-sm-8" id="margin">
							<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#dashboard">Dashboard</a></li>
							<li><a data-toggle="tab" href="#branch">Branch</a></li>
							<li><a data-toggle="tab" href="#setting">Setting</a></li>
							</ul>
							<div class="tab-content">
							<div id="dashboard" class="tab-pane fade in active">
								<!--dashboard board form design-->
								<br/>
								<br/>
								<label class="label label-default" style="font-size:125%">Total stock inventory:</label>
								<?php
										$shop_stock=mysql_query("select sum(s.sell_price*s.quantity) from stock s,branch b,shop sh where b.branch_status=1 and s.manager_email_id=b.manager_email_id and b.shop_email_id='$email' ") or die("Error in stock sum dashboard:".mysql_error());
															while($shop_sum=mysql_fetch_row($shop_stock))
															{
																echo "$shop_sum[0]";
															}
								?>
								<br/><br/><br/><br/>
								<label class="label label-default" style="font-size:125%">Sales:</label>
								<?php
										$shop_sales=mysql_query("select sum(o.sell_price*o.quantity) from `order` o, sales s,branch b,shop sh where b.branch_status=1 and o.inv_no=s.inv_no and s.manager_email_id=b.manager_email_id and b.shop_email_id='$email' ") or die("Error in stock sum dashboard:".mysql_error());
															while($sales_sum=mysql_fetch_row($shop_sales))
															{
																echo "$sales_sum[0]<br/><br/><br/><br/>";
															}
								?>
								<label class="label label-default" style="font-size:125%">Profit:</label>
									<?php
										$shop_profit=mysql_query("select sum((o.sell_price-o.base_price)*o.quantity) from `order` o, sales s,branch b,shop sh where b.branch_status=1 and o.inv_no=s.inv_no and s.manager_email_id=b.manager_email_id and b.shop_email_id='$email' ") or die("Error in stock sum dashboard:".mysql_error());
															while($profit_sum=mysql_fetch_row($shop_profit))
															{
																echo "$profit_sum[0]";
															}
								?>
								<br/><br/><br/><form action="shop_report.php">
									<h2>Reports</h2>
									<input type="radio" name="rtype" value="sales">Sales report
										<input type="radio" name="rtype" value="stock">Stock report<br/><br/>
										<input type="submit" name="s" value="Show report">
									</form>
							</div>
							<div id="branch" class="tab-pane fade">
									<!--branch board form design-->
										<div class="panel panel-group">
											<div class="panel panel-primary" style="background-color:#ccffff;width:400px;">
													<div class="panel-body">
													<span class="label label-primary" style="font-size:125%;">Launch a new branch</span>
													<br/><br/><form action="create_branch.php">
														<table>
														<tr><td>Manager Name</td><td><input type="text" name="manager_name"/></td></tr>
														<tr><td>Branch Name</td><td><input type="text" name="branch_name"/></td></tr>
														<tr><td>Address</td><td><input type="text" name="branch_address"/></td></tr>
														<tr><td>City</td><td><input type="text" name="branch_city"/></td></tr>
														<tr><td>Email Id</td><td><input type="email" name="branch_emailid"/></td></tr>
														<tr><td>Phone Number</td><td><input type="text" name="branch_phone"/></td></tr>
														<tr><td>Set password</td><td><input type="text" name="branch_password"/></td></tr>
														<tr><td><input type="submit" name="register_branch" value="Register"/></td></tr>
														</table>
													</form>	</div>
											</div>
										<div class="panel panel-primary" style="background-color:#ccffff" id="right">
											<div class="panel-body">
														<span class="label label-primary" style="font-size:125%;">Add inventory</span><br/><br/>
														<form action="add_inventory.php">
														<?php
															$con=mysql_connect("localhost","root","mcamysql");
															mysql_select_db("retail",$con);
															$res=mysql_query("select branch_name from branch where shop_email_id='$email' and branch_status=1");
														
																	echo "Select branch:<select name=\"branch_name\">";
																	
																	while($row=mysql_fetch_row($res))
																	{
																
																			echo "<option value=\"$row[0]\">$row[0]</option>";
																			
																	}
																	echo "</select>";
														?>
														<br/><input type="submit" value="Go" name="add_inventory"/>
														</form>
																 
											</div>
										</div>
										<div class="panel panel-primary" style="background-color:#ccffff;" id="last">
											<div class="panel-body">
												<span class="label label-primary" style="font-size:125%;">Branch Requests</span><br/><br/>
						<table class="table">
							<tr><th>Branch</th><th>Request1</th><th>Request2</th><th>Message</th><th>Processs</th></tr>
						<?php
											$res=mysql_query("select branch_name,request1,request2,request3,manager_email_id,r1_status,r2_status from branch where branch_status=1 and shop_email_id='$email'") or die("".mysql_error());
											while($row=mysql_fetch_row($res))
											{	
															if(($row[5]==0||$row[6]==0)&&($row[5]!=NULL||$row[6]!=NULL))
															 echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td><a href=\"process_request.php?b=$row[4]\">Process</td></tr>";
											}
						?>
						</table>
											</div>
										</div>
									</div>
									
							</div>
							<div id="setting" class="tab-pane fade">
									<form action="delete_branch.php" onsubmit="return checkb();">
										<h2>Shut down the branch</h2><br/>
												<?php
														$res=mysql_query("select branch_name from branch where shop_email_id='$email' and branch_status=1") or die("error");
														
																	echo "Select branch:<select name=\"branch_name\" id=\"dbranch\">";
																	
																	while($row=mysql_fetch_row($res))
																	{
																
																			echo "<option value=\"$row[0]\">$row[0]</option>";
																			
																	}
																	echo "</select>";
														
												?>
												<input type="submit" name="sub" value="Remove branch"/>
												
										</form>
										<form action="reset_password.php" onsubmit="return checkpass('snpss','srnpss') ">
											<h2>Reset your password</h2>
											<table>
											<tr><td>Enter old password</td><td><input type="password" name="opss"/></td></tr>
											<tr><td>Enter new password</td><td><input type="password" name="npss" id="snpss"/></td></tr>
											<tr><td>Re-enter new password</td><td><input type="password" name="rnpss" id="srnpss"/></td></tr></table>
											<input type="submit" name="subpss" value="Set passsword"/>
											</form>
											<form action="reset_branch_password.php" onsubmit="return checkpass('pass1','pass2') ">
												<h2>Reset branch password</h2>
													<?php
														$res=mysql_query("select branch_name from branch where branch_status=1 and shop_email_id='$email'");
														
																	echo "<table><tr><td>Select branch:</td><td><select name=\"branch_name\">";
																	
																	while($row=mysql_fetch_row($res))
																	{
																
																			echo "<option value=\"$row[0]\">$row[0]</option>";
																			
																	}
																	echo "</select></td></tr>";
														
												?>
												
											<tr><td>Enter new password</td><td><input type="password" name="npss" id="pass1"/></td></tr>
											<tr><td>Re-enter new password</td><td><input type="password" name="rnpss" id="pass2"/></td></tr></table>
											<input type="submit" name="subpss" value="Set passsword"/>
												</form>
							</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		
</body>
</html>
