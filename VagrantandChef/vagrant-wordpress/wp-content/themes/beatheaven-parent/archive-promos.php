<?php get_header();?>
<?php get_template_part('player','top');?>
<?php tfuse_enable_breadcrumbs();?>
<?php  tfuse_header_content('bottom');?>
<?php get_template_part('category','filter');?>
<?php  tfuse_shortcode_content('before'); ?>
<?php $title = tfuse_get_promo_title();?>
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
        <div class="title_box">
            <?php  if(!empty($title)): ?> <span class="icon icon-tags icon-flip-horizontal"></span><h1> <?php echo $title; ?> </h1> <?php endif;?>
        </div>
            <div class="postlist " <?php echo tfuse_content_id();?>>
                <?php if (have_posts()) 
                 { $count = 0;
                     while (have_posts()) : the_post(); $count++;
                         get_template_part('listing', 'promos');
                     endwhile;
                 } 
                 else 
                 { ?>
                     <h2><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h2>
           <?php } ?>
            </div>
            <?php  tfuse_select_pagination();?>
    </div>
    <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
        <div class="sidebar">
            <?php get_sidebar(); ?>
        </div>
    <?php endif; ?>
</div><!--/ .middle -->
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="promos" name="is_this_tax"  />
<?php tfuse_shortcode_content('after'); ?>
<?php  tfuse_header_content('footer');?>
<?php get_footer();?>