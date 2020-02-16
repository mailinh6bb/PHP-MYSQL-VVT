<?php include('includes/header.php'); ?>
<?php include('includes/slider.php'); ?>			
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="left">
	    <?php include('includes/left.php'); ?>   		
	</div>
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="center"> 
        <?php 
            if(isset($_GET['idTin']))
            {
                include('baivietchitiet.php');                
            }
            elseif(isset($_GET['iddm']))
            {
                include('tinbycategory.php');
            }
            else
            {
            ?>       
        		<div class="box_center">
                     <div class="box_center_top">
                        <div class="box_center_top_l">
                            <a href="">Pháp luật</a>     
                        </div>
                        <div class="box_center_top_r"></div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="box_center_main">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                        </div>  
                     </div>
                </div>
        		<div class="box_center">
                     <div class="box_center_top">
                        <div class="box_center_top_l">
                            <a href="">Thể thao</a>     
                        </div>
                        <div class="box_center_top_r"></div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="box_center_main">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                        </div>  
                     </div>
                </div>
                <div class="box_center">
                     <div class="box_center_top">
                        <div class="box_center_top_l">
                            <a href="">Giải trí</a>     
                        </div>
                        <div class="box_center_top_r"></div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="box_center_main">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tinhome_item">
                                <a href="" class="tinhome_item_img"><img src="images/tin1.jpg"></a>
                                <a href="" class="tinhome_item_name">Hoàng Thiên giúp Việt Nam thắng Indonesia</a>      
                            </div>
                        </div>  
                     </div>
                </div> 
            <?php 
            }
        ?>       				
	</div>						
    <?php include('includes/footer.php') ?>
	</body>
</html>