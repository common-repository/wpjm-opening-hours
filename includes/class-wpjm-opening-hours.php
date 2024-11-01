<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 * @package    WPJM_Opening_Hours
 * @subpackage WPJM_Opening_Hours/includes
 */

class WPJM_Opening_Hours {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Opening_Hours_Loader. Orchestrates the hooks of the plugin.
	 * - Opening_Hours_i18n. Defines internationalization functionality.
	 * - Opening_Hours_Admin. Defines all hooks for the admin area.
	 * - Opening_Hours_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		add_filter( 'job_manager_job_listing_data_fields', array ( $this, 'admin_add_opening_hours_field' ) );
		add_action( 'widgets_init', array( $this, 'register_wpjm_opening_hours_sidebar' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wpjm_opening_hours_enqueue_script' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wpjm_opening_hours_enqueue_styles' ) );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

	}

	public function register_wpjm_opening_hours_sidebar() {
		register_widget( 'Listing_Sidebar_Opening_Hours_Widget' );
	}

	public function admin_add_opening_hours_field( $fields ) {
		$fields['_job_wpjm_opening_hours'] = array(
			'label'       => __( 'Opening Hours', 'opening_hours' ),
			'type'        => 'textarea',
			'placeholder' => esc_html__('e.g. Tuesday to Friday 9 - 17', 'opening_hours'),
			'description' => esc_html__('You can have a format like: Monday 10am - 3pm<br />
							Tuesday to Friday 9 - 17<br />Sat to Sun noon - 2am', 'wpjm_opening_hours'),
		);
		return $fields;
	}

	function wpjm_opening_hours_enqueue_styles() {
		wp_enqueue_style( 'main-css', plugins_url('css/style.css', __FILE__ ) );
	}

	function wpjm_opening_hours_enqueue_script() {
		wp_enqueue_script( 'hours-foursquare', plugins_url( 'js/HoursParser.js',__FILE__ ) );
		wp_enqueue_script( 'main-js', plugins_url( 'js/main.js', __FILE__, array('jquery') ), 9999 );
		wp_enqueue_script( 'wpjm-opening-hours-lodash', 'https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js', array('jquery') );
	}

}

class Listing_Sidebar_Opening_Hours_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'listing_sidebar_opening_hours', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'wpjm_opening_hours' ) . ' &raquo; ' . esc_html__( 'Opening Hours', 'wpjm_opening_hours' ), // Name
			array( 'description' => esc_html__( 'Display the opening hours in the sidebar.', 'wpjm_opening_hours' ), ) // Args
		);
	}
	public function widget( $args, $instance ) {
		//global $post;
		$opening_hours = get_post_meta( get_the_ID(), '_job_wpjm_opening_hours', true );
		if ( ! empty ( $opening_hours ) ) :
			echo $args['before_widget']; ?>
			<div class="widget_title">&#x1f550; <?php echo esc_html__('Hours', 'wpjm_opening_hours'); ?></div>
			<hr >
			<div id="opening_hours" class="schedule" itemprop="openingHours"><?php echo $opening_hours; ?></div>
			<?php
			echo $args['after_widget'];
		endif;
	}
	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
}