<?php  
include('includes/header.php');
include('includes/slider.php');
?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="left">
		<?php include('includes/left.php'); ?>	
	</div>
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="center">
		<div class="box_center">
			<div class="box_center_top">
				<div class="box_center_top_l"><p>Thanh toán</p></div>
				<div class="box_center_top_r"></div>
				<div class="clearfix"></div>	
			</div>
			<div class="box_center_main">
				<br>
				<?php 
					$ok=1;
					if(isset($_SESSION['cart']))
					{
						foreach ($_SESSION['cart'] as $k => $v) 
						{
							if(isset($k))
							{
								$ok=2;
							}
						}	
					}
					if($ok == 2)
					{
					?>				
					<div id="order">
						<table>
							<tr>
								<th>Tên</th>
								<th>Ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Thành tiên</th>
								<th>Xóa</th>
							</tr>
							<?php 
								foreach ($_SESSION['cart'] as $key => $value) 
								{
									$item[]=$key;
								}
								$str=implode(",",$item);
								$query="SELECT * FROM tblsanpham WHERE id in ($str)";
								$results=mysqli_query($dbc,$query);
								kt_query($results,$query);
								$tongtien=0;
								while($cart=mysqli_fetch_array($results,MYSQLI_ASSOC))
								{	
									if(isset($_SESSION['cart'][$cart['id']])!=0)
									{									
									?>
										<tr>
											<td><?php echo $cart['ten']; ?></td>
											<td><img src="<?php echo $cart['anh']; ?>" width="150"></td>
											<td><?php echo number_format($cart['gia'],0,'.','.').'&nbsp;'.$cart['donvitinh']; ?></td>
											<td><?php echo $_SESSION['cart'][$cart['id']]; ?></td>
											<td><?php echo number_format($_SESSION['cart'][$cart['id']]*$cart['gia'],0,'.','.').'&nbsp;'.$cart['donvitinh']; ?></td>
											<td><a href="delete_cart.php?id=<?php echo $cart['id']; ?>"><img src="images/icon_delete.png" width="16"></a></td>
										</tr>
										<?php
										$tongtien+=$_SESSION['cart'][$cart['id']]*$cart['gia'];																		
									}
								}
							?>
							<tr>								
								<td colspan="6">Tổng tiền:&nbsp;<?php echo number_format($tongtien,0,'.','.'); ?>&nbsp;đ</td>
							</tr>							
						</table>
					</div>					
					<?php	
					}
					else
					{
						echo 'Bạn không có sản phẩm nào trong giỏ';
					}
				?>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

            <!-- Nhập địa chỉ email người nhận tiền (người bán) -->
            <input type="hidden" name="business" value="tungvu90@gmail.com">

            <!-- tham số cmd có giá trị _xclick chỉ rõ cho paypal biết là người dùng nhất nút thanh toán -->
            <input type="hidden" name="cmd" value="_xclick">

            <!-- Thông tin mua hàng. -->
            <input type="hidden" name="item_name" value="HoaDonMuaHang">
			<!--Trị giá của giỏ hàng, vì paypal không hỗ trợ tiền việt nên phải đổi ra tiền $-->
            <input type="hidden" name="amount" placeholder="Nhập số tiền vào" value="<?php echo round($tongtien/20000); ?>">
			<!--Loại tiền-->
			<input type='hidden' name='no_shipping' value='1'>
            <input type="hidden" name="currency_code" value="USD">
            <input type='hidden' name='handling' value='0'>
			<!--Đường link mình cung cấp cho Paypal biết để sau khi xử lí thành công nó sẽ chuyển về theo đường link này-->
            <input type="hidden" name="return" value="http://localhost:8080/xaydungweb/thanhcong.php">
			<!--Đường link mình cung cấp cho Paypal biết để nếu  xử lí KHÔNG thành công nó sẽ chuyển về theo đường link này-->
            <input type="hidden" name="cancel_return" value="http://localhost:8080/xaydungweb/loi.php">
            <!-- Nút bấm. -->            
            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
			</div>
		</div>
	</div>
</div>