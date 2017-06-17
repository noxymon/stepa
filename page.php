<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
<div class="col-md-12">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <h2 class="post-title"><?php the_title(); ?></h2>
            <?php posted_on(); ?>
            <div class="entry">
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => __('Pages: ','html5reset'), 'next_or_number' => 'number')); ?>
            </div>
            <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>
        </article>
        <?php comments_template(); ?>
    <?php endwhile; endif; ?>
</div> <!--col-md-8 main close tag-->
</div> <!--close div for main row-->
<?php get_footer(); ?>