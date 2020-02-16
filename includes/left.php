<?php //include('inc/myconnect.php'); ?>
<?php //include('inc/function.php'); ?>
<div class="box">
     <div class="box_top">
     	<p>Hỗ trợ trực tuyến</p>		
     </div>
     <div class="box_main">
     	<div id="support">
        	<p><a href=""><img src="images/yahoo.png"></a><a href=""><img src="images/skype.png"></a></p> 	
        	<p>Hotline:&nbsp;<span>0919 405 624 - 0989 493 036</span></p>
        	<p>Email:&nbsp;hotro@ttm.edu.vn</p>
    	</div>
     </div>
</div>
<div class="box">
     <div class="box_top">
     	<p>Video</p>		
     </div>
     <div class="box_main">
     	<div id="video">
        	<div id="content_video">
                <?php 
                    $query_video_one="SELECT * FROM tblvideo ORDER BY ordernum DESC LIMIT 1";
                    $results_video_one=mysqli_query($dbc,$query_video_one);
                    $query_video_two=mysqli_fetch_assoc($results_video_one);
                    $str_one=explode('=',$query_video_two['link']);
                ?>
                 <iframe width="100%" height="162px" class="embed-player" src="http://www.youtube.com/embed/<?php echo $str_one[1]; ?>?rel=0&autoplay=0" frameborder="0" allowfullscreen></iframe>
                    <br />
                    <?php 
                        $query_video="SELECT * FROM tblvideo ORDER BY ordernum DESC";
                        $results_video=mysqli_query($dbc,$query_video);
                        kt_query($results_video,$query_video);
                                                   
                    ?>
					<ul class="list-video">
                        <?php 
                            while ($video=mysqli_fetch_array($results_video,MYSQLI_ASSOC)) 
                            { 
                                $str=explode('=',$video['link']);

                            ?>
                            <li><a style="cursor:pointer;" title="<?php echo $str[1]; ?>"><i class="fa fa-caret-right fw"></i>&nbsp;<?php echo $video['title']; ?></a></li>                        
                            <?php 
                            }
                        ?>
                    <script>                        
                        $(document).ready(function(){
                            $('.list-video li').click(function(){
                                $(this).parent().siblings('.embed-player').attr('src','http://www.youtube.com/embed/'+$(this).children('a').attr('title'));                                     
                            });
                        });
                    </script>
					</ul>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
    	</div>
     </div>
</div>
<div class="box">
     <div class="box_top">
     	<p>Bài viết mới nhất</p>		
     </div>
     <div class="box_main">
     	<ul id="baiviet_l">
            <?php
                $query_moi="SELECT * FROM tblbaiviet ORDER BY id DESC LIMIT 0,5";
                $results_moi=mysqli_query($dbc,$query_moi);
                while ($tin_n=mysqli_fetch_array($results_moi,MYSQLI_ASSOC)) 
                {
                ?>
                <li><a href="<?php echo $tin_n['id'] ?>-<?php echo LocDau($tin_n['title']); ?>.html" title="<?php echo $tin_n['title']; ?>"><?php echo $tin_n['title']; ?></a></li>
                <?php
                }
            ?>        	
    	</ul>
     </div>
</div>