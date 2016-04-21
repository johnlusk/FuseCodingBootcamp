<?php

function tfuse_events_categories($atts, $content = null) {
    extract(shortcode_atts(array( ), $atts));
    
    $output = $count = '';  
    
    $events = get_terms('events',$args = array( 'orderby' => 'count','order' => 'DESC'));

    if(!empty($events))
    {
        $post_per_page = get_option('posts_per_page');
        
        foreach($events as $event)
        {

            $child = get_term_children( $event->term_id, 'events' );
            if(empty($child))
            {
                $all_children[] = $child;
            }

        }
        
         $output .='<div class="shortcode postlist gridlist shortcode_events clearfix">';
            foreach($events as $event)
           {
               $child = get_term_children( $event->term_id, 'events' );
               if(empty($child))
               {
                   $link = get_term_link( $event, 'events' );
                   $output .= '<div class="post-item clearfix">
                               <div class="post-image"><a href="'.$link.'"><img src="' . TF_GET_IMAGE::get_src_link(tfuse_options('events_thumbnail','',$event->term_id), 220, 200) . '" alt=""></a></div>
                               <div class="post-title">
                                   <h3><a href="'.$link.'">'.$event->name.'</a></h3>
                               </div>
                               <div class="post-descr entry">
                                   <p>'.$event->description.'</p>
                               </div>
                               <div class="post-more"><a href="'.$link.'">'.__('Events for this location','tfuse').'</a></div>
                           </div>';
                    $count++;
                    if($post_per_page == $count) break;
               }
               
           }
         $output .='</div>';
         
         $output .= '
                <div class="tf_pagination">
                    <div class="inner">
                        <a href="" class="page-numbers" id="load_shortcode_events">'.__('LOAD MORE','tfuse').'</a>
                    </div>
                </div>';
         
        $num_posts = count($all_children);  
        $max = $num_posts/$post_per_page; 
        if($num_posts%$post_per_page != 0) $max++; 
        
        wp_localize_script(
                'general',
                'shortcode_events',
                array(
                    'max_specific' => $post_per_page,
                    'child_numb' => $num_posts,
                    'maxPages' => $max
                    )
            );
    }
    return $output;
}
add_action('wp_print_scripts', 'tfuse_events_categories', 1000,2);
$atts = array(
    'name' => __('Events Categories','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 20,
    'options' => array(
    )
);

tf_add_shortcode('events_categories', 'tfuse_events_categories', $atts);
