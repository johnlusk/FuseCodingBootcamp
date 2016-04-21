<?php get_header();?>
<div class="white_row filters filter_short clearfix">
    <h1><?php _e( 'Tag Archives:', 'tfuse' ); echo single_tag_title( '', true);?></h1>
</div>
<div class="before_content divideline clearfix" style="background:<?php echo tfuse_middle_background();?>">
    <div class="event_list clearfix">
        <ul>
            <?php if (have_posts()) 
             { $count = 0;
                while (have_posts()) : the_post(); $count++;
                    get_template_part('listing', 'events');
                endwhile;
                ?>
                <li class="event_item not_event"></li>
                <?php 
             } 
             else 
             { ?>
                 <h2><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h2>
          <?php } ?>
        </ul>
    </div>
    <?php  tfuse_pagination();?>
</div>
<?php get_footer();?>