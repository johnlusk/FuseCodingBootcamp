<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Beatheaven 1.0
 */
?>
<div class="post-image"><?php echo tfuse_media($return=false,$type = '');?></div>
    <h1><?php tfuse_custom_title();?></h1>
<?php the_content(); ?>
<a href="<?php echo tfuse_page_options('product_link');?>" class="btn btn-primary btn-lg"><span class="icon icon-shopping-cart"></span><?php _e(' PURCHASE IN STORE','tfuse'); ?></a> 
<?php wp_link_pages(); ?>