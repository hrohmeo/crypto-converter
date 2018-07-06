<?php
function cryptoconv_addScripts()
{
	wp_enqueue_style('cryptoconv_style', plugins_url().'/cryptoconverter/css/style.css');
	wp_enqueue_script('cryptoconv_script', plugins_url().'/cryptoconverter/js/main.js');
}
add_action('wp_enqueue_scripts', 'cryptoconv_addScripts');

?>