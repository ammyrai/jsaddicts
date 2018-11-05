<?php
/**
 * Info setup
 *
 * @package Ultra Seven
 */

if ( ! function_exists( 'ultra_seven_details_setup' ) ) :

    /**
     * Info setup.
     *
     * @since 1.0.0
     */
    function ultra_seven_details_setup() {

        $config = array(

            // Welcome content.
            'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use. Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'ultra-seven' ), get_bloginfo('name'), 'Ultra Seven' ),

            // Tabs.
            'tabs' => array(
                'getting-started' => esc_html__( 'Getting Started', 'ultra-seven' ),
                'support'         => esc_html__( 'Support', 'ultra-seven' ),
                'useful-plugins'  => esc_html__( 'Useful Plugins', 'ultra-seven' ),
                'demo-content'    => esc_html__( 'Demo Content', 'ultra-seven' ),
                'free-vs-pro'    => esc_html__( 'Free vs Pro', 'ultra-seven' ),
                'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'ultra-seven' ),
            ),

            // Quick links.
            'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'ultra-seven' ),
                    'url'  => 'https://wpoperation.com/themes/ultra-seven/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'ultra-seven' ),
                    'url'  => 'http://demo.wpoperation.com/ultraseven',
                ),
                'documentation_url' => array(
                    'text' => esc_html__( 'View Documentation', 'ultra-seven' ),
                    'url'  => 'https://wpoperation.com/documentations/ultra-seven/',
                ),
                'rating_url' => array(
                    'text' => esc_html__( 'Rate This Theme','ultra-seven' ),
                    'url'  => 'https://wordpress.org/support/theme/ultra-seven/reviews/#new-post',
                ),
            ),

            // Getting started.
            'getting_started' => array(
                'one' => array(
                    'title'       => esc_html__( 'Theme Documentation', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-format-aside',
                    'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'View Documentation', 'ultra-seven' ),
                    'button_url'  => 'https://wpoperation.com/documentations/ultra-seven/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'two' => array(
                    'title'       => esc_html__( 'Static Front Page', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-admin-generic',
                    'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page & assign "Home" template from page attributes.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'Static Front Page', 'ultra-seven' ),
                    'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
                    'button_type' => 'primary',
                ),
                'three' => array(
                    'title'       => esc_html__( 'Theme Options', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-admin-customizer',
                    'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'Customize', 'ultra-seven' ),
                    'button_url'  => wp_customize_url(),
                    'button_type' => 'primary',
                ),
                'four' => array(
                    'title'       => esc_html__( 'Widgets', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-welcome-widgets-menus',
                    'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'Widgets', 'ultra-seven' ),
                    'button_url'  => admin_url('widgets.php'),
                    'button_type' => 'primary',
                ),
                'five' => array(
                    'title'       => esc_html__( 'Demo Content', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-layout',
                    'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit WPOp Demo Importer menu under Appearance.', 'ultra-seven' ), esc_html__( 'Operation Demo Importer', 'ultra-seven' ) ),
                    'button_text' => esc_html__( 'Demo Content', 'ultra-seven' ),
                    'button_url'  => admin_url( 'themes.php?page=ultra-seven-details&tab=demo-content' ),
                    'button_type' => 'secondary',
                ),
                'six' => array(
                    'title'       => esc_html__( 'Fix Image Sizes', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-format-gallery',
                    'description' => esc_html__( 'If you have already images on your site then all image might not align as expected, to fix this there is handy plugin which will help you', 'ultra-seven' ),
                    'button_text' => esc_html__( 'Fix Images Now', 'ultra-seven' ),
                    'button_url'  => 'https://wordpress.org/plugins/regenerate-thumbnails/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            // Support.
            'support' => array(
                'one' => array(
                    'title'       => esc_html__( 'Contact Support', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'Contact Support', 'ultra-seven' ),
                    'button_url'  => 'https://wpoperation.com/support/support/free-themes/ultra-seven/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'two' => array(
                    'title'       => esc_html__( 'Theme Documentation', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-format-aside',
                    'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'View Documentation', 'ultra-seven' ),
                    'button_url'  => 'https://wpoperation.com/documentations/ultra-seven/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'three' => array(
                    'title'       => esc_html__( 'Child Theme', 'ultra-seven' ),
                    'icon'        => 'dashicons dashicons-admin-tools',
                    'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'ultra-seven' ),
                    'button_text' => esc_html__( 'Learn More', 'ultra-seven' ),
                    'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            //Useful plugins.
            'useful_plugins' => array(
                'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'ultra-seven' ),
            ),

            //Demo content.
            'demo_content' => array(
                'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see WPop Demo Importer menu under Appearance.', 'ultra-seven' ), '<a href="https://wordpress.org/plugins/operation-demo-importer/" target="_blank">' . esc_html__( 'Operation Demo Importer', 'ultra-seven' ) . '</a>' ),
            ),


            //Free vs Pro.
            'free_vs_pro' => array(

                'features' => array(
                    'Preloader Options' => array('Simple','18+ Customizable'),
                    'Beautiful Mega Menu' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Post Review System' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Live AJAX search' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Powerful AJAX elements'=> array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Theme Option Panel'=> array('Customizer Based','Powerful Theme Panel'),
                    'Infinite Scroll Posts'=> array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'One Click Demo' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Typography Style & Colors' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Multiple Header Options' => array('2','3'),
                    'Lazy Load Images' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Logo and title customization' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'WooCommerce Compatibility' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Category Color Options' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Advertisements' => array('Simple','Advanced'),
                    'Author Biography' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'YouTube Video Playlist' => array('Simple','Powerful'),
                    'Multiple Home Layout' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Social Sharings' => array('yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Display Related Posts' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Footer Widgets Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Hide Theme Credit Link' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Responsive Layout' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Translations Ready' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'RTL Language Ready' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'SEO' => array('Optimized', 'Optimized'),
                    'Support' => array('Yes', 'High Priority Dedicated Support')
                ),
            ),

            // Upgrade content.
            'upgrade_to_pro' => array(
                'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'ultra-seven' ),
                'button_text' => esc_html__( 'Upgrade Now', 'ultra-seven' ),
                'button_url'  => 'https://wpoperation.com/themes/ultra-eleven/',
                'button_type' => 'primary',
                'is_new_tab'  => true,
            ),
        );

        Ultra_Seven_Info::init( $config );
    }

endif;

add_action( 'after_setup_theme', 'ultra_seven_details_setup' );