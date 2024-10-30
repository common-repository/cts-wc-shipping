<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce;


/**
 * Array of settings
 */
return array(
	'enabled'		  => array(
		'title'		   	=> __( 'Enable Rates', 'spfw-woocommerce-shipping' ),
		'type'			=> 'checkbox',
		'label'			=> __( 'Enable', 'spfw-woocommerce-shipping' ),
		'default'		=> 'yes',
	),
	'title'			=> array(
		'title'		   		=> __( 'Method Title', 'spfw-woocommerce-shipping' ),
		'type'				=> 'text',
		'description'	 	=> __( 'This controls the title which the user sees during checkout.', 'spfw-woocommerce-shipping' ),
		'default'		 	=> __( 'Shipping Charge', 'spfw-woocommerce-shipping' ),
		'desc_tip'			=> true,
	),

	'debug'	  => array(
		'title'		   => __( 'Debug Mode', 'spfw-woocommerce-shipping' ),
		'label'		   => __( 'Enable', 'spfw-woocommerce-shipping' ),
		'type'			=> 'checkbox',
		'default'		 => 'no',
		'desc_tip'	=> true,
		'description'	 => __( 'Enable debug mode to show debugging information on the cart/checkout.', 'spfw-woocommerce-shipping' ),
	),
	
	'exclude_tax'	  => array(
		'title'		   => __( 'Exclude Tax', 'spfw-woocommerce-shipping' ),
		'description'	 => __( 'Taxes will be excluded from product prices while generating label', 'spfw-woocommerce-shipping' ),
		'desc_tip'		   => true,
		'type'			=> 'checkbox',
		'default'		 => 'no'
	),
);