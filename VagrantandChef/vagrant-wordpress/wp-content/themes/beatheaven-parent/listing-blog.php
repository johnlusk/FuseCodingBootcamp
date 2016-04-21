<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Beatheaven 1.0
 */
 global $more;
    $more = apply_filters('tfuse_more_tag',0);
?>
<div class="post-item clearfix">
    <div class="post-image image_center"><?php echo tfuse_media($return=false,$type = 'blog');?></div>
    <div class="post-meta">
        <span class="post-date"><?php echo get_the_date();?></span> &nbsp;|&nbsp; 
        <a href="<?php comments_link(); ?>" class="link-comments"><?php comments_number("0 ".__('comments','tfuse'), "1 ".__('comment','tfuse'), "% ".__('comments','tfuse')); ?></a>
    </div>
    <div class="post-title">
        <h2><a href="<?php the_permalink(); ?>"><?php  tfuse_custom_title(); ?></a></h2>
    </div>
    <div class="post-descr entry">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( tfuse_options('post_content') == 'content' ) the_content('...'); else the_excerpt(); ?>
		</div>
    </div>
    <div class="post-more">
        <a href="<?php comments_link(); ?>" class="link-comments"><?php _e(' POST A NEW COMMENT ','tfuse'); ?>
            <span class="icon icon-comment"></span></a>
        <a href="<?php the_permalink(); ?>"><?php _e('READ THE ARTICLE','tfuse'); ?></a>
    </div>
</div>