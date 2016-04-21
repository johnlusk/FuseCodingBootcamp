<?php  get_header();?>
<?php get_template_part('player','top');?>
<?php  tfuse_header_content('bottom');?>
<div class="white_row filters filter_short clearfix">
    <h1><?php _e( 'Page 404', 'tfuse' ); ?></h1>
</div>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php if ($sidebar_position == 'left') : ?>
    <div class="middle clearfix sidebar_left">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <div class="middle clearfix cols2">
<?php endif; ?> 
<?php if ($sidebar_position == 'full') : ?>
    <div class="middle clearfix full_width">
<?php endif; ?> 
        <div class="content">
            <article class="post-detail entry">
                <p><?php _e('Page not found', 'tfuse') ?></p>
                <p><?php _e('The page you were looking for doesn&rsquo;t seem to exist', 'tfuse') ?>.</p>
            </article>
        </div>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
        <?php endif; ?>
</div><!--/ .middle -->
<?php  tfuse_header_content('footer');?>
<?php get_footer();?>