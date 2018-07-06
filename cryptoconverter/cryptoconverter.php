<?php
/**
 * Plugin Name: Crypto Converter
 * Plugin URI: https://www.blockchaincenter.net/rechner/
 * Description:  Simple Cryptocurrency converter widget. Any Crypto to EUR or USD. Configure by using widget
 * Version: 0.0.1
 * Author: Holger Rohm
 */
 
 if (!defined('ABSPATH'))
 {
	 exit;
 }
 //Load scripts
 require_once(plugin_dir_path(__FILE__).'/includes/cryptoconv-scripts.php');
 require_once(plugin_dir_path(__FILE__).'/includes/cryptoconv.class.php'); 
 
 
 function register_cryptoconv()
 {
	 register_widget('Cryptoconverter_Widget');
 }
 
 add_action('widgets_init', 'register_cryptoconv');
 
 ?>