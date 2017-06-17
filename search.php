<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
    <div class="col-md-8">
        <?php if (have_posts()) : ?>
            <h2><?php _e('Search Results','html5reset'); ?></h2>
            <?php post_navigation(); ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <?php posted_on(); ?>
                    <hr/>
                    <div class="entry">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php post_navigation(); ?>
        <?php else : ?>
            <div class="alert alert-danger">
                <h4 style="text-align: center"><?php _e("I'm sorry, i cant found any matches ! <strong>:(</strong>",'html5reset'); ?></h4>
            </div>
        <?php endif; ?>
    </div> <!--col-md-8 main close tag-->
    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>
</div> <!--close div for main row-->
<?php get_footer(); ?>
