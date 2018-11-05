<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 *@package Ultra Seven
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php $preloader = get_theme_mod('ultra_seven_preloader_option','show'); ?>

<?php if( $preloader == 'show'): ?>
      <div id="loading1" class="ultra-seven-loader">
          <div id="loading-center">
              <div id="loading-center-absolute">
                  <div class="object"></div>
              </div>
          </div>
      </div>
<?php endif; ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ultra-seven' ); ?></a>
    <?php 

      $header_layouts = get_theme_mod('ultra_seven_header_layouts','ultra-header-1');
      switch ($header_layouts) {
      	case 'ultra-header-1':
      		get_template_part('layouts/header-layouts/layout','one');
      	break;

      	case 'ultra-header-2':
      		get_template_part('layouts/header-layouts/layout','two');
      	break; 
                
      	default:
      		get_template_part('layouts/header-layouts/layout','one');
      	break;
      }
    ?>

	<div id="content" class="site-content">
