<?php
/**
 * Fucntions for rendering metaboxes in post area
 * 
 * @package WPoperation
 * @subpackage Ultra Companion
 * @since 1.0.0
 */

add_action( 'add_meta_boxes', 'ultra_seven_post_metabox' );

if( !function_exists( 'ultra_seven_post_metabox' ) ):
	function ultra_seven_post_metabox() {
		add_meta_box(
			'ultra_seven_post_metabox_settings', // $id
			esc_html__( 'Post Options', 'ultra-companion' ), // $title
			'ultra_seven_post_metabox_settings_callback', // $callback
			'post', // $page
			'normal', // $context
			'high'
        ); // $priority
	}
endif; //ultra_seven_post_metabox



/**
 * Call back function for post option
 */
if( !function_exists( 'ultra_seven_post_metabox_settings_callback' ) ):

	function ultra_seven_post_metabox_settings_callback() {
		global $post;
        $ultra_seven_post_sidebar = array(
            'defaultsidebar' => array(
                            'value'     => 'default',
                            'label'     => esc_html__( 'Default Sidebar', 'ultra-companion' ),
                            'thumbnail' => UIMAGE_PATH.'sidebar-default.png',
                        ), 
            'rightsidebar' => array(
                            'value'     => 'rightsidebar',
                            'label'     => esc_html__( 'Right sidebar', 'ultra-companion' ),
                            'thumbnail' => UIMAGE_PATH.'sidebar-right.png', 
                        ),
            'leftsidebar' => array(
                            'value'     => 'leftsidebar',
                            'label'     => esc_html__( 'Left sidebar', 'ultra-companion' ),
                            'thumbnail' => UIMAGE_PATH.'sidebar-left.png',
                        ),
            'nosidebar' => array(
                            'value'     => 'nosidebar',
                            'label'     => esc_html__( 'No sidebar Full width', 'ultra-companion' ),
                            'thumbnail' => UIMAGE_PATH.'sidebar-no.png',
                        ),      
        );
		wp_nonce_field( basename( __FILE__ ), 'ultra_seven_post_meta_nonce' );
        $get_post_meta_identity = get_post_meta( $post->ID, 'post_meta_identity', true );
        $post_identity_value = empty( $get_post_meta_identity ) ? 'pg-metabox-info' : $get_post_meta_identity;
?>
	<ul class="ultra-page-meta-tabs">
        <li class="meta-menu-titlebar <?php if( $post_identity_value == 'pg-metabox-info' ) { echo 'active'; } ?>" atr="pg-metabox-info"><i class="fa fa-info"></i><?php esc_html_e( 'Information', 'ultra-companion' ); ?></li>
        <li class="meta-menu-titlebar <?php if( $post_identity_value == 'pg-metabox-sidebars' ) { echo 'active'; } ?>" atr="pg-metabox-sidebars"><i class="fa fa-map-o"></i><?php esc_html_e( 'Sidebars', 'ultra-companion' ); ?></li>
        <li class="meta-menu-titlebar <?php if( $post_identity_value == 'pg-metabox-format' ) { echo 'active'; } ?>" atr="pg-metabox-format"><i class="fa fa-cubes"></i><?php esc_html_e( 'Post Format', 'ultra-companion' ); ?></li>
    </ul><!--.tmp-page-meta-tabs-->
    <div class="pg-metabox">
        <!-- Header -->
        <div id="pg-metabox-info" class="pg-metabox-inside">
            <h3><?php esc_html_e( 'About Metabox Options', 'ultra-companion' ); ?></h3>
            <hr />
            <ul>
                <li><?php esc_html_e( 'Sidebars is globally available to every post type you create.', 'ultra-companion' ); ?></li>
            </ul>
        </div><!-- #pg-metabox-info-->

        <!-- Post sidebars -->
        <div id="pg-metabox-sidebars" class="pg-metabox-inside">
        	<div class="meta-row">
                <div class="meta-title"> <?php esc_html_e( 'Available Sidebars', 'ultra-companion' ); ?> </div>
                <span class="section-desc"><em><?php esc_html_e( 'Select available sidebar which replaced sidebar layout from customizer settings.', 'ultra-companion' ); ?></em></span>
                <div class="meta-options">
                    <div class="layout-thmub-section">
		                <ul class="single-sidebar-layout" id="ultra-img-container-meta">
		                <?php
		                    $img_count = 0 ; 
		                   foreach ( $ultra_seven_post_sidebar as $field ) {
		                        $img_count++;
		                        $ultra_seven_sidebar_meta_layout = get_post_meta( $post->ID, 'ultra_seven_page_sidebar', true );
		                        $default_class ='';
		                        if( empty( $ultra_seven_sidebar_meta_layout ) && $img_count == 1 ){
		                            $default_class = 'ultra-radio-img-selected';
		                        }
		                        $img_class = ( $field['value'] == $ultra_seven_sidebar_meta_layout )?'ultra-radio-img-selected ultra-radio-img-img':'ultra-radio-img-img'; 
		                ?>
		                    <li>
		                        <label>
		                            <img class="<?php echo esc_attr( $default_class.' '.$img_class );?>" src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] );?>" title="<?php echo esc_attr( $field['label'] );?>" />
		                            <input style = 'display:none' type="radio" value="<?php echo esc_attr( $field['value'] ); ?>" name="ultra_seven_page_sidebar" <?php checked( $field['value'], $ultra_seven_sidebar_meta_layout ); if( empty( $ultra_seven_sidebar_meta_layout ) && $field['value'] == 'default_sidebar' ){ echo "checked='checked'";}  ?> />
		                        </label>
		                    </li>
		                    
		                <?php } ?>
		                </ul>
		            </div><!-- .layout-thumb-section -->
                </div><!-- .meta-options -->
            </div><!-- .meta-row -->
            <div class="sidebar-select">
                <?php 
                 $all_sidebars = ultra_seven_get_sidebars();
                ?>
                <select name="ultra_seven_sidebar">
                    <option value=""><?php echo esc_html('Choose Sidebar Area','ultra-companion')?></option>
                    <?php
                    $sidebar_val = get_post_meta( $post->ID, 'ultra_seven_sidebar', true );
                     foreach ($all_sidebars as $value => $name) {
                        ?>
                        <option value="<?php echo esc_attr($value);?>" <?php selected( $value, $sidebar_val ); ?>><?php echo esc_html($name);?></option>
                        <?php
                     }
                    ?>
                </select>
            </div>
        </div><!-- #pg-metabox-sidebars -->

        <!-- Post format -->
        <div id="pg-metabox-format" class="pg-metabox-inside">
            <div class="meta-row">
                <div class="meta-title"> <?php esc_html_e( 'Fields for Post Format', 'ultra-companion' ); ?> </div>
                <div class="meta-options">
                    <div class="format-type-field" id="format-standard">
                        <div class="meta-title"><?php esc_html_e( 'Standard Format', 'ultra-companion' ); ?></div>
                        <div class="meta-desc"><?php esc_html_e( 'Currently standard format has been selected', 'ultra-companion' ); ?></div><!-- .meta-desc -->
                    </div><!-- #format-standard -->

                    <div class="format-type-field" id="format-video">
                        <?php $video_url_value = get_post_meta( $post->ID, 'post_embed_video_url', true ); ?>
                        <div class="meta-title"><?php esc_html_e( 'Video Format', 'ultra-companion' ); ?></div>
                        <div class="format-label"><strong><?php esc_html_e( 'Embed video url', 'ultra-companion' );?></strong></div>
                        <div class="format-input">
                            <input type="text" name="post_embed_video_url" size="90" class="post-video-url" value="<?php echo esc_url( $video_url_value ); ?>" />
                            <input class="button" type="button" id="reset-video-embed" value="<?php esc_html_e( 'Reset url', 'ultra-companion' ); ?>" />
                        </div><!-- .format-input -->
                        <span><em><?php esc_html_e( 'Please use youtube/vimeo video url ( https://www.youtube.com/watch?v=x7O-uwAJ4Pw ).', 'ultra-companion' ); ?></em></span>
                    </div><!-- #format-video -->

                    <div class="format-type-field" id="format-audio">
                        <?php $audio_url_value = get_post_meta( $post->ID, 'post_embed_audio_url', true ); ?>
                        <div class="meta-title"><?php esc_html_e( 'Audio Format', 'ultra-companion' ); ?></div>
                        <div class="format-label"><strong><?php esc_html_e( 'Embed audio url', 'ultra-companion' );?></strong></div>
                        <div class="format-input">
                            <input type="text" name="post_embed_audio_url" size="90" class="post-audio-url" value="<?php echo esc_url( $audio_url_value ); ?>" />
                            <input class="button" name="media_upload_button" id="post_audio_upload_button" value="<?php esc_html_e( 'Embed audio', 'ultra-companion' ); ?>" type="button" />
                            <input class="button" type="button" id="reset-audio-embed" value="<?php esc_html_e( 'Reset url', 'ultra-companion' ); ?>" />
                        </div><!-- .format-input -->
                    </div><!-- #format-audio -->

                    <div class="format-type-field" id="format-gallery">
                        <?php
                            $post_gallery_images = get_post_meta( $post->ID, 'post_images', true );
                            $post_images_count = get_post_meta( $post->ID, 'post_gallery_image_count', true );
                        ?>
                        <div class="meta-title"><?php esc_html_e( 'Gallery Format', 'ultra-companion' ); ?></div>
                        <div class="format-label"><strong><?php esc_html_e( 'Embed gallery images.', 'ultra-companion' );?></strong></div>
                        <div class="format-input">
                            <div class="post-gallery-section">
                                <?php
                                    $total_img = 0;
                                    if( !empty( $post_gallery_images ) ){
                                        $total_img = count( $post_gallery_images );
                                        $img_counter = 0;
                                        foreach( $post_gallery_images as $key => $img_value ){
                                           $attachment_id = ultra_seven_get_attachment_id_from_url( $img_value );
                                           $img_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
                                ?>
                                            <div class="gal-img-block">
                                                <div class="gal-img"><img src="<?php echo esc_url( $img_url[0] ); ?>" /><span class="fig-remove" title="<?php echo esc_attr( 'remove', 'ultra-companion' ); ?>"></span></div>
                                                <input type="hidden" name="post_images[<?php echo absint($img_counter); ?>]" class="hidden-media-gallery" value="<?php echo esc_url( $img_value ); ?>" />
                                            </div>
                                <?php
                                            $img_counter++;
                                        }
                                    }
                                ?>
                            </div><!-- .post-gallery-section -->
                            <input id="post_image_count" type="hidden" name="post_gallery_image_count" value="" />
                            <span class="add-img-btn" id="post_gallery_upload_button" title="<?php esc_html_e( 'Add Images', 'ultra-companion' ); ?>"></span>
                        </div><!-- .format-input -->
                    </div><!-- #format-gallery -->
                </div><!-- .meta-options -->
            </div><!-- .meta-row -->
        </div><!-- #pg-metabox-format -->

    </div><!--.pg-metabox-->
    <div class="clear"></div>
    <input type="hidden" id="post-meta-selected" name="post_meta_identity" value="<?php echo esc_attr( $post_identity_value ); ?>" />
