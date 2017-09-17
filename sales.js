 counter=2;
    function addItem(divName){
				alert("called")
              var newdiv = document.createElement('div');
				var sq="<option value=\"$row[0]\">$row[0]</option>";
              newdiv.innerHTML =  "<table><tr><td><select type='text' name='itemid["+counter+"]'><?php $res=mysql_query(/"select item_id  from stock where manager_email_id='$bemail'/"); while($row=mysql_fetch_row($res)){ echo"+sq+" } ?></td><td><input type='text' name='name["+counter+"]'></td><td><input type='text' name='amount["+counter+"]'></td><td><input type='text' name='quantity["+counter+"]'></td><td><input type='text' name='total["+counter+"]'></td></tr></table>";

              document.getElementById(divName).appendChild(newdiv);

              counter++;

    }
