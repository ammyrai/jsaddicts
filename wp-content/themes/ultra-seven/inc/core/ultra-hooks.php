<?php

/*=============================================================================================*/
/**
 * Function to display post categories or tags lists
 *
 * @since 1.0.0
 */
add_action( 'ultra_seven_post_cat_or_tag_lists', 'ultra_seven_post_cat_or_tag_lists_cb' );
if( ! function_exists( 'ultra_seven_post_cat_or_tag_lists_cb' ) ) :
    function ultra_seven_post_cat_or_tag_lists_cb() {
        global $post;

        if ( 'post' === get_post_type() ) {
            global $post;
            $categories = get_the_category();
            $separator = ' ';
            $output = '';
            if( $categories ) {
                $output .= '<span class="cat-wrap">';
                foreach( $categories as $category ) {
                    $cat_color = get_theme_mod('ultra_seven_cat_color_'.$category->term_id, '#e54e54');
                    $output .= '<span class="cat-links" style="background-color:'.$cat_color.'">';
                    $output .= '<a href="'.get_category_link( $category->term_id ).'" class="cat-' . $category->term_id . '" rel="category tag">'.$category->cat_name.'</a>';                   
                    $output .= '</span>';
                }
                $output .='</span>';
                echo trim( $output, $separator );// WPCS: XSS OK.
            }

        }
    }
endif;

/*==============================================================================================*/
/**
 * Post format icon for homepage blocks
 *
 * @since 1.0.0
 */
add_action( 'ultra_seven_post_format_icon', 'ultra_seven_post_format_icon_cb' );

if( ! function_exists( 'ultra_seven_post_format_icon_cb' ) ) {
    function ultra_seven_post_format_icon_cb() {
        global $post;
        $post_id = $post->ID;
        $post_format = get_post_format( $post_id );
        if( $post_format == 'video' ) {
            echo '<span class="post-format-icon arrow_triangle-right_alt2"></span>';
        } elseif( $post_format == 'audio' ) {
            echo '<span class="post-format-icon icon_music"></span>';
        } elseif( $post_format == 'gallery' ) {
            echo '<span class="post-format-icon icon_images"></span>';
        } else { } 
    }    
}

/*==============================================================================================*/
/**
 * Homepage Image Overlay
 *
 * @since 1.0.0
 */
add_action('ultra_image_overlay','ultra_seven_image_overlay');

if( !function_exists( 'ultra_seven_image_overlay' ) ){
    function ultra_seven_image_overlay(){
        $overlay = true;
        if($overlay == true){
            echo '<div class="image-overlay"></div>';
        }else{

        }
    }
}


/*===========================================================================================================*/
/**
 * Get list of tags for individual posts
 */
add_action( 'ultra_seven_post_tag_lists', 'ultra_seven_post_tag_lists_hook' );
if( ! function_exists( 'ultra_seven_post_tag_lists_hook' ) ) {
	function ultra_seven_post_tag_lists_hook() {
		$post_tags_list = get_the_tag_list( '', '' );
		if ( $post_tags_list) {
            /* translators: tag */
			printf( '<span class="post-tags-links">' . esc_html( '%1$s') . '</span>', $post_tags_list ); // WPCS: XSS OK.
		}
	}
}



/*===========================================================================================================*/
/**
 * Related posts section
 *
 * @since 1.0.0
 */
add_action( 'ultra_seven_related_posts', 'ultra_seven_related_posts_hook' );

if( !function_exists( 'ultra_seven_related_posts_hook' ) ):
    function ultra_seven_related_posts_hook() {
        $ultra_seven_related_posts_option = get_theme_mod( 'ultra_seven_related_posts_enable','show' );
        $ultra_seven_related_post_title = get_theme_mod( 'ultra_seven_related_title', esc_html__( 'Related Articles', 'ultra-seven' ) );

        if( $ultra_seven_related_posts_option == 'show' ) {
?>
            <div class="ultra-related-wrapper slide">
                <div class="related-header clearfix">
                <h4 class="related-title"><?php echo esc_html( $ultra_seven_related_post_title ); ?></h4>
                <div class="slide-action">
                   <div class="ultra-lSPrev"></div>
                   <div class="ultra-lSNext"></div>
                </div>
                </div>
        <?php
                wp_reset_postdata();
                global $post;
                if( empty( $post ) ) {
                    $post_id = '';
                } else {
                    $post_id = $post->ID;
                }
                // Define related post arguments
                $related_args = array(
                    'no_found_rows'            => true,
                    'update_post_meta_cache'   => false,
                    'update_post_term_cache'   => false,
                    'ignore_sticky_posts'      => 1,
                    'orderby'                  => 'rand',
                    'post__not_in'             => array( $post_id ),
                    'posts_per_page'           => 5
                );

                $categories = get_the_category( $post_id );
                if ( $categories ) {
                    $category_ids = array();
                    foreach( $categories as $individual_category ) {
                        $category_ids[] = $individual_category->term_id;
                    }
                    $related_args['category__in'] = $category_ids;
                }

                $related_query = new WP_Query( $related_args );
  
                if( $related_query->have_posts() ) {
                    echo '<div class="related-posts-wrapper cS-hidden clearfix">';
                    while( $related_query->have_posts() ) {
                        $related_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image_path = wp_get_attachment_image_src( $image_id, 'ultra-medium-image', true );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>
                        <div class="single-post">
                            <div class="post-thumb">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <a class="thumb-zoom" href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    </a>
                                <?php } ?>
                                <?php do_action( 'ultra_seven_post_cat_or_tag_lists' ); ?>
                            </div>
                            <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div><!--. single-post -->
                <?php
                    }
                    echo '</div>';
                }
                wp_reset_postdata();
        ?>
            </div><!-- .ultra-related-wrapper -->
<?php
        }
    }
