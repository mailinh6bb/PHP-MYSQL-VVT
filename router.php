<?php 
	$permalinks = explode("/",$_SERVER['REQUEST_URI']);
	echo $permalinks[0];
?>