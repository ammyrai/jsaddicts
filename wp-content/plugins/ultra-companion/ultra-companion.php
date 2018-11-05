<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/*
Plugin Name: Ultra Companion
Description: This is the companion plugin for Ultra Seven WordPress theme
Author: WPoperation
Author URI:  https://wpoperation.com/
Version: 1.0.3
License: GPL2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Domain Path: /languages/
Text Domain: ultra-companion
*/

/** Necessary Constants **/
defined( 'BSCD_VERSION' ) or define( 'BSCD_VERSION', '1.0.2' ); //plugin version
defined( 'BSCD_TD' ) or define( 'BSCD_TD', 'ultra-companion' ); //plugin's text domain
defined( 'BSCD_PATH' ) or define( 'BSCD_PATH', plugin_dir_path( __FILE__ ) );
defined( 'UIMAGE_PATH' ) or define( 'UIMAGE_PATH', plugin_dir_url( __FILE__ ).'assets/images/' );
if(!class_exists('Ultra_Companion')) :

	class Ultra_Companion {

		public function __construct() {

	        /** Loads plugin text domain for internationalization **/
			add_action('init', array($this, 'load_text_domain'));

			/** Add Shortcode File **/
			add_action('init', array($this, 'add_shortcode_file'));

			/** Add theme functions **/
            add_action('init', array($this, 'add_theme_functions'));

            add_action('admin_notices', array($this, 'wpop_admin_notice') );
	        add_action('admin_init', array($this, 'wpop_nag_ignore') );

			/** Enqueue Styles & Scripts **/
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		}

		/** Enqueue Necessary Plugin Scripts and Styles **/
		public function enqueue_styles_and_scripts() {

			wp_enqueue_style('ultra-shortcodes-front', plugin_dir_url( __FILE__ ) . 'assets/css/shortcodes.css');
			wp_enqueue_style('slick-style', plugin_dir_url( __FILE__ ) . 'assets/slick/slick.css' );
            wp_enqueue_style('slick-theme', plugin_dir_url( __FILE__ ) . 'assets/slick/slick-theme.css' );

			wp_enqueue_script('slick-script', plugin_dir_url( __FILE__ ) . 'assets/slick/slick.js' , array('jquery'),BSCD_VERSION);
			wp_enqueue_script('ultra-shortcodes-front', plugin_dir_url( __FILE__ ) . 'shortcodes-front.js' , array('jquery'),BSCD_VERSION);
		}

		public function enqueue_admin_styles(){

			wp_enqueue_script('media-script', plugin_dir_url( __FILE__ ) . 'assets/js/media-uploader.js' );
			wp_enqueue_script('admin-script', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js' );
			wp_enqueue_style('admin-style', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css' );
		}

		/** Shortcode File **/
		public function add_shortcode_file() {
			require_once BSCD_PATH.'shortcodes.php';
		}

		/** Theme Functions **/
		public function add_theme_functions() {
			require_once BSCD_PATH.'inc/theme-functions.php';
            if(!defined('WPOP_PRO')){
				require_once BSCD_PATH.'inc/meta/ultra-page-meta.php';
				require_once BSCD_PATH.'inc/meta/ultra-post-meta.php';
		    }
		}		

		/**
	     * Loads Plugin Text Domain
	     * 
	     */
	    function load_text_domain() {
	        load_plugin_textdomain('ultra-companion', false, basename(dirname(__FILE__)) . '/languages');
	    }
		// admin notice
		function wpop_admin_notice() {
		if ( current_user_can( 'install_plugins' ) ){
		    global $current_user ;
		    $user_id = $current_user->ID;
		    /* Check that the user hasn't already clicked to ignore the message */
		    if ( ! get_user_meta($user_id, 'wpop_ignore_notice222') && !function_exists('ultra_eleven_setup') && function_exists('ultra_seven_setup') ) {
            ?>
            <div class="notice wpop_admin_notice wpop_admin_notice_1" >
            	<img class="wpop_notice_img" src="<?php echo UIMAGE_PATH . '44p_sale.jpg'?>">
            	<div class="wpop_notice_right_content">
                    <div class="wpop_notice_content">
                    	<a class="wpop_no_thanks" href="<?php echo admin_url( 'admin.php/themes.php?wpop_nag_ignore=0' );?>">not interested</a>
                    </div>
                    <div class="wpop_notice_after_content"></div>
                </div>
                <div class="wpop_notice_content_wrap">
                    <div class="wpop_notice_content">
	 					Upgrade to <strong>Ultra Eleven - Premium WordPress Magazine Theme </strong> and Unlock More Powerful Features 
	     				<a class="wpop_button" href="https://wpoperation.com/themes/ultra-eleven/" target="_blank">Details</a>
     				</div>
                    <div class="wpop_notice_after_content"></div>
                </div>
            </div>

            <?php
		  }
		    }
		}

		function wpop_nag_ignore() {
		    global $current_user;
	        $user_id = $current_user->ID;
	        /* If user clicks to ignore the notice, add that to their user meta */
	        if ( isset($_GET['wpop_nag_ignore']) && '0' == $_GET['wpop_nag_ignore'] ) {
	            add_user_meta($user_id, 'wpop_ignore_notice222', 'true', true);
		  }
		}

		/* Print Shortcode Function */
	    function ultra_eleven_print_shortcode($content){
	        echo do_shortcode($content);
	    }
    }

    $bscd_object = new Ultra_Companion();
endif;