<?php
 session_start();
$email = $_GET['email'];
$pass = $_GET['pword'];
echo "$email and $pass";
if( isset($email) || isset($pass) )
{
    if( empty($email) ) {
        die ("ERROR: Please enter email!");
    }
    if( empty($pass) ) {
        die ("ERROR: Please enter password!");
    }
	$con=mysql_connect("localhost","root","mcamysql") or die("cant connect".mysql_error());
	mysql_select_db("retail",$con) or die("cant connect".mysql_error());
	$result = mysql_query("SELECT * FROM shop WHERE email_id='" . $email . "' and password = '". $pass."'")or die("cant connect".mysql_error());
$count  = mysql_num_rows($result);
if($count==0) {
echo "Invalid Username or Password!";
} else {
echo "Welcome....! $email";
$_SESSION['email']=$email;
header("Location:home.php");
exit;
//echo "<a href=\"logout.php\">logout</a>";
}
 	
}?>
