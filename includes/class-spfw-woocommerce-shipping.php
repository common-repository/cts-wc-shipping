<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
* The main class
*/
class spfw_woocommerce_shipping_method extends WC_Shipping_Method {
	private $default_boxes;
	private $found_rates;
	
	public function __construct() {
		$this->id					= shipping_plugin_id;

		$this->method_title			= __( 'Shipping method', 'spfw-woocommerce-shipping' );
		$this->method_description 	= __( 'Get shipping retes here', 'spfw-woocommerce-shipping' );
		$this->init();
	}

	private function init() {
		$this->init_form_fields();
		$this->init_settings();

		$this->enabled				= isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : $this->enabled;
		$this->debug				= false;//( $bool = $this->get_option( 'debug' ) ) && $bool == 'yes' ? true : false;		
		$this->title				= $this->get_option( 'title', $this->method_title );
		
		$this->dimension_unit			= 'cm';
		$this->weight_unit				= 'kg';
		$this->labelapi_dimension_unit	= 'CM';
		$this->labelapi_weight_unit 	= 'KG';
		
		
		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
	}



	public function admin_options() {
		parent::admin_options();
	}

	/**
	 * is_available function.
	 *
	 * @param array $package
	 * @return bool
	 */
	public function is_available( $package ) {
		if ( "no" === $this->enabled ) {
			return false;
		}
		return apply_filters( 'woocommerce_shipping_' . $this->id . '_is_available', true, $package );
	}

	public function init_form_fields() {
		$this->form_fields  = include( 'data-spfw-shipping-settings.php' );
	}

	
	public function calculate_shipping( $package = array() ) {

		$this->found_rates[ 'shippingrate:01' ] = array(
			'id'	   => 'rate_01',
			'label'	=> 'spfw rate',
			'cost'	 => 123,
			'sort'	 => 1,
			'packages' => $package,
		);
		$this->add_found_rates();		
	}


	public function add_found_rates() {
		if ( $this->found_rates ) {
			
			uasort( $this->found_rates, array( $this, 'sort_rates' ) );

			foreach ( $this->found_rates as $key => $rate ) {
				$this->add_rate( $rate );
			}

		}
	}

	public function sort_rates( $a, $b ) {
		if ( $a['sort'] == $b['sort'] ) return 0;
		return ( $a['sort'] < $b['sort'] ) ? -1 : 1;
	}



	public function debug( $message, $type = 'notice' ) {
		if ( $this->debug ) {
			wc_add_notice( $message, $type );
		}
	}
}
new spfw_woocommerce_shipping_method;
