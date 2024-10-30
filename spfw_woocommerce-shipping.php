<?php
/*
	Plugin Name: Shipping plugin for WooCommerce
	Plugin URI: 
	Description: A template plugin to intergate Shipping Rates APIs
	Version: 1.0.0
	Author: Nishad
	Author URI: 
	WC requires at least: 2.6
	WC tested up to: 3.2
*/

if (!defined('shipping_plugin_id')){
	define("shipping_plugin_id", "spfw_woocommerce_shipping");
}

/**
 * Check if WooCommerce is active
 */
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {	
	class spfw_woocommerce_shipping_plugin {
		
		public function __construct() {
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
			add_action( 'woocommerce_shipping_init', array( $this, 'woocommerce_shipping_plugin_init' ) );
			add_filter( 'woocommerce_shipping_methods', array( $this, 'woocommerce_shipping_declare_class' ) );		
			add_filter( 'admin_enqueue_scripts', array( $this, 'spfw_shipping_plugin_scripts' ) );		
				
		}
		
		public function spfw_shipping_plugin_scripts() {
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'spfw-common-script', plugins_url( '/resources/js/spfw_shipping_common.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_style( 'spfw-common-style', plugins_url( '/resources/css/spfw_shipping_common_style.css', __FILE__ ));
		}
		
		public function plugin_action_links( $links ) {
			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=shipping&section=spfw_woocommerce_shipping' ) . '">' . __( 'Settings', 'spfw-woocommerce-shipping' ) . '</a>',
				'<a href="#">' . __('Support', 'spfw-woocommerce-shipping') . '</a>',
			);
			return array_merge( $plugin_links, $links );
		}			
		
		public function woocommerce_shipping_plugin_init() {
			include_once( 'includes/class-spfw-woocommerce-shipping.php' );
		}

		
		public function woocommerce_shipping_declare_class( $methods ) {
			$methods[] = 'spfw_woocommerce_shipping_method';
			return $methods;
		}

	}
	new spfw_woocommerce_shipping_plugin();
}
