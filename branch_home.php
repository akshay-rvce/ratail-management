<?php
session_start();
$bemail = $_SESSION['bemail'];
$sname = $_SESSION['sname'];
if( isset($bemail))
{
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$res=mysql_query("select branch_name from branch where manager_email_id='$bemail'");
	while($row=mysql_fetch_row($res))
	{
			$bname=$_SESSION['bname']=$row[0];
	}
	$res=mysql_query("select item_id  from stock where manager_email_id='$bemail'");
	while($row=mysql_fetch_row($res))
	{
		$stmt= $stmt."<option value='$row[0]'>$row[0]</option>";
	}
																	
	
	
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
	  var qty=new Array(100);
		 counter=2;
    function addItem(divName){
				 var xmlhttp = new XMLHttpRequest();
              var newdiv = document.createElement('div');
				var sq="<option value=\"$row[0]\">$row[0]</option>";
              newdiv.innerHTML =  "<table><tr><td><select type='text' name=\"itemid["+counter+"]\" id='itemid"+counter+"' onchange=\"update('"+counter+"')\">"+<?php echo "\"$stmt\"" ?>+"</td><td><input type='text' name=\"name["+counter+"]\" id='name"+counter+"' readonly></td><td><input type='text' name=\"amount["+counter+"]\" id='amount"+counter+"' readonly></td><td><input type='text' name=\"quantiy["+counter+"]\" id='quantiy"+counter+"' onchange=\"addquantity('"+counter+"')\"></td><td><input type='text' name=\"total["+counter+"]\" id='total"+counter+"' readonly></td></tr></table>";

              document.getElementById(divName).appendChild(newdiv);

              counter++;

    }
    
    function update(c)
    {
			//alert(counter);
			//alert("yes change it="+counter);
			 var xhttp;
			xhttp = new XMLHttpRequest();
			var name="itemid"+c;
			var iname="name"+c;
			var iamt="amount"+c;
			var total="total"+c;
			var str= document.getElementById(name).value;
			var foo= new Array(100);
			document.getElementById(iname).readonly=false;
			document.getElementById(iamt).readonly=false;
			document.getElementById(total).readonly=false;
			xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
			//alert(xmlhttp.responseText);
			foo = JSON.parse(xmlhttp.responseText);
			document.getElementById(iname).value=foo[0];
			document.getElementById(iamt).value=foo[1];
			qty[c]=foo[2];
			alert("qty["+c+"]"+qty[c]);
			//document.getElementById(total).value=foo[1]*foo[2];
    }
}
xmlhttp.open("GET","setvalues.php?vc="+str+"&bname="+"<?php echo "$bemail";?>",true);
xmlhttp.send();
			document.getElementById(iname).readonly=true;
			document.getElementById(iamt).readonly=true;
			document.getElementById(total).readonly=true;
	}
	
	function addquantity(c)
	{
		var q="quantiy"+c;
		var i="amount"+c;
		var t="total"+c;
		var s= document.getElementById(q).value;
		//alert(s);
		//alert(qty[c]);
		if(s>qty[c])
		{
				alert("Oops..! You dont have that much quantity");
				document.getElementById(q).value="";
		}
		else
		{
			document.getElementById(t).readonly=false;
			 var r=document.getElementById(i).value;
			 document.getElementById(t).value=r*s;
			 document.getElementById(t).readonly=true;
			}
	}

  </script>
  <style>
	  a{
		  max-width:100px;
		  }
		  	table,th,td{
				   border: 1px solid black;
				  	height: 50px;
				  	text-align: left;
				  	padding: 10px;
			}
			#mytextbox {
    font-weight: bold;
    font-size: 18px; 
    height: 4em;  
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
									<?php echo "<h3>Welcome $bname and team<br/></h3>";?>
									
									<ul class="nav nav-pills nav-stacked">
										<li class="active" class="btn btn-primary"><a data-toggle="pill" href="#dashboard">Dashboard</a></li>
										<li><a class="btn btn-primary" data-toggle="pill" href="#sell">Sell</a></li>
										<li><a class="btn btn-primary" data-toggle="pill" href="#inventory">Inventory</a></li>
										<li><a class="btn btn-primary" data-toggle="pill" href="#request">Request</a></li>
										<li><a class="btn btn-info" href="logout.php">logout</a></li>
									</ul>				
						</div>
			<div class="col-sm-8">						
						<div class="tab-content">
							<div id="dashboard" class="tab-pane fade in active">
								<!--dashboard board form design need to proocess query-->
								<br/>
								<br/>
								<label class="label label-default" style="font-size:125%">Total cost of stock inventory present:</label>
								<?php	$stock=mysql_query("select sum(s.sell_price*s.quantity) from stock s,branch b where s.manager_email_id='$bemail' and b.manager_email_id='$bemail' ");
															while($stock_sum=mysql_fetch_row($stock))
															{
																echo "<td>$stock_sum[0]</td>";
															}
								?>
								<br/><br/><br/><br/>
								<label class="label label-default" style="font-size:125%">Total sold inventory:</label>
								<?php
										$branch_sales=mysql_query("select sum(o.amount) from `order` o, sales s where o.inv_no=s.inv_no and s.manager_email_id='$bemail'") or die("Error in stock sum dashboard:".mysql_error());
															while($sales_sum=mysql_fetch_row($branch_sales))
															{
																echo "$sales_sum[0]<br/><br/><br/><br/>";
															}
								?>
								<br/><br/><br/><br/>
								
							</div>
							<div id="sell" class="tab-pane fade">
								<h3>Sales</h3>
								<p>Have to include billing module with dynamic forms</p>
								<form name="sales" action="sales.php">
									Customer Name:<input type="text" name="cname"/>
									<div id="dynamicinput">
										
										<table>
											<tr><td>Item_id</td><td>Item Name</td><td>Amount</td><td>Quantity</td><td>Total</td></tr>
											<tr><td>
													 <select id="itemid1" name="itemid[1]" onchange="update('1')">
																	<?php
																			echo "$stmt";
																		?>
													</select> 
											</td>
											<td><input type="text" id="name1" name="name[1]"  readonly></td>
											<td><input type="text" id="amount1" name="amount[1]" readonly></td>
											<td><input type="text" id="quantiy1" name="quantiy[1]" onchange="addquantity('1')"></td>
											<td><input type="text" id="total1" name="total[1]" readonly></td></tr></table>
									</div>
									<input type="button" value="Add another item" onClick="addItem('dynamicinput');">
									<input type="radio" name="mode" value="By cash"><b>By cash</b>  <input type="radio" name="mode" value="By card"> <b>By card</b>
									                    <b>Transaction id</b><input type="text" name="tra"><br/>
									<input type="submit" name="submit" value="Generate bill">
									</form>
							</div>
							<div id="inventory" class="tab-pane fade">
								<h3>inventory</h3>
										<?php
											$result = mysql_query("select * from stock where manager_email_id='$bemail'")or die("cant connect".mysql_error());
											if(mysql_num_rows($result)>0)
											{
											
											echo "<table class='table table-hover'>";
												echo "<thead><tr><th>item_id</th><th>item_name</th><th>base_price</th><th>sell_price</th><th>quantity</th></tr></thead><tbody>";
														while($row=mysql_fetch_row($result))
														{
															echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>"; 
														}									
														
					echo "</tbody></table>";
					}
					else
					{
							echo "<h2>Empty stocks...</h2>";
						}
					?>
							</div>
							<div id="request" class="tab-pane fade">
								<h3>Request</h3>
								<p>send required item list to shop owner</p>
								<div class="panel-group" >
									<div class="panel panel-default" style="background-color:#CCFFFF;">
										<form action="store_request.php">
											<table style="border:none;padding:none;">
												<tr style="border:none;padding:none;"><td style="border:none;padding:none;">Priority1</td><td style="border:none;padding:none;"><input type="text" name="r1"/></td></tr>
												<tr style="border:none;padding:none;"><td style="border:none;padding:none;">Priority2</td><td style="border:none;padding:none;"><input type="text" name="r2"/></td></tr>
												<tr style="border:none;padding:none;"><td style="border:none;padding:none;">Message</td><td style="border:none;padding:none;"><input type="text" id="mytextbox" name="m"/></td></tr>
												<tr style="border:none;padding:none;"><td style="border:none;padding:none;"><input type="submit" name="sbm" value="Send Inofrmation"/></td></tr>
												</table>
										</form>
									</div>
									<h3> My Request</h3>
									<p>requests pending(If there is no request means your request  is processed or there are no request from your side)</p>
									<div class="panel panel-default" style="background-color:#CCFFFF;">
												<?php
													$result = mysql_query("select request1,r1_status,request2,r2_status from branch where manager_email_id='$bemail'")or die("cant connect".mysql_error());
													while($row=mysql_fetch_row($result))
														{
															//echo "<label>Request1:</label>$row[0]";
															if($row[1]==0)
																echo "<label>Your request $row[0] is Pending</label><br/><br/>";
															else
																echo "<label>Your request $row[0] is Processed</label><br/><br/>";
				
															//echo "<br/><label>Request2:</label>"; 
															
															if($row[3]==0)
																	echo "<label> Your request $row[2] is Pending<br/><br/>";
															else
																echo "<label>Your request $row[2] is Processed </label><br/><br/>";
														}
												?>
												
									</div>	
								</div>
							</div>	
						</div>
									<a href="branch_sales_report.php">Show sales report</a>
			</div>



