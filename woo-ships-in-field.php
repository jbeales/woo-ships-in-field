<?php 
/*
Plugin Name: Ships In field for WooCommerce
Plugin URI: 
Description: Adds a "Ships In" field to the "Shipping" section of WooCommerce simple products, and outputs a "Ships in X" method just below the product meta on the single-product page. 
Version: 1.0
Author: John Beales
Author URI: http://johnbeales.com
Text Domain: jb-sif

*/






include( dirname( __FILE__ ) . '/requirements-check.php' );
$requirements_check = new JB_SIF_Requirements_Check( array(
	'title' => 'Shipping Address Type',
	'php'   => '5.4',
	'wp'    => '4.8',
	'file'  => __FILE__,
));

if( $requirements_check->passes() ) {
	include( dirname( __FILE__ ) . '/ships-in-field.php' );

//	add_action( 'init', array('JB_Shipping_Address_Type', 'init') );
//	add_action( 'admin_init', array('JB_Shipping_Address_Type', 'admin_init') );
}


unset( $requirements_check );

