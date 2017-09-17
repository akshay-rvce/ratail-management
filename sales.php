<?php
	session_start();
	$sum=0;
	$inv=time();
	$date=date("Y-m-d");
	$time=date("h:i:sa");
	$cname=$_GET['cname'];
	$mode=$_GET['mode'];
	$tra=$_GET['tra'];
	$bemail=$_SESSION['bemail'];
	$sname=$_SESSION['sname'];
	$item_id=$_REQUEST['itemid'];
	$item_name=$_REQUEST['name'];
	$amt=$_REQUEST['amount'];
	$quantity=$_REQUEST['quantiy'];
	$tamt=$_REQUEST['total'];
	$orderid=$inv*3.142;
	$con=mysql_connect("localhost","root","mcamysql");
	mysql_select_db("retail",$con);
	$n=count($quantity);
	$r=mysql_query("insert into sales values($inv,'$cname','$bemail','$sname','$date','$time','$mode','$tra')") or die("Error salaes".mysql_error());
	for($i=1;$i<=$n;$i++){

		$res=mysql_query("select Quantity,base_price,sell_price from stock where item_id='$item_id[$i]' and manager_email_id='$bemail'") or die("Error stock".mysql_error());
		
		while($row=mysql_fetch_row($res))
		{
				$aq=$row[0];
				$bp=$row[1];
				$sp=$row[2];
				
		}
		if($aq>=$quantity[i])
		{
			echo "$aq-$quantity[$i]";
			$orderid=$orderid*3.142;
			//echo "$inv,'$item_id[$i]','$item_name[$i]',$quantity[$i],$amount[$i]";
			$r=mysql_query("INSERT INTO `order`(`orderid`, `inv_no`, `item_id`, `item_name`, `sell_price`, `base_price` ,`quantity`, `amount`) VALUES ($orderid,$inv,'$item_id[$i]','$item_name[$i]',$sp,$bp,$quantity[$i],$tamt[$i])")or die("Error order in if".mysql_error());
			$nq=$aq-$quantity[$i];
			$r=mysql_query("update stock set Quantity=$nq where item_id='$item_id[$i]' and manager_email_id='$bemail'")or die("Error".mysql_error());
			$r=mysql_query("DELETE 
									FROM `stock`
									WHERE Quantity<=0 and item_id='$item_id[$i]'")or die("Error".mysql_error());
			$sum=$sum+$tamt[$i];

		}
		else
		{
				die("Out of stock or invalid number of quanitiy");
			}
		
	}
	
	$_SESSION['cname']=$cname;
	$_SESSION['inv']=$inv;
	$_SESSION['amt']=$sum;
	$_SESSION['dt']=$date;
	$_SESSION['ti']=$time;
	echo "hello";
	header("Location:bill.php");	
	//echo "Information stored<br/>";
?>
