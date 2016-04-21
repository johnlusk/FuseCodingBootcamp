<?php

function tfuse_locations($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));
    
    $output = $count = '';  
    $locations = get_terms('location',$args = array( 'orderby' => 'count','order' => 'DESC'));
	$all_children  = array();
    if(!empty($locations))
    {
        $post_per_page = get_option('posts_per_page');
        
        //get pagination info
        foreach($locations as $location)
        {

            $child = get_term_children( $location->term_id, 'location' );
            if(empty($child))
            {
                $all_children[] = $child;
            }

        }
        
        $output .='<div class="shortcode postlist gridlist shortcode_location clearfix">';
           foreach($locations as $location)
           {
               $child = get_term_children( $location->term_id, 'location' );
               if(empty($child))
               {
                   $link = get_term_link( $location, 'location' );
                   $output .= '<div class="post-item clearfix">
                               <div class="post-image"><a href="'.$link.'"><img src="' . TF_GET_IMAGE::get_src_link(tfuse_options('location_thumbnail','',$location->term_id), 220, 200) . '" alt=""></a></div>
                               <div class="post-title">
                                   <h3><a href="'.$link.'">'.$location->name.'</a></h3>
                               </div>
                               <div class="post-descr entry">
                                   <p>'.$location->description.'</p>
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
                        <a href="" class="page-numbers" id="load_shortcode_location">'.__('LOAD MORE','tfuse').'</a>
                    </div>
                </div>';
            
        $num_posts = count($all_children);  
        $max = $num_posts/$post_per_page; 
        if($num_posts%$post_per_page != 0) $max++; 
        
        wp_localize_script(
                'general',
                'shortcode_location',
                array(
                    'max_specific' => $post_per_page,
                    'child_numb' => $num_posts,
                    'maxPages' => $max
                    )
            );
    }
    return $output;
}
add_action('wp_print_scripts', 'tfuse_locations', 1000,2);
$atts = array(
    'name' => __('Locations','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 20,
    'options' => array(
    )
);

tf_add_shortcode('locations', 'tfuse_locations', $atts);
