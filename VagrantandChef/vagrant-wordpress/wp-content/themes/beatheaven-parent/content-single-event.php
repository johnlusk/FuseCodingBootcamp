<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Beatheaven 1.0
 */
?>
<div class="post-image"><?php echo tfuse_media($return=false,$type = 'blog');?></div>
    <h1><?php tfuse_custom_title();?></h1>
    <?php the_content(); ?>
	 <?php wp_link_pages(); ?>