<?php 
	header("Content-type: text/xml");
	include('../inc/myconnect.php');
	include('../inc/function.php');
?>
<?xml version="1.0" ?>
<rss version="2.0">
	<channel>
		<title>Lập trình viên PHP MYSQL</title>
		<link><?php echo BASE_URL; ?></link>
		<description>Thiết kế web là 1 nhu cầu cần thiết cho 1 danh nghiệp</description>
		<?php 
			$query="SELECT * FROM tblbaiviet";
			$results=mysqli_query($dbc,$query);
			kt_query($results,$query);
			if(mysqli_num_rows($results) > 0)
			{
				while($rss=mysqli_fetch_array($results,MYSQLI_ASSOC))
				{
				?>
				<item>
					<title><?php echo $rss['title']; ?></title>
					<link><?php echo BASE_URL.'baivietchitiet.php?id='.$rss['id']; ?></link>
					<description>
						<![CDATA[
							<a href="<?php echo BASE_URL.'baivietchitiet.php?id='.$rss['id']; ?>"><img width="130" height="100" src="<?php echo BASE_URL.$rss['anh_thumb']; ?>"></a>
							<br><?php echo $rss['tomtat']; ?>
						]]>						
					</description>
					<pubDate><?php echo $rss['ngaydang']; ?></pubDate>
				</item>
				<?php
				}
			}
		?>
	</channel>
</rss>