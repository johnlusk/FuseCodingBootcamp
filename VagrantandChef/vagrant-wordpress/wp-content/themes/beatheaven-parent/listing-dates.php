<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Beatheaven 1.0
 */
 global $more,$post;
    $more = apply_filters('tfuse_more_tag',0);
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
?>
<li class="event_item clearfix">
    <div class="event_side">
        <div class="event_icon"><span class="icon <?php echo tfuse_options('icon_class','',$term->term_id); ?>"></span></div>
        <div class="event_date"><?php echo tfuse_get_event_date($post->ID);?></div>
        <div class="event_price"><?php _e('From','tfuse'); ?> <strong><?php echo tfuse_page_options('ticket_price');?></strong></div>
    </div>
    <div class="event_descr">
        <div class="event_image"><?php echo tfuse_media($return=false,$type = 'events');?></div>
        <div class="event_location"><?php echo tfuse_page_options('tour_location');?></div>
        <div class="event_title">
            <div class="inner">
                <h3><?php  echo get_the_title(); ?></h3>
                <span><?php echo tfuse_tour_date($post->ID);?></span>
            </div>
        </div>
        <div class="event_details">
            <a href="<?php the_permalink(); ?>"><span class="icon icon-shopping-cart"></span><?php _e(' BUY TICKETS','tfuse'); ?></a>
        </div>
    </div>
</li>