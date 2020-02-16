<?php

function getSSLPage( $url )
{
	$userAgents = array( //
		'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1) Gecko/20090624 Firefox/3.5 (.NET CLR 3.5.30729)', //
		'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', //
		'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', //
		'Mozilla/4.8 [en] (Windows NT 6.0; U)', //
		'Opera/9.25 (Windows NT 6.0; U; en)'
	);
	srand( (float) microtime( ) * 10000000 );
	$rand = array_rand( $userAgents );
	$agent = $userAgents[$rand];
	$agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1) Gecko/20090624 Firefox/3.5 (.NET CLR 3.5.30729)';
	$ch = curl_init( );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	$safe_mode = (ini_get( 'safe_mode' ) == '1' || strtolower( ini_get( 'safe_mode' ) ) == 'on') ? 1 : 0;
	$open_basedir = @ini_get( 'open_basedir' ) ? true : false;
	if( !$safe_mode and !$open_basedir )
	{
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
	}
	curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_USERAGENT, $agent );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	$html = curl_exec( $ch );
	$curl_error = trim( curl_error( $ch ) );
	curl_close( $ch );
	return $html;
}


function fb_count( $url )
{
	$fql = "SELECT share_count, like_count, comment_count ";
	$fql .= " FROM link_stat WHERE url = '$url'";
	$fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode( $fql );
	$response = getSSLPage( $fqlURL );
	return json_decode( $response );
}
$fb = fb_count( 'http://mynukeviet.net/lap-trinh-php/dem-so-luot-like-share-comment-facebook-su-dung-php-135.html' );
echo $fb[0]->share_count;
echo $fb[0]->like_count;
echo $fb[0]->comment_count;

?>