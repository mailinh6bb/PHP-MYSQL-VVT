<?php 
	$rss_doc=file_get_contents("http://localhost:8080/xaydungweb/rss");
	$xml=new SimpleXmlElement($rss_doc);	
	foreach ($xml->channel->item as $itemxml) 
	{
		echo $itemxml->title.'<br>';
		echo $itemxml->tomtat.'<br>';
		echo $itemxml->description;
		//insert vao db
	}
?>