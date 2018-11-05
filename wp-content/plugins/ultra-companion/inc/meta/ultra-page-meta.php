<?php
/**
 * Fucntions for rendering metaboxes in post area
 * 
 * @package WPoperation
 * @subpackage Ultra Companion
 * @since 1.0.0
 */

add_action( 'add_meta_boxes', 'ultra_seven_page_metabox' );

if( !function_exists( 'ultra_seven_page_metabox' ) ):
	function ultra_seven_page_metabox() {
		add_meta_box(
			'ultra_seven_post_metabox_settings', // $id
			esc_html__( 'Page Options', 'ultra-companion' ), // $title
			'ultra_seven_page_metabox_settings_callback', // $callback
			'page', // $page
			'normal', // $context
			'high'
        ); // $priority
	}
endif; //ultra_seven_page_metabox



/**
 * Call back function for post option
 */
if( !function_exists( 'ultra_seven_page_metabox_settings_callback' ) ):

	function ultra_seven_page_metabox_settings_callback() {
		global $post;
        $ultra_seven_page_sidebar = array(
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
		wp_nonce_field( basename( __FILE__ ), 'ultra_seven_page_meta_nonce' );
?>
	<ul class="ultra-page-meta-tabs">
        <li class="meta-menu-titlebar active" atr="pg-metabox-info"><i class="fa fa-info"></i><?php esc_html_e( 'Information', 'ultra-companion' ); ?></li>
        <li class="meta-menu-sidebars" atr="pg-metabox-sidebars"><i class="fa fa-map-o"></i><?php esc_html_e( 'Sidebars', 'ultra-companion' ); ?></li>
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

            <!-- Page sidebars -->
            <div id="pg-metabox-sidebars" class="pg-metabox-inside">
            	<div class="meta-row">
                    <div class="meta-title"> <?php esc_html_e( 'Available Sidebars', 'ultra-companion' ); ?> </div>
                    <span class="section-desc"><em><?php esc_html_e( 'Select available sidebar which replaced sidebar layout from customizer settings.', 'ultra-companion' ); ?></em></span>
                    <div class="meta-options">
                        <div class="layout-thmub-section">
			                <ul class="single-sidebar-layout" id="ultra-img-container-meta">
			                <?php
			                    $img_count = 0 ; 
			                   foreach ( $ultra_seven_page_sidebar as $field ) {
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
			            </div><!-- .layout-thmub-section -->
                    </div><!-- .meta-options -->
                </div>
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
        </div><!--.pg-metabox-->
    <div class="clear"></div>
<?php
	}
endif;

/**
 * Function for save sidebar layout of post
 */
add_action( 'save_post', 'ultra_seven_save_page_settings' );

if( ! function_exists( 'ultra_seven_save_page_settings' ) ):

function ultra_seven_save_page_settings( $post_id ) {

    global $post, $ultra_seven_page_sidebar;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'ultra_seven_page_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'ultra_seven_page_meta_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
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
  

    /*Page sidebar Layout*/    
    $old = get_post_meta( $post_id, 'ultra_seven_page_sidebar', true ); 
    $new = sanitize_text_field( $_POST['ultra_seven_page_sidebar'] );
    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'ultra_seven_page_sidebar', $new );  
    } elseif ( '' == $new && $old ) {  
        delete_post_meta( $post_id,'ultra_seven_page_sidebar', $old );  
    }

    /** 
     * Page sidebar
     */
    $old = get_post_meta( $post_id, 'ultra_seven_sidebar', true ); 
    $new = sanitize_text_field( $_POST['ultra_seven_sidebar'] );
    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'ultra_seven_sidebar', $new );  
    } elseif ( '' == $new && $old ) {  
        delete_post_meta( $post_id,'ultra_seven_sidebar', $old );  
    }

}
endif;