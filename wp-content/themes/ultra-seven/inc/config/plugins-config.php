<?php

if( ! defined( 'ABSPATH' ) ) {
	exit; 	// exit if accessed directly
}

add_action( 'tgmpa_register', 'ultra_seven_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function ultra_seven_register_required_plugins() {	

	$plugins = array(
		
		/**
		 * Plugins from WordPress repository
		 */
		array(
            'name'             => esc_html__( 'Operation Demo Importer', 'ultra-seven' ),
            'slug'             => 'operation-demo-importer',
            'source'           => 'https://wordpress.org/plugins/operation-demo-importer/',
            'required'         => false,
            'version'          => '1.0.0' 
        ),
		 array(
            'name'             => esc_html__( 'Ultra Companion', 'ultra-seven' ),
            'slug'             => 'ultra-companion',
            'source'           => 'https://wordpress.org/plugins/ultra-companion/',
            'required'         => false,
            'version'          => '1.0.0' 
        ),

		// Woocommerce
		array(
			'name'      => esc_html__( 'Woocommerce', 'ultra-seven' ),
			'slug'      => 'woocommerce',
			'required'  => false,
			'version'   => '3.4.3'
		),

        // wishlist
		array(
			'name'      => esc_html__( 'YITH WooCommerce Wishlist', 'ultra-seven' ),
			'slug'      => 'yith-woocommerce-wishlist',
			'required'  => false,
			'version'   => '2.2.2'
		),

		// Mail Poet
		array(
			'name'      => esc_html__( 'Mailpoet', 'ultra-seven' ),
			'slug'      => 'mailpoet',
			'required'  => false,
			'version'   => '3.7.8'
		),

		// Instashow
		array(
			'name'      => esc_html__( 'InstaShow Lite', 'ultra-seven' ),
			'slug'      => 'instashow-lite',
			'required'  => false,
			'version'   => '1.4.2'
		),
		array(
			'name'      => esc_html__( 'Regenerate Thumbnails', 'ultra-seven' ),
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
			'version'   => '3.0.2'
		),

		// Smart Slider
		array(
			'name'      => esc_html__( 'Smart Slider 3', 'ultra-seven' ),
			'slug'      => 'smart-slider-3',
			'required'  => false,
			'version'   => '3.3.3'
		),
		
	);

	// Settings for plugin installation screen
	$config = array(
		'id'           => 'tgmpa-ultra7',
		'default_path' => '',
		'menu'         => 'ultra7-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',		
	);

	tgmpa( $plugins, $config );

}

/* PHP Closing tag is omitted */