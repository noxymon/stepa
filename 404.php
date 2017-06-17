<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
    <div class="col-md-8">
        <div class="alert alert-danger">
            <h2><?php _e("I'm sorry, i can't find what you lookin for :(",'html5reset'); ?></h2>
        </div>
    </div> <!--col-md-8 main close tag-->
    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>
</div> <!--close div for main row-->
<?php get_footer(); ?>