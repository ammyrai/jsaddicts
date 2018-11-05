<?php
/**
 * Initialize  Importer
 */
$asp = 'add_'.'submenu_'.'page';

$settings      = array(
  'menu_parent' => 'themes.php',
  'menu_title'  => esc_html__('Wpop Demo Importer', 'ultra-seven'),
  'menu_type'   => $asp,
  'menu_slug'   => 'wpop-import',
);

$opt_id = 'theme_mods_ultra-seven';

/**
 * Front Page & Blog Page are page name strings. hence cannot be translated here
 */

$options        = array(

    'lifestyle' => array(
      'title'         => esc_html__('Lifestyle', 'ultra-seven'),
      'preview_url'   => 'http://demo.wpoperation.com/ultraseven/lifestyle/',
      'front_page'    => 'Home', 
      'blog_page'     => 'Blog',
      'menus'         => array(
          'main-menu' => esc_html__( 'Main Menu', 'ultra-seven' ),
          'top-menu' => esc_html__( 'Top Menu', 'ultra-seven' ),
          'footer-menu' => esc_html__( 'Footer Menu', 'ultra-seven' ),

      ),
      'revslider'     => false,
    ),

    'fashion' => array(
      'title'         => esc_html__('Fashion', 'ultra-seven'),
      'preview_url'   => 'http://demo.wpoperation.com/ultraseven/fashion/',
      'front_page'    => 'Home', 
      'blog_page'     => 'Blog',
      'menus'         => array(
          'main-menu' => esc_html__( 'Main Menu', 'ultra-seven' ),
          'top-menu' => esc_html__( 'Top Menu', 'ultra-seven' ),
          'footer-menu' => esc_html__( 'Footer Menu', 'ultra-seven' ),

      ),
      'revslider'     => false,
    ),

    'sports' => array(
      'title'         => esc_html__('Sports', 'ultra-seven'),
      'preview_url'   => 'http://demo.wpoperation.com/ultraseven/sports/',
      'front_page'    => 'Home', 
      'blog_page'     => 'Blog',
      'menus'         => array(
          'main-menu' => esc_html__( 'Main Menu', 'ultra-seven' ),
          'top-menu' => esc_html__( 'Top Menu', 'ultra-seven' ),
          'footer-menu' => esc_html__( 'Footer Menu', 'ultra-seven' ),

      ),
      'revslider'     => false,
    ),

    'blog' => array(
      'title'         => esc_html__('Blog', 'ultra-seven'),
      'preview_url'   => 'http://demo.wpoperation.com/ultraseven/personal-blog/',
      'front_page'    => 'Home', 
      'blog_page'     => 'Blog',
      'menus'         => array(
          'main-menu' => esc_html__( 'Main Menu', 'ultra-seven' ),
          'top-menu' => esc_html__( 'Top Menu', 'ultra-seven' ),
          'footer-menu' => esc_html__( 'Footer Menu', 'ultra-seven' ),

      ),
      'revslider'     => false,
    ),

);

if( class_exists( 'Wpop_Demo_Importer' ) ) {
    Wpop_Demo_Importer::instance( $settings, $options, $opt_id );
}


