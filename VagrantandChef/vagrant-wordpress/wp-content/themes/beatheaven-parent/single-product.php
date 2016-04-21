<?php get_header(); ?>
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
            <article class="post-detail entry">
                <?php  while ( have_posts() ) : the_post();?>
					<?php get_template_part('content','single-product');?>
                <?php endwhile; // end of the loop. ?> 
            </article>
            <?php if ( tfuse_page_options('disable_comments',tfuse_options('disable_posts_comments')) ) : ?>
                <?php  tfuse_comments(); ?>
             <?php endif; ?>
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