<?php
/*
Plugin Name: Sheen Dream
Plugin URI: http://wordpress.org/extend/plugins/sheen-dream/
Description: Have the warlock's greatest hits in your admin dashboard. A pearl of wisdom on every visit.
Author: Ben Howdle
Version: 1.0
Author URI: http://www.twostepmedia.co.uk
*/

function hello_sheen_quote() {	 
	 
	function get_data($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	$url='http://charliesheen.pillarapi.com/api/quote?limit=1';
	$mynewarray = json_decode(get_data($url), true);
	$quote = $mynewarray['quote'];
	return $quote;

}


function hello_sheen() {
	$chosen = hello_sheen_quote();
	echo "<p id='sheen'>$chosen - Charlie Sheen</p>";
}


add_action( 'admin_notices', 'hello_sheen' );


function sheen_css() {

	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#sheen {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'sheen_css' );

?>
