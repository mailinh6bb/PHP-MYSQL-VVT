<?php 
session_start();
include('inc/myconnect.php');
include('inc/router.php');
include('inc/function.php');
sitemap();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Xây dựng website</title>    
        <base href="<?php echo BASE_URL; ?>">
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/superfish.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/jquery1.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/wowslider.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/superfish.js"></script>
        <script>
            jQuery(document).ready(function(){
                jQuery('ul.sf-menu').superfish();
            });
        </script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
                 <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="header">
                    <div id="header">
                    <div id="logo">
                        <p><img src="images/logo.jpg"></p>
                    </div>  
                    <div id="giohang">
                        <a href="cart.php" title="Giỏ hàng">Giỏ hàng:&nbsp;(
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
                                if($ok!=2)
                                {
                                    echo '0';
                                }
                                else
                                {
                                    $item=$_SESSION['cart'];
                                    echo count($item);
                                }
                            ?>)
                        </a>
                    </div>
                    <div id="rss"><a href="rss"><img height="50" src="images/rss.png"></a></div>          
                 	<div id="menu">
                        <?php                             
                            menu_dacap();
                        ?>                 		
                 		<div class="clearfix"></div>
                 		<div id="search">
                 			<form name="frmsearch" method="GET" action="search.php">
                 				<input type="text" name="ten" value="" placeholder="Tìm kiếm từ khóa">
                 				<input type="submit" name="submit" value="Tìm kiếm">
                 			</form>		
                 		</div>
                 	</div>
                 </div>
                </div>
			</div>