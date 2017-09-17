<?php
 session_start();
 
$sname=$_GET['sname'];
$bemail = $_GET['bemail'];

$pass = $_GET['pssword'];
//echo "<h1>Hello</h1>";
if( isset($bemail) || isset($pass)|| isset($sname) )
{
    if( empty($bemail) ) {
        die ("ERROR: Please enter email!");
    }
    if( empty($pass) ) {
        die ("ERROR: Please enter password!");
    }
     if( empty($sname) ) {
        die ("ERROR: Please enter shop_name!");
    }
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$result = mysql_query("SELECT * FROM branch WHERE shop_name='" . $sname . "' and manager_email_id='" . $bemail . "' and password = '". $pass."'");
$count  = mysql_num_rows($result);
if($count==0) {
echo "Invalid Username or Password!";
} else {
echo "Welcome....! $email";
$_SESSION['bemail']=$bemail;
$_SESSION['sname']=$sname;

header("Location:branch_home.php");
exit;
//echo "<a href=\"logout.php\">logout</a>";
}
 	
}?>
