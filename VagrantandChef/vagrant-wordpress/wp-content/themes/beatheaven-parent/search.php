<?php get_header(); global $TFUSE; $search_query = get_search_query();?>
<?php get_template_part('player','top');?>
<?php  tfuse_header_content('bottom');?>

<?php 
if($TFUSE->request->isset_GET('events') || $TFUSE->request->isset_GET('post_type') || $TFUSE->request->isset_GET('filter_date'))
{?>
    <?php $term_name = tfuse_search_term_name(); $filter_dt = $TFUSE->request->GET('filter_date');?>
    <?php get_template_part('events','filter');?>
       <div class="before_content divideline clearfix"> 
           <div class="title_box title_box_md">
                <i class="icon icon-star"></i>
                <?php if(!empty($filter_dt) || $search_query != ' '):?>
                    <h2><?php _e('YOUR SEARCH RESULTS', 'tfuse'); ?></h2>
                <?php else: ?>
                    <h2><?php _e('Don\'t forget to use the filters ABOVE', 'tfuse'); ?></h2>
                <?php endif;?>
                <?php if(!empty($term_name)):?>
                    <div class="subtitle"><?php _e('Category', 'tfuse'); ?>:  <?php echo $term_name;?></div>
                <?php endif;?>
           </div>
           <div class="event_list padding clearfix">
                <ul <?php echo tfuse_content_id();?>>
                   <?php if (have_posts() ) {
                            while (have_posts()) :  the_post();
                                get_template_part('listing', 'events');
                            endwhile;
            ?>  </ul><?php
                        } else 
                        { ?>
                             <h1 class="search_event"><?php _e('Sorry, no events found.', 'tfuse'); ?></h1>
                   <?php } ?>
            </div>
            <?php tfuse_select_pagination();?> 
       </div>
    <input type="hidden" value="<?php echo $TFUSE->request->GET('post_type');?>" name="post_type"  />
    <input type="hidden" value="<?php tfuse_convert_date();?>" name="events_date"  />
    <input type="hidden" value="<?php echo $TFUSE->request->GET('s');?>" name="search_param"  />
    <input type="hidden" value="<?php echo $TFUSE->request->GET('events');?>" name="events_exist"  />
    <input type="hidden" value="search_date" name="search_date"  />
<?php }
else
{ 
    $cat = (get_query_var('cat')) ? get_query_var('cat') : '';
    $term = (get_query_var('term')) ? get_query_var('term') : '';
    ?>
    <div class="white_row filters filter_short clearfix">
        <h1><?php printf( __( 'Search Results for  \'%s\'', 'tfuse' ),get_search_query() ); ?></h1>
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
            <div class="postlist bloglist" <?php echo tfuse_content_id();?>>
                <?php 
                    if (have_posts()) 
                     { $count = 0;
                         while (have_posts()) : the_post(); $count++;
                            if(!empty($cat))
                                get_template_part('listing', 'blog');
                            else
                                get_template_part('listing', 'promos');
                         endwhile;
                     } 
                     else 
                     { ?>
                         <h1><?php _e('Sorry, no posts found.', 'tfuse'); ?></h1>
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
    <input type="hidden" value="<?php echo $cat;?>" name="search_cat"  />
    <input type="hidden" value="<?php echo $term;?>" name="search_tax"  />
    <?php 
}?>
<input type="hidden" value="<?php echo $search_query; ?>" name="search_key"  />
<input type="hidden" value="search" name="is_this_tax"  />
<?php  tfuse_header_content('footer');?>
<?php get_footer();?>