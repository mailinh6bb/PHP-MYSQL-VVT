<?php
$iddm=$_GET['iddm'];	
$iddm1=explode('-',$iddm);
$dm=$iddm1[0];	 
if(isset($dm) && filter_var($dm,FILTER_VALIDATE_INT,array('min_range'=>1)))
{	
	$sql="SELECT id,danhmucbaiviet FROM tbldanhmucbaiviet WHERE id={$dm}";
	$query_a=mysqli_query($dbc,$sql);
	$dm_info=mysqli_fetch_assoc($query_a);
	?>	
	<div class="box_center">
		<div class="box_center_top">
			<div class="box_center_top_l">
				<a href="tinbycategory.php?dm=<?php echo $dm_info['id']; ?>" title="<?php echo $dm_info['danhmucbaiviet']; ?>"><?php echo $dm_info['danhmucbaiviet']; ?></a>
			</div>
			<div class="box_center_top_r"></div>
			<div class="clearfix"></div>
		</div>
		<div class="box_center_main">
			<?php 
				//đặt số bản ghi cần hiện thị
				$limit=5;
				//xác định vị trí bắt đầu
				if(isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))
				{
					$start=$_GET['s'];
				}
				else
				{
					$start=0;
				}
				if(isset($_GET['p']) && filter_var($_GET['p'],FILTER_VALIDATE_INT,array('min_range'=>1)))
				{
					$per_page=$_GET['p'];
				}
				else
				{
					//Nếu p không có, thì sẽ truy vấn CSDL để tìm xem có bao nhiêu page
					$query_pg="SELECT COUNT(id) FROM tblbaiviet WHERE danhmucbaiviet=".$dm."";
					$results_pg=mysqli_query($dbc,$query_pg);
					kt_query($results_pg,$query_pg);
					list($record)=mysqli_fetch_array($results_pg,MYSQLI_NUM);
					if($record > $limit)
					{
						$per_page=ceil($record / $limit);
					}
					else
					{
						$per_page=1;
					}
				}
				$query="SELECT * FROM tblbaiviet WHERE danhmucbaiviet=".$dm." ORDER BY id DESC LIMIT {$start},{$limit}";
				$results=mysqli_query($dbc,$query);
				kt_query($results,$query);
				while($baivietbv=mysqli_fetch_array($results,MYSQLI_ASSOC))
				{					
				?>
				<div class="row">
					<div class="tintuc_item">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<a href="<?php echo $dm_info['danhmucbaiviet']; ?>/<?php echo $baivietbv['id'];?>-<?php echo LocDau($baivietbv['title']); ?>.html" class="tintuc_item_img"><img src="<?php echo $baivietbv["anh_thumb"]; ?>"></a>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<a href="chitiet/<?php echo $baivietbv['id'];?>-<?php echo LocDau($baivietbv['title']); ?>.html" class="tintuc_item_title"><?php echo $baivietbv["title"]; ?></a>
							<p><?php echo $baivietbv["tomtat"]; ?></p>
							<a href="chitiet/<?php echo $baivietbv['id'];?>-<?php echo LocDau($baivietbv['title']); ?>.html">Xem chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php	
				}
				echo "<ul class='pagination'>";
				if($per_page > 1)
				{
					$current_page=($start / $limit) + 1;
					//Nếu không phải trang đầu thì hiện thị trang trước
					if($current_page !=1)
					{
						echo "<li><a href='danhmuc/".$dm."/".($start - $limit)."/".$per_page."-".$dm_info['danhmucbaiviet'].".html'>Back</a></li>";
					}
					//hiện thị những phần còn lại của trang
					for ($i=1; $i <= $per_page ; $i++) 
					{ 
						if($i!=$current_page)
						{
							echo "<li><a href='danhmuc/".$dm."/".($limit*($i-1))."/".$per_page."-".LocDau($dm_info['danhmucbaiviet']).".html'>{$i}</a></li>";
						}
						else
						{
							echo "<li class='active'><a>{$i}</a></li>";
						}
					}
					//Nếu không phải trang cuối thì hiện thị nút next
					if($current_page !=$per_page)
					{
						echo "<li><a href='danhmuc/".$dm."/".($start + $limit)."/".$per_page."-".LocDau($dm_info['danhmucbaiviet']).".html'>Next</a></li>";
					}
				}
				echo "</ul>";
			?>
		</div>
	</div>		
	<?php	
}
else
{
	header('Location:index.php');
	exit();
}
?>