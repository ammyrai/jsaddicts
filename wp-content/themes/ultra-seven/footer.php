<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ultra Seven
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

?>

	</div><!-- #content -->
    <?php 

    if(is_active_sidebar('footer-insta')){

    ?>
    <div class="footer-insta">
    <?php dynamic_sidebar('footer-insta');?>
    </div>
    <?php }?>
	<footer id="colophon" class="site-footer">

	   <?php do_action('ultra_seven_footer');?>

	</footer><!-- #colophon -->

    <div id="ultra-go-top">
        <a href="javascript:void(0)">
            <i class="fa fa-angle-up"></i>  
        </a>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
