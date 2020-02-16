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
				<div class="box_center_top_l"><p>Sản phẩm</p></div>
				<div class="box_center_top_r"></div>
				<div class="clearfix"></div>	
			</div>
			<div class="box_center_main">
				<div class="row">
					<?php 
						$query="SELECT * FROM tblsanpham";
						$results=mysqli_query($dbc,$query);
						kt_query($results,$query);
						while($sanpham=mysqli_fetch_array($results,MYSQLI_ASSOC))
						{
						?>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="sanpham_box">								
								<a href="" class="sanpham_box_img"><img src="<?php echo $sanpham['anh']; ?>"></a>
								<a href="" class="sanpham_box_name sanpham_box_id<?php echo $sanpham['id']; ?>" id="<?php echo $sanpham['id']; ?>"><?php echo $sanpham['ten']; ?></a>
								<p class="sanpham_box_gia">Giá:&nbsp;<?php echo number_format($sanpham['gia'],0,'.','.').'&nbsp;'.$sanpham['donvitinh']; ?></p>
								<a class="sanpham_box_order" id="addcart<?php echo $sanpham['id']; ?>">Thêm vào giỏ hàng</a>
							</div>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$("#addcart<?php echo $sanpham['id']; ?>").click(function(){
									var id=$(".sanpham_box_id<?php echo $sanpham['id']; ?>").attr('id');
									$.ajax({
										type: "POST",
										url: "addcart.php",
										data: {id : id},
										cache:false,
										success:function(results){
											alert("Sản phẩm đã được thêm vào giỏ hàng");
											window.location.reload();	
										}
									});
								});
							});
						</script>
						<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>