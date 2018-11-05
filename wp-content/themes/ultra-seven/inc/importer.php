<?php
/**
 * Initialize Importer
 */
$asp = 'add_'.'submenu_'.'page';

$settings      = array(
  'menu_parent' => 'themes.php',
  'menu_title'  => esc_html__('Wpop Demo Importer', 'ultra-seven'),
  'menu_type'   => $asp,
  'menu_slug'   => 'wpop-import',
);

/**
 * Front Page & Blog Page are page name strings. hence cannot be translated here
 */
$options        = array(


    'sports' => array(
      'title'         => esc_html__('Sports', 'ultra-seven'),
      'preview_url'   => 'http://demo.wpoperation.com/ultra-seven/sports/',
      'front_page'    => 'Home', 
      'blog_page'     => 'Blog',
      'menus'         => array(
          'main-menu' => esc_html__( 'Main Menu', 'ultra-seven' ),
          'top-menu' => esc_html__( 'Top Menu', 'ultra-seven' ),
      ),
      'revslider'     => false,
    ),
);

if( class_exists( 'Wpop_Demo_Importer' ) ) {
    Wpop_Demo_Importer::instance( $settings, $options );
}


