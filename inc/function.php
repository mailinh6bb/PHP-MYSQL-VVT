<?php 
define('BASE_URL','http://vuvantung.net/');
//Kiểm tra xem kết quả trả về có đúng hay không
function kt_query($result,$query)
{
	global $dbc;
	if(!$result)
	{
		die("Query {$query} \n<br/> MYSQL Error:".mysqli_error($dbc));
	}	
}
function sitemap()
{
	global $dbc;
	$doc = new DOMDocument("1.0","utf-8"); 
    $doc->formatOutput = true;
    $r = $doc->createElement("urlset" );
    $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
    $doc->appendChild( $r );
    $url = $doc->createElement("url" );
    $name = $doc->createElement("loc" );
    $name->appendChild(
        $doc->createTextNode(BASE_URL)
	);
    $url->appendChild($name);			
    $changefreq = $doc->createElement( "changefreq" );
    $changefreq->appendChild(
       $doc->createTextNode('daily')
    );
    $url->appendChild($changefreq);			
	$priority = $doc->createElement( "priority" );
	$priority->appendChild(
 		$doc->createTextNode('1.00')
	);
	$url->appendChild($priority);			
	$r->appendChild($url);	
	//bai viet				    
	$query_st="SELECT * FROM tblbaiviet";
	$query_st1=mysqli_query($dbc,$query_st);  
	while ($category_st1=mysqli_fetch_array($query_st1,MYSQLI_ASSOC))
	{
		$url = $doc->createElement( "url" );			
		$name = $doc->createElement( "loc" );
		$name->appendChild(
			$doc->createTextNode(BASE_URL.'baivietchitiet.php?id='.$category_st1['id'].'&title='.$category_st1['title'])
		);
		$url->appendChild($name);		
		$changefreq = $doc->createElement( "changefreq" );
		$changefreq->appendChild(
			$doc->createTextNode('daily')
		);
		$url->appendChild($changefreq);		
		$priority = $doc->createElement( "priority" );
		$priority->appendChild(
			$doc->createTextNode('1.00')
		);
		$url->appendChild($priority);		
		$r->appendChild($url);
	}  
	//danh muc bai viet
	$query_stdm="SELECT * FROM tbldanhmucbaiviet";
	$query_stdm1=mysqli_query($dbc,$query_st);  
	while ($category_stdm2=mysqli_fetch_array($query_stdm1,MYSQLI_ASSOC))
	{
		$url = $doc->createElement( "url" );			
		$name = $doc->createElement( "loc" );
		$name->appendChild(
			$doc->createTextNode(BASE_URL.'tinbycategory.php?dm='.$category_stdm2['id'])
		);
		$url->appendChild($name);		
		$changefreq = $doc->createElement( "changefreq" );
		$changefreq->appendChild(
			$doc->createTextNode('daily')
		);
		$url->appendChild($changefreq);		
		$priority = $doc->createElement( "priority" );
		$priority->appendChild(
			$doc->createTextNode('1.00')
		);
		$url->appendChild($priority);		
		$r->appendChild($url);
	}                                 		       
  	$doc->save("sitemap.xml");	
}
function LocDau($str)
{
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|�� �|ặ|ẳ|ẵ|ắ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|�� �|Ặ|Ẳ|Ẵ)/", 'A', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ợ|Ở|Ớ|Ỡ)/", 'O', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	$str = preg_replace("/(Đ)/", 'D', $str);
	$str = preg_replace("/( |'|,|\||\.|\"|\?|\/|\%|–|!)/", '-', $str);
	$str = preg_replace("/(\()/", '-', $str);
	$str = preg_replace("/(\))/", '-', $str);
	$str = preg_replace("/(&)/", '-', $str);
    $str = preg_replace("/“/", '', $str);
    $str = preg_replace("/”/", '', $str);  
    $str = preg_replace("/;/", '', $str);  
	return strtolower($str);
}
function menu_dacap($parent_id=0,$dem=0)
{
	global $dbc;
	$cate_child=array();
	$query_dq_mn="SELECT * FROM tbldanhmucbaiviet WHERE parent_id=".$parent_id." AND menu=1 ORDER BY ordernum DESC";
	$categories_mn=mysqli_query($dbc,$query_dq_mn);
	while ($category_mn=mysqli_fetch_array($categories_mn,MYSQLI_ASSOC))
	{
		$cate_child[]=$category_mn;	
	}	
	if($cate_child)
	{
		if($dem==0)
		{
			echo "<ul class='sf-menu' id='example'>";
			echo "<li><a href='".BASE_URL."'>Trang chủ</a></li>";
		}		
		else
		{
			echo "<ul>";
		}
		foreach ($cate_child as $key => $item) 
		{	
						
			echo "<li><a href='dm/".$item['id']."-".LocDau($item['danhmucbaiviet']).".html'>".$item['danhmucbaiviet']."</a>";
			menu_dacap($item['id'],++$dem);			
			echo "</li>";			
		}
		if(count($cate_child)==$dem)
		{	
			echo "<li><a href='sanpham.php'>Sản phẩm</a></li>";		
			echo "<li><a href=''>Liên hệ</a></li>";
		}	
		echo "</ul>";
	}
}
function show_categories($parent_id="0",$insert_text="-")
{
	global $dbc;
	$query_dq="SELECT * FROM tbldanhmucbaiviet WHERE parent_id=".$parent_id." ORDER BY parent_id DESC";
	$categories=mysqli_query($dbc,$query_dq);
	while($category=mysqli_fetch_array($categories,MYSQLI_ASSOC))
	{
		echo("<option value='".$category["id"]."'>".$insert_text.$category['danhmucbaiviet']."</option>");
		show_categories($category["id"],$insert_text."-");
	}
	return true;
}
function selectCtrl($name,$class)
{
	global $dbc;
	echo "<select name='".$name."' class='".$class."'>";
	echo "<option value='0'>Danh mục cha</option>";
	show_categories();
	echo "</select>";
}
function show_categories_e($uid,$parent_id1="0",$insert_text1="-")
{
	global $dbc;
	$query_dq1="SELECT DISTINCT * FROM tbldanhmucbaiviet where parent_id=".$parent_id1."";	
	$categories1=mysqli_query($dbc,$query_dq1);
	while($category1=mysqli_fetch_array($categories1,MYSQLI_ASSOC))
	{				
		if($uid==$category1["id"])
		{			
			echo("<option selected='selected' value='".$category1["id"]."'>".$insert_text1.$category1['danhmucbaiviet']."</option>");
		}
		else
		{
			echo("<option value='".$category1["id"]."'>".$insert_text1.$category1['danhmucbaiviet']."</option>");
		}
		show_categories_e($uid,$category1["id"],$insert_text1."-");
	}
	return true;
}
function selectCtrl_e($uid,$name1,$class1)
{
	global $dbc;
	echo "<select name='".$name1."' class='".$class1."'>";
	echo "<option value='0'>Danh mục cha</option>";
	show_categories_e($uid);
	echo "</select>";
}
function smtpmailer($to, $from, $from_name, $subject, $body)
 {
    $mail = new PHPMailer();                  // tạo một đối tượng mới từ class PHPMailer
    $mail->IsSMTP();                         // bật chức năng SMTP
    $mail->SMTPDebug = 0;                      // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
    $mail->SMTPAuth = true;                  // bật chức năng đăng nhập vào SMTP này
    $mail->SMTPSecure = 'ssl';                 // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
    $mail->Host = 'smtp.gmail.com';         // smtp của gmail
    $mail->Port = 465;                         // port của smpt gmail
    $mail->Username = GUSER;  
    $mail->Password = GPWD;    
    $mail->CharSet = "UTF-8";        
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send())
    {
        $message = 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
        return false;
    } 
    else 
    {
        $message = 'Thư của bạn đã được gởi đi ';
        return true;
    }
 }     
?>