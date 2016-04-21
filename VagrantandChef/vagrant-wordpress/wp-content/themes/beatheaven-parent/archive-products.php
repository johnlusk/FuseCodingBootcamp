<?php get_header();?>
<?php get_template_part('player','top');?>
<?php tfuse_enable_breadcrumbs();?>
<?php  tfuse_header_content('bottom');?>
<?php  tfuse_shortcode_content('before'); ?>
<div class="middle clearfix full_width" style="background:<?php echo tfuse_middle_background();?>">
    <div class="content">
        <div class="postlist gridlist clearfix" <?php echo tfuse_content_id();?>>
            <?php if (have_posts()) 
             { $count = 0;
                 while (have_posts()) : the_post(); $count++;
                     get_template_part('listing', 'products');
                 endwhile;
             } 
             else 
             { ?>
                 <h2><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h2>
       <?php } ?>
        </div>
        <?php  tfuse_select_pagination();?>
    </div>
</div><!--/ .middle -->
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="products" name="is_this_tax"  />
<?php tfuse_shortcode_content('after'); ?>
<?php  tfuse_header_content('footer');?>
<?php get_footer();?>