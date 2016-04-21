<?php get_header();?>
<?php get_template_part('player','top');?>
<?php tfuse_enable_breadcrumbs();?>
<?php  tfuse_header_content('bottom');?>
<?php  tfuse_shortcode_content('before'); ?>
<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));?>
<div class="before_content divideline clearfix" style="background:<?php echo tfuse_middle_background();?>">
    <div class="title_box">
        <i class="icon icon-star"></i>
        <h2><?php echo tfuse_options('date_title','',$term->term_id);?></h2>
    </div>
    <div class="event_list padding clearfix">
        <ul <?php echo tfuse_content_id();?>>
            <?php if (have_posts()) 
             { $count = 0;
                while (have_posts()) : the_post(); $count++;
                    get_template_part('listing', 'dates');
                endwhile;
                ?>
        </ul>
                <?php 
             } 
             else 
             { ?>
                 <h2><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h2>
          <?php } ?>
    </div>
    <?php  tfuse_select_pagination();?>
</div>
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="dates" name="is_this_tax"  />
<?php tfuse_shortcode_content('after'); ?>
<?php  tfuse_header_content('footer');?>
<?php get_footer();?>