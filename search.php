<?php 
include('includes/header.php');
include('includes/slider.php');
?>
<div clas="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="left">
		<?php include('includes/left.php');?>
	</div>
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="center">
		<div class="box_center">
			<div class="box_center_top">
				<div class="box_center_top_l"><p>Tìm kiếm</p></div>	
				<div class="box_center_top_r"></div>
				<div class="clearfix"></div>
			</div>
			<div class="box_center_main">
				<br>
				<?php 
					if(isset($_REQUEST['submit']))
					{
						$search=$_GET['ten'];
						if(empty($search))
						{
							echo "<p>Yêu cầu nhập dữ liệu vào ô trống</p>";
						}
						else
						{
							$query="SELECT * FROM tblbaiviet WHERE title like '%$search%'";
							$results=mysqli_query($dbc,$query);
							kt_query($results,$query);
							while ($baivietbv=mysqli_fetch_array($results,MYSQLI_ASSOC)) 
							{
							?>
							<div class="row">
								<div class="tintuc_item">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
										<a href="baivietchitiet.php?id=<?php echo $baivietbv['id'];?>" class="tintuc_item_img"><img src="<?php echo $baivietbv["anh_thumb"]; ?>"></a>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
										<a href="baivietchitiet.php?id=<?php echo $baivietbv['id'];?>" class="tintuc_item_title"><?php echo $baivietbv["title"]; ?></a>
										<p><?php echo $baivietbv["tomtat"]; ?></p>
										<a href="baivietchitiet.php?id=<?php echo $baivietbv['id'];?>">Xem chi tiết</a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<?php	
							}
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>