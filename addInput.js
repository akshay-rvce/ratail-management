 counter=2;
    function addInput(divName){

              var newdiv = document.createElement('div');

              newdiv.innerHTML =  "<table><tr><td><input type='text' name='item_id["+counter+"]'></td><td><input type='text' name='item_name["+counter+"]'></td><td><input type='text' name='base_price["+counter+"]'></td><td><input type='text' name='sell_price["+counter+"]'></td><td><input type='text' name='quantity["+counter+"]'></td></tr></table>";

              document.getElementById(divName).appendChild(newdiv);

              counter++;

      

    }
