<?php

function tfuse_events($atts, $content = null) {
    extract(shortcode_atts(array( 'item' => '','title' => '','category' => '','link' => ''), $atts));
    $output = $count = ''; 
    tfuse_list_events_categories();
    if(!empty($category))
    {
        $term = get_term( $category, 'events');
    }
    
    $args = array(
                'posts_per_page' => -1,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'events',
                            'field' => 'id',
                            'terms' => $category
                        )
                )
        );
   $query = new WP_Query( $args );
   $posts = $query->posts;

   if(!empty($posts))
   {
    $output .= '<div class="title_box_big">
                <h2>'.$title.'</h2>
                <div class="subtitle">'.__('CATEGORY','tfuse').': '.strtoupper($term->name).'<span class="separator">|</span> <a href="'.$link.'">'.__('Change Category','tfuse').'</a></div>
            </div>

            <div class="postlist gridlist clearfix">';
                foreach($posts as $post){ 
                   if($count == $item) break; $count++;
                   $img = tfuse_page_options('single_image','',$post->ID);
                   if(!empty($img)) $image = '<div class="post-image"><a href="'.get_permalink( $post->ID ).'"><img src="' . TF_GET_IMAGE::get_src_link($img, 220, 200) . '" alt=""></a></div>';
                   else $image = '';
                   $output .=' <div class="post-item clearfix">
                        '.$image.'
                        <div class="post-title">
                            <h3><a href="'.get_permalink( $post->ID ).'">'.get_the_title($post->ID).'</a></h3>
                        </div>
                        <div class="post-descr entry">
                            <p>'.tfuse_shorten_string(strip_shortcodes($post->post_content),15).'</p>
                        </div>
                        <div class="post-more"><a href="'.get_permalink( $post->ID ).'">'.__('FIND OUT MORE','tfuse').'</a></div>
                    </div>';
                }
           $output .='</div>';
   }
    return $output;
}

$atts = array(
    'name' => __('Events','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 20,
    'options' => array(
        array(
            'name' => __('Select Category','tfuse'),
            'desc' => __('Select event category','tfuse'),
            'id' => 'tf_shc_events_category',
            'value' => '',
             'options' => tfuse_list_events_categories(),
            'type' => 'select',
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('All categories link','tfuse'),
            'id' => 'tf_shc_events_link',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_events_item',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_events_title',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('events', 'tfuse_events', $atts);
