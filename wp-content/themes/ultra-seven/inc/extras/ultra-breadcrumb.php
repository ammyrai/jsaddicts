<?php 
/**
 * Breadcrumbs for ultra seven
 *
 * @package Wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */
function ultra_seven_breadcrumbs(){
	$ultra_seven_breadcrumbs_option = get_theme_mod( 'ultra_seven_breadcrumb_enable', 'show' );
	if( $ultra_seven_breadcrumbs_option == 'show' ) {
	
	wp_reset_postdata();
  /* === OPTIONS === */
	$text['home']     = esc_html__( 'Home', 'ultra-seven' ); // text for the 'Home' link	
	$text['category'] = '%s'; // text for a category page
	$text['tax'] 	  = '%s'; // text for a taxonomy page
	$text['search']   = '%s'; // text for a search results page
	$text['tag']      = '%s'; // text for a tag page
	$text['author']   = '%s'; // text for an author page
	$text['404']      = esc_html__('Error 404','ultra-seven'); // text for the 404 page
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = '<span class="delimiter">'.esc_attr(get_theme_mod('ultra_seven_breadcrumb_delimiter','>>')).'</span>'; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$homeLink = esc_url( home_url( '/' ) );
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) echo '<div class="ultra-bread-home" id="ultra-breadcrumbs"><a href="' . esc_url($homeLink) . '">' . wp_kses_post($text['home']) . '</a></div>';
	} else {
		echo '<div class="ultra-bread-home" id="ultra-breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, esc_url($homeLink), wp_kses_post($text['home']) ) . wp_kses_post($delimiter);
		
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses_post($cats);
			}
			echo wp_kses_post($before) . sprintf($text['category'], get_the_archive_title('', false)) . wp_kses_post($after);// WPCS: XSS OK.
		} elseif( is_tax() ){
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses_post($cats);
			}
			echo wp_kses_post($before) . sprintf($text['tax'], get_the_archive_title('', false)) . wp_kses_post($after);// WPCS: XSS OK.
		
		}elseif ( is_search() ) {
			echo wp_kses_post($before) . sprintf($text['search'], get_search_query()) . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;// WPCS: XSS OK.
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;// WPCS: XSS OK.
			echo wp_kses_post($before) . get_the_time('d') . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;// WPCS: XSS OK.
			echo wp_kses_post($before) . get_the_time('F') . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_year() ) {
			echo wp_kses_post($before) . get_the_time('Y') . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_single() && !is_attachment() ) {
			 if( 'product' == get_post_type()){
			 	$post_type = get_post_type_object(get_post_type());
			  	$shop_page_url = esc_url(get_permalink( wc_get_page_id( 'shop' ) ));
			  	printf($link,$shop_page_url . '/', $post_type->labels->singular_name);// WPCS: XSS OK.
			  	if ($showCurrent == 1)  echo wp_kses_post($delimiter) . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
			 }
			elseif ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);// WPCS: XSS OK.
				if ($showCurrent == 1) echo wp_kses_post($delimiter) . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses_post($cats);
				if ($showCurrent == 1) echo wp_kses_post($before) . get_the_title() . wp_kses_post($after);
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo wp_kses_post($before) . $post_type->labels->singular_name . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo wp_kses_post($cats);
			printf($link, get_permalink($parent), $parent->post_title);// WPCS: XSS OK.
			if ($showCurrent == 1) echo wp_kses_post($delimiter) . $before . get_the_title() . $after;// WPCS: XSS OK.
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo wp_kses_post($before) . get_the_title() . wp_kses_post($after);
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_post($parent_id);
				$breadcrumbs[] = sprintf($link, esc_url(get_permalink($page->ID)), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo wp_kses_post($breadcrumbs[$i]);
				if ($i != count($breadcrumbs)-1) echo wp_kses_post($delimiter);
			}
			if ($showCurrent == 1) echo wp_kses_post($delimiter) . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
		} elseif ( is_tag() ) {
			echo wp_kses_post($before) . sprintf($text['tag'], get_the_archive_title('', false)) . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo wp_kses_post($before) . sprintf($text['author'], $userdata->display_name) . wp_kses_post($after);// WPCS: XSS OK.
		} elseif ( is_404() ) {
			echo wp_kses_post($before) . $text['404'] . wp_kses_post($after);// WPCS: XSS OK.
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo esc_html__( 'Page', 'ultra-seven' ) . ' ' . get_query_var('paged');// WPCS: XSS OK.
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</div>';
	}
 }//endif;	
} // end ultra_seven_breadcrumbs()