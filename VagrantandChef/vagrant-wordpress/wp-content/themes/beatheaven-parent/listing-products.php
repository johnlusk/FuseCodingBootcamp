<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Beatheaven 1.0
 */
?>
<div class="post-item clearfix">
    <div class="post-image"><?php echo tfuse_media($return=false,$type = 'promo');?></a></div>
    <div class="post-title">
        <h3><a href="<?php the_permalink(); ?>"><?php  tfuse_custom_title(); ?></a></h3>
    </div>
    <div class="post-descr entry">
       <p><?php echo strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),15)); ?></p>
    </div>
    <div class="post-more"><a href="<?php echo tfuse_page_options('product_link');?>"><?php _e('Add to Cart','tfuse'); ?></a></div>
</div>