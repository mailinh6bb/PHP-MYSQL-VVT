<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>
		<meta name='' content=''>
		<style type="text/css">
			#loading
			{
				display:none;				
				font-size:25px;
			}
			#success
			{
				color:green;
			}
			#invalid
			{
				color:red;
			}
			#error
			{
				color:red;
			}
			#error_message
			{
				color:blue;
			}			
		</style>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(e){
				$("#hososv").submit(function(){
					var hoten=$("#hoten").val();
					var diachi=$("#diachi").val();
					var dienthoai=$("#dienthoai").val();
					var file1=$("#file").val();					
				});				
				//load image
				$(function(){
					$("#file").change(function(){						
						$("#message").empty();
						var file = this.files[0];
						var imagefile = file.type;						
						var match = ["image/jpeg","image/png","image/jpg"];
						if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
						{
							$("#previewing").attr('src','noimage.png');
							$("#message").html("<p id='error'>Ảnh không đúng định dạng jpeg, jpg và png</p>");
							return false;							
						}
						else
						{
							var reader = new FileReader();
							reader.onload = imageIsLoaded;
							reader.readAsDataURL(this.files[0]);							
						}
					});
				});
				function imageIsLoaded(e){					
					$('#previewing').attr('src', e.target.result);
					$('#previewing').attr('width', '250px');
					$('#previewing').attr('height', '230px');
				};
			});
		</script>
	</head>
	<body>
		<div id="hososinhvien">
			<form id="hososv" name="frmhososv" method="POST" enctype="multipart/form-data">
				<table>
					<tr>
						<td><h1>Hồ sơ sinh viên</h1></td>
					</tr>
					<tr>
						<td>Họ tên</td>
					</tr>
					<tr>
						<td><input type="text" name="hoten" id="hoten" value=""></td>
					</tr>
					<tr>
						<td>Địa chỉ</td>
					</tr>
					<tr>
						<td><input type="text" name="diachi" id="diachi" value=""></td>
					</tr>
					<tr>
						<td>Điện thoại</td>
					</tr>
					<tr>
						<td><input type="text" name="dienthoai" id="dienthoai" value=""></td>
					</tr>
					<tr>
						<td><div id="image_preview"><img id="previewing" src="images/noimage.png" /></div>
							<hr id="line">
						</td>
					</tr>
					<tr>
						<td>Ảnh đại diện</td>
					</tr>
					<tr>
						<td><input type="file" name="file" id="file"></td>
					</tr>
					<tr>
						<td><input type="submit" value="Upload" class="submit" /></td>
					</tr>
				</table>
			</form>
			<h4 id="loading">loading..</h4>
			<div id="message"></div>
		</div>
	</body>
</html>