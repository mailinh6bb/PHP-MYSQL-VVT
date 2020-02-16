<?php 
include('inc/function.php');
include('inc/myconnect.php');
$idbv=$_POST['idbv'];
$hoten=$_POST['hoten'];
$dienthoai=$_POST['dienthoai'];
$diachi=$_POST['diachi'];
$email=$_POST['email'];
$noidung=$_POST['noidung'];
//insert vào trong database
$query="INSERT INTO tblgopy(title,hoten,dienthoai,diachi,email,noidung,status)
		VALUES($idbv,'{$hoten}','{$dienthoai}','{$diachi}','{$email}','{$noidung}',0)";
$results=mysqli_query($dbc,$query);
kt_query($results,$query);		
?>