endif;



/*===========================================================================================================*/
/**
 * Posted on function for blocks
 */
if ( ! function_exists( 'ultra_seven_posts_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ultra_seven_posts_posted_on() {


	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_date() . '</a>';
	$byline = sprintf(
        /* translators: author link */
		esc_html( '%s'),
		'<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
		echo '<span class="post-author">'. wp_kses_post($byline) .'</span>';

		echo '<span class="posted-on">'. wp_kses_post($posted_on) .'</span>';

}
endif;

add_action( 'ultra_seven_post_meta', 'ultra_seven_posts_posted_on' );


/*===========================================================================================================*/
/**
 * Ultra Footer hooks
 */

if( !function_exists('ultra_seven_top_footer') ){
    /**
     * Display the theme footer widgets
     * @since  1.0.0
     * @return void
     */
    function ultra_seven_top_footer(){
        $top_footer_enable = get_theme_mod('ultra_seven_topfooter_show','show');
        if($top_footer_enable=='show'){
            $widget_columns = get_theme_mod('ultra_seven_topfooter_col',4);
            if ( $widget_columns > 0 ) : ?>
                <div class="footer-widgets-wrap col-<?php echo intval( $widget_columns ); ?> clearfix">              
                    <div class="ultra-container clearfix">
                        <?php $i = 0; while ( $i < 4 ) : $i++; ?>     
                            <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>       
                                <div class="block footer-widget wow fadeInRight">
                                    <?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
                                </div>      
                            <?php endif; ?>     
                        <?php endwhile; ?>
                    </div>
                </div><!-- .footer-widgets  -->
            <?php endif;
        }
    }
}
add_action('ultra_seven_footer','ultra_seven_top_footer',0);


if ( ! function_exists( 'ultra_seven_bottom_footer' ) ) {
    /**
     * Display the theme credit/button footer
     * @since  1.0.0
     * @return void
     */
    function ultra_seven_bottom_footer() {
       $footer_copyright = get_theme_mod('ultra_seven_footer_text');
       $footer_menu = get_theme_mod('ultra_seven_footer_menu','show');
       if($footer_menu=='show'){
        $class = '';
       }else{
        $class = 'text-center';
       }
        ?>
            <div class="ultra-bottom-footer <?php echo esc_attr($class);?>"> 
                <div class="ultra-container clearfix">
                    <div class="footer-left wow fadeInUp">
                        <?php if( !empty( $footer_copyright ) ) { ?>
                            <?php echo wp_kses_post($footer_copyright); ?>   
                        <?php }
                        /* translators: */
                            printf( esc_html__( '%1$s | Theme By %2$s', 'ultra-seven' ), ' ','<a href=" ' . esc_url('https://wpoperation.com/') . ' " title="'.esc_attr__('Premium WordPress Themes & Plugins by WPOperation','ultra-seven').'" rel="designer" target="_blank">'.esc_html__('WPOperation','ultra-seven').'</a>' );
                        ?>
                    </div><!-- .footer-left --> 
                    <?php if($footer_menu=='show'){ ?>
                        <div class="footer-right wow fadeInRight">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-menu',
                                    'container' =>'',
                                    'menu_class' => 'ultra-footer-menu',
                                    'fallback_cb' => 'wp_page_menu',
                                    'depth'       => -1  
                                ) );
                            ?>
                        </div><!-- .footer-right -->
                    <?php }?>
                </div>
            </div>          
        <?php
    }
}
add_action('ultra_seven_footer','ultra_seven_bottom_footer',20);
