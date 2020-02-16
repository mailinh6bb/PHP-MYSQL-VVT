<?php 
//if($_GET['st']=="Completed")
//{
 $item_transaction = $_GET['tx'];
 $item_price = $_GET['amt']; 
 $item_currency = $_GET['cc'];
 echo $item_no = $_GET['item_number'];
 
 //mysql_query("insert into payment_transaction values('','$item_transaction','$item_price','$item_currency','$item_no')");
 echo "Payment Done Successfully";
//}
?>