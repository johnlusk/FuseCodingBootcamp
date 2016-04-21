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
    <?php if ( tfuse_page_options('disable_post_meta',tfuse_options('disable_post_meta'))) : ?>
        <div class="post-meta">
            <?php if ( tfuse_page_options('disable_published_date',tfuse_options('disable_published_date'))  && tfuse_options('date_time')) : ?>
                <span class="post-date"><?php echo get_the_date();?></span>
                <?php if ( tfuse_page_options('disable_comments',tfuse_options('disable_posts_comments'))  ) : ?>
                    &nbsp;|&nbsp; 
                <?php endif; ?>
            <?php endif; ?>
            <?php if ( tfuse_page_options('disable_comments',tfuse_options('disable_posts_comments'))  ) : ?>        
                <a href="#comments" class="link-comments anchor"><?php comments_number("0 ".__('comments','tfuse'), "1 ".__('comment','tfuse'), "% ".__('comments','tfuse')); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <h1><?php tfuse_custom_title();?></h1>
    
    <?php the_content(); ?> 
	 <?php wp_link_pages(); ?>
    
<?php if ( tfuse_page_options('disable_author_info',tfuse_options('disable_author_info')) ) : ?>
    <?php get_template_part('content','author');?>
<?php endif; ?>

<?php $tag = get_the_tags();
if ( tfuse_page_options('disable_meta', true)  ) :
    if (!empty($tag)): ?>
        <div class="tag_links"><?php _e('Tags: ','tfuse');?><?php the_tags( '', ', ', '' ); ?></div>
    <?php endif; ?>
    <div class="category_list"><?php _e('Categories: ','tfuse');?><?php echo get_the_category_list(', ') ?></div>
<?php endif; ?>