<?php
	}
endif;

/**
 * Function for save sidebar layout of post
 */
add_action( 'save_post', 'ultra_seven_save_post_settings' );

if( ! function_exists( 'ultra_seven_save_post_settings' ) ):

function ultra_seven_save_post_settings( $post_id ) {

    global $post, $ultra_seven_post_sidebar;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'ultra_seven_post_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'ultra_seven_post_meta_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
    	return;
    }        
        
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ){
        	return $post_id;  
        }            
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }

    /** 
     * Post sidebar Layout
     */
    $old = get_post_meta( $post_id, 'ultra_seven_page_sidebar', true ); 
    $new = sanitize_text_field( $_POST['ultra_seven_page_sidebar'] );
    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'ultra_seven_page_sidebar', $new );  
    } elseif ( '' == $new && $old ) {  
        delete_post_meta( $post_id,'ultra_seven_page_sidebar', $old );  
    }


    /** 
     * Post sidebar
     */
    $old = get_post_meta( $post_id, 'ultra_seven_sidebar', true ); 
    $new = sanitize_text_field( $_POST['ultra_seven_sidebar'] );
    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'ultra_seven_sidebar', $new );  
    } elseif ( '' == $new && $old ) {  
        delete_post_meta( $post_id,'ultra_seven_sidebar', $old );  
    }

    /**
     * update post video format
     */
    $prev_video_url = esc_url( get_post_meta( $post_id, 'post_embed_video_url', true ) );
    $new_video_url = esc_url( $_POST['post_embed_video_url'] );

    if ( $new_video_url && '' == $new_video_url ){
        add_post_meta( $post_id, 'post_embed_video_url', $new_video_url );
    }elseif ( $new_video_url && $new_video_url != $prev_video_url ) {
        update_post_meta($post_id, 'post_embed_video_url', $new_video_url );
    } elseif ( '' == $new_video_url && $prev_video_url ) {
        delete_post_meta( $post_id, 'post_embed_video_url', $prev_video_url );
    }

    /**
     * update post audio format
     */
    $prev_audio_url = esc_url( get_post_meta( $post_id, 'post_embed_audio_url', true ) );
    $new_audio_url = esc_url( $_POST['post_embed_audio_url'] );

    if ( $new_audio_url && '' == $new_audio_url ){
        add_post_meta( $post_id, 'post_embed_audio_url', $new_audio_url );
    }elseif ( $new_audio_url && $new_audio_url != $prev_audio_url ) {
        update_post_meta($post_id, 'post_embed_audio_url', $new_audio_url );
    } elseif ( '' == $new_audio_url && $prev_audio_url ) {
        delete_post_meta( $post_id, 'post_embed_audio_url', $prev_audio_url );
    }

    /**
     * update post gallery format
     */
    $stz_post_image = $_POST['post_images'];
    update_post_meta( $post_id, 'post_images', $stz_post_image );

    $image_count = get_post_meta( $post->ID, 'post_gallery_image_count', true );
    $stz_image_count = sanitize_text_field( $_POST['post_gallery_image_count'] );
   
    if ( $stz_image_count && '' == $stz_image_count ){
        add_post_meta( $post_id, 'post_gallery_image_count', $stz_image_count );
    }elseif ($stz_image_count && $stz_image_count != $image_count) {
        update_post_meta($post_id, 'post_gallery_image_count', $stz_image_count);
    } elseif ('' == $stz_image_count && $image_count) {
        delete_post_meta($post_id,'post_gallery_image_count');
    }


    /**
     * post meta identity
     */
    $post_identity = get_post_meta( $post_id, 'post_meta_identity', true );
    $stz_post_identity = sanitize_text_field( $_POST[ 'post_meta_identity' ] );

    if ( $stz_post_identity && '' == $stz_post_identity ){
        add_post_meta( $post_id, 'post_meta_identity', $stz_post_identity );
    }elseif ( $stz_post_identity && $stz_post_identity != $post_identity ) {  
        update_post_meta($post_id, 'post_meta_identity', $stz_post_identity );  
    } elseif ( '' == $stz_post_identity && $post_identity ) {  
        delete_post_meta( $post_id, 'post_meta_identity', $post_identity );  
    }

}
endif;