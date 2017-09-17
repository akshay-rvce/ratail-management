<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	if(isset($_SESSION['email'])||isset($_SESSION['bemail']))
	{
		header("Location:home.php");
	}
?>
<head>
  <title>Retail Manager</title>
  <meta charset="utf-8">
 <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
 
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
	
		  input{
			  width:100%;
			  height:100%;
			  }
	  </style>
	
</head>
<body style="background-image:url('web.jpg');">
<div class="page-header style="background-color:RGB(228,128,128);" >
	<h1 style="font-size:200%;">Retail Manager</h1>
	<p>We care your business</p>
	</div>
<div class="container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4" id="div1">
	  		<ul class="nav nav-tabs">
	    			<li class="active"><a data-toggle="tab" href="#admin">Shop</a></li>
	    			<li><a data-toggle="tab" href="#branch">Branch</a></li>
	  		</ul>
			<div class="tab-content">
				<div id="admin" class="tab-pane fade in active">
			  		<form action="test.php" role="form">
							  <form role="form">
								<div class="form-group">
									<label for="email">Email:</label>
										<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
								</div>
								<div class="form-group">
									<label for="pwd">Password:</label>
									<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pword">
								</div>
								<div class="checkbox">
									<label><input type="checkbox"> Remember me</label>
								</div>
								<button type="submit" class="btn btn-success">Sig-in</button>
								<a href="signup.html" class="btn btn-info" role="button">Sign-up</a>
								</form>
			  		</form>
				</div>
				<div id="branch" class="tab-pane fade">
			  		<form action="test_branch.php">
			     			 
					      			 <label>ShopName:</label><br/> 
						  		<input type="text" name="sname" ><br/>
							 <label for="email">Manager Email-id</label><br/> 
						  		<input type="email" name="bemail" ><br/>
						<label for="pwd"> Password</label><br/>
						  		<input type="password" name="pssword" ><br/><br/>
					       		<center><input type="submit" value="sign-in" class="btn btn-success" ></center>
			  		</form>
				</div>
			</div>
		</div>
	</div>
</div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>	
</body>
</html>
