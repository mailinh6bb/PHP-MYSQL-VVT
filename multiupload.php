<?php error_reporting(0);?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>
		<meta name='' content=''>
		<style type="text/css">
			#sortable li 
			{
			    float: left;
			    list-style: none;
			    margin: 5px;
			    padding: 2px;		
			    position:relative;
			    border: 1px solid #DDDDDD;
			    background:#E6E6FA;
			}
			#sortable li .img-thumb 
			{
			    cursor: move;
			    margin: 0;
			    padding: 0;	
			}
			#sortable 
			{
			    display: block;			    
			    overflow: hidden;
			    padding: 10px;
			    margin-top: 5px;
			}
			#sortable .img-delete 
			{
			    display: none;
			    position: absolute;
			    top:0px;
			    right:0px;
			    cursor: pointer;
			    margin: 5px;
			}	
			#sortable a.remove 
			{
			    display: block;
			    float: right;
			    padding: 5px 5px;
			    color:red;
			    text-decoration: none;
			}
			#sortable a.remove:hover 
			{
			    text-decoration: underline;
			}
			#sortable li:hover .img-delete,#sortable li:hover .input-default
			{
			   display:block;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/uploadify.css" media="all" /> 
		<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
		<script src="js/jquery.uploadify.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			include('inc/myconnect.php');
			include('inc/function.php');
			include('inc/images_helper.php');
			if(isset($_POST['submit']))
			{
				$ten=$_POST['ten'];
				$images1=json_encode($_POST['image_filename']);
				if(!empty($images1))
				{
					$loc=str_replace('"','',$images1);
					$loc2=str_replace('[','',$loc);
					$loc3=str_replace(']','',$loc2);
					$exp=explode(',',$loc3);
					foreach ($exp as $itexp) 
					{
						$tmp = 'tmp/'.$itexp;
						if(file_exists($tmp))
						{
							if(copy($tmp,'upload/'.$itexp))
							{
								//xu ly resize
								$name_img ='upload/'.$itexp;
								$imageThumb = new Image($name_img);
								$temp = explode('.',$itexp);
								$thumb_path = $itexp;
								if($imageThumb->getWidth() >700)
								{
									$imageThumb->resize(700,'resize');
								}
								$imageThumb->save($temp[0], './upload/resized');
							}
							else
							{
								echo 'Không thể copy file';	
							}
							unlink($tmp);
						}						
					}
				}
				$query="INSERT INTO tblalbumanh(ten,anh)
					VALUES('{$ten}','{$images1}')";
				$results=mysqli_query($dbc,$query);
				kt_query($results,$query);
				if(mysqli_affected_rows($dbc)==1)
				{
					echo "Thêm mới thành công";
				}
				else
				{
					echo "Thêm mới không thành công";
				}
			}
		?>
		<form name="frmuploadanh" method="POST"enctype="multipart/form-data">
			<h3>Upload nhiều ảnh</h3>
			<table>
				<tr>
					<td>Tên Album</td>
				</tr>
				<tr>
					<td><input type="text" name="ten" value=""></td>
				</tr>
				<tr>
					<td>Ảnh</td>
				</tr>
				<tr>
    				<td>
						<div class="row-field">
           					<div class="field-content">
              					<div id="portfolio" class="block-input-append">                   
                   					<div class="title-clear"></div>
                   					<div id="queue"></div>
                   					<input id="file_upload" name="file_upload" type="file" multiple="true"/>                    
               						<ul id="sortable">  
                                        <div class="ci-message"></div>
                                        <?php 
                                        if(!empty($_POST['file_upload']))
                                        {
                                        	?>
                                        	<?php
                                        	$images1 =json_decode($_POST['file_upload']); 
                                            if(is_array($images1) && count($images1)>0)
                                            {
                                                foreach($images1 as $image1) 
                                                {	
                                                ?>
                                                    <li>                                       
                                                        <img class="img-thumb" width="131px"
                                                               src="<?php echo  BASE_URL.'upload/resized'.'/' . $image1; ?>" />                                                                                                       
                                                        <input type="hidden" name="image_filename[]"
                                                               value="<?php echo $image1 ?>" /> <br />			                                                           
                                                        <a href="javascript:void(0)" class="remove" onclick="removeImage(this)" >Remove</a>
                                                    </li>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>                        
                                    </ul>
                                </div>			
                    		</div>
                    	</div>
					</td>	
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Thêm"></td>
				</tr>				
			</table>
		</form>
		<?php 
			$query2="SELECT * FROM tblalbumanh";
			$results2=mysqli_query($dbc,$query2);
			kt_query($results2,$query2);
			while($anh=mysqli_fetch_array($results2,MYSQLI_ASSOC))
			{
			?>
			<div class="album_item">
				<p><strong><?php echo $anh['ten']; ?></strong></p>
				<?php 
					if(!empty($anh['anh']))
					{
						$images2=json_decode($anh['anh']);
						if(is_array($images2) && count($images2) >0)
						{
							foreach ($images2 as $image2) 
							{
							?>
							<img width="150" src="<?php echo BASE_URL.'upload/resized/'.$image2; ?>">
							<?php
							}
						}
					}
				?>
			</div>
			<?php	
			}
		?>
		<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
		<script type="text/javascript" src="js/mootools-core.js"></script>
		<script type="text/javascript" src="js/mootools-more.js"></script>
		<script type="text/javascript">
			 window.addEvent('domready', function(){
		        reNewItem();		       
		    });
			<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'      : {
					'timestamp' : '<?php echo $timestamp; ?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp); ?>',
					'sessionid' : '<?php echo session_id(); ?>'
				},
				'buttonText' 	: 'Chèn ảnh ...',
				'width'   		: 180,
	            'auto'          : true,
	            'multi'         : true,
				'swf'           : 'images/uploadify.swf',
				'uploader'      : '<?php echo BASE_URL; ?>uploadify.php',
	            'onProgress'   : function(file, e) {
	            
	            },
				'onUploadSuccess' : function(file, data, response){
					// Et ici
	               //$("#gallery").load("ajax/gallery.php");
	                  var data =  $.parseJSON(data);
	                  var item = data.files;
	                  if (data.success) {	              
	                       var html = '<li>';                                   
	                                    html += '<img class="img-thumb" width= "140px" src="<?php echo BASE_URL . 'tmp/'; ?>'+item.filename+'" />';
	                                    html += '<input type="hidden" name="image_id[]" value="0" />';
	                                    html += '<input type="hidden" name="image_filename[]" value="'+item.filename+'" /><br/>';				
	                                    html +='<a href="javascript:void(0)" class="remove" onclick="removeImage(this)" >Remove</a>';
	                           html += '</li>';
	                              console.log(html); 
	                     $('#sortable').append(html);
	                     $('#sortable li:last-child ').find('a.edit').data('title', item.title);								 
	                        reNewItem();	                               	                  
	                   }
				} 
			});
		});
	       
	    function removeImage(el)
	    {	   	   
	        jQuery(el).parent().fadeOut(function()
	        {
	            jQuery('.ci-message').append('Delete photo').show().fadeOut();
	            jQuery(this).remove();
	       });
	    }	 
	    function reNewItem()
	    {      
	        new Sortables('#sortable',{
	            clone: true,
	            revert: true,
	            opacity: 0.3
	        });
	    }
	</script>
	</body>
</html>