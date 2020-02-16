<?php 
//Kết nối với cơ sở dữ liệu
$dbc=mysqli_connect('localhost','root','','tutphp');
//Nếu kết nối không thành công thì in ra lỗi
if(!$dbc)
{
	echo "Kết nối không thành công";
}
else
{
	mysqli_set_charset($dbc,'utf8');	
}
?>