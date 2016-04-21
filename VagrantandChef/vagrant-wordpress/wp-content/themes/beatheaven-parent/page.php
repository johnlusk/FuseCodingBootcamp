<?php 
global $is_tf_blog_page,$post;
$id_post = $post->ID; 
if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php get_template_part('player','top');?>
<?php tfuse_enable_breadcrumbs();?>
<?php  tfuse_header_content('bottom');?>
<?php  tfuse_shortcode_content('before'); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php if ($sidebar_position == 'left') : ?>
    <div class="middle clearfix sidebar_left" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <div class="middle clearfix cols2" style="background:<?php echo tfuse_middle_background();?>">
<?php endif; ?> 
<?php if ($sidebar_position == 'full') : ?>
    <div class="middle clearfix full_width" style="background:<?php echo tfuse_middle_background();?>">
<?php endif; ?> 
        <div class="content">
            <?php tfuse_page_custom_title(); ?>
            <?php  while ( have_posts() ) : the_post();?>
                <article class="post-detail entry">
                    <?php the_content(); ?>
                </article>
            <?php break; endwhile; // end of the loop. ?>
            <?php tfuse_comments(); ?>
        </div>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
        <?php endif; ?>
</div><!--/ .middle -->
<?php tfuse_shortcode_content('after'); ?>
<?php  tfuse_header_content('footer');?>
<?php get_footer();?>