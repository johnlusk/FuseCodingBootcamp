<?php

function tfuse_artists($atts, $content = null) {
    extract(shortcode_atts(array( ), $atts));
    
    $output = $count = '';  
    
    $tags = get_terms('tags',$args = array( 'orderby' => 'count','order' => 'DESC'));

    if(!empty($tags))
    {
        $post_per_page = get_option('posts_per_page');
        
         $output .='<div class="shortcode postlist gridlist shortcode_artist clearfix">';
            foreach($tags as $tag)
            {
                $link = get_term_link( $tag, 'tags' ); 
                $output .= '<div class="post-item clearfix">
                                <div class="post-image"><a href="'.$link.'"><img src="' . TF_GET_IMAGE::get_src_link(tfuse_options('tags_thumbnail','',$tag->term_id), 220, 200) . '" alt=""></a></div>
                                <div class="post-title">
                                    <h3><a href="'.$link.'">'.$tag->name.'</a></h3>
                                </div>
                                <div class="post-descr entry">
                                    <p>'.$tag->description.'</p>
                                </div>
                                <div class="post-more"><a href="'.$link.'">'.__('Events for this location','tfuse').'</a></div>
                            </div>';
                $count++;
                if($post_per_page == $count) break;
            }
         $output .='</div>';
         
         $output .= '
                <div class="tf_pagination">
                    <div class="inner">
                        <a href="" class="page-numbers" id="load_shortcode_artist">'.__('LOAD MORE','tfuse').'</a>
                    </div>
                </div>';
         
        $num_posts = count($tags);  
        $max = $num_posts/$post_per_page; 
        if($num_posts%$post_per_page != 0) $max++; 
        
        wp_localize_script(
                'general',
                'shortcode_artist',
                array(
                    'max_specific' => $post_per_page,
                    'child_numb' => $num_posts,
                    'maxPages' => $max
                    )
            );
    }
    return $output;
}
add_action('wp_print_scripts', 'tfuse_artists', 1000,2);
$atts = array(
    'name' => __('Artists','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 20,
    'options' => array(
    )
);

tf_add_shortcode('artists', 'tfuse_artists', $atts);
