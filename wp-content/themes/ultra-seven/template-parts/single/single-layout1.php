<?php
/**
 * Template part for displaying single post layout 3
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */
$post_id = get_the_ID();
?>
<div class="layout-two">
	<div class="ultra-container">
		<?php ultra_seven_breadcrumbs();?>
	<div class="primary content-area">
		<?php 
		$img_class = 'no-img';
		if( has_post_thumbnail() ){
			$img_class = 'has-img';
		} ?>
		<div class="single-header <?php echo esc_attr($img_class); ?>">
			<?php ultra_seven_post_formats(); ?>
			<div class="single-header-content">
				<?php ultra_seven_post_cat_lists(); ?>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="post-meta clearfix">
					<?php 
						ultra_seven_posted_on();
						ultra_seven_post_views();
						ultra_seven_post_comments();
					?>
				</div><!-- .entry-meta -->
			</div>
		</div>
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php
						the_content( sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ultra-seven' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ultra-seven' ),
							'after'  => '</div>',
						) ); ?>
	            </div><!-- .entry-content -->        
	            <?php 
				/**
				 * Post Tags
				 */
				if( get_the_tag_list() != '' ){
	            ?>   
                <div class="post-tag">
                	<span class="tag-title"><?php echo esc_html__('Related tags : ','ultra-seven');?></span>
                	 <?php ultra_seven_single_post_tags_list();?>
                </div>
				<?php }?>

                <?php
				/**
				 * Post Share
				 */
				if(class_exists('Ultra_Companion')){
				?>
		        <div class="single-share">
		        <span class="share-title"><?php echo esc_html__('Share:','ultra-seven');?></span>
                    <?php 
                    	ultra_seven_social_share();
                    ?>
		        </div>
		        <?php 
		        }

				/**
				 * Post navigation
				 */
                ultra_seven_single_post_pagination();
				
	            /**
				* Related posts
				*/
				do_action( 'ultra_seven_related_posts' );					
				?>
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
				<footer class="entry-footer">
					<?php ultra_seven_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->
			<?php
				
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php		
	  get_sidebar();
	?>
	</div>
</div>