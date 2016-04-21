<?php
//Recent / Most Commented Widget

function tfuse_tabs_posts($atts) {
    extract(shortcode_atts(array('items' => ''), $atts));
   
    
    $recent_posts  = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'recent',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 50,
                                'image_height' => 46,
                                'image_class' => 'thumbnail',
                                'date_format' => 'M j, Y',
                                'date_post' => true
                                ));
    
    $commented_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'commented',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 50,
                                'image_height' => 46,
                                'image_class' => 'thumbnail',
                                'date_format' => 'M j, Y',
                                'date_post' => true,
                            ));
    
    $return_html = '';
    $return_html .='<div class="tf_sidebar_tabs tabs_framed no-padding">
        <ul class="nav nav-tabs clearfix active_bookmark1" id="tabs">
            <li class="active"><a href="#tf_tabs_1">'.__('Recent Posts','tfuse').'</a></li>
            <li><a href="#tf_tabs_2">'.__('Most Commented','tfuse').'</a></li>
        </ul><div class="tab-content">';

    $return_html .= '<div id="tf_tabs_1" class="tab-pane active">
                    <ul class="post_list recent_posts">';
                        foreach ($recent_posts as $post_val) {
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a>'. ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_title'] . '</a>
                                        ';
                                        if(tfuse_options('date_time')):
                                            $return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
                                        endif;
                            $return_html .= '</li>';
                        }
    $return_html .='</ul>
        </div>

        <div id="tf_tabs_2" class="tab-pane">
                    <ul class="post_list popular_posts">';
                        foreach ($commented_posts as $post_val) {
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" >&nbsp;' . $post_val['post_title'] . '</a>
                                        ';
                                        if(tfuse_options('date_time')):
                                            $return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
                                        endif;
                            $return_html .= '</li>';
                        }
     $return_html .= '</ul>
         </div>
        </div>
    </div>';
     
     $return_html .='  <script>
				jQuery("#tabs a").click(function (e) {
					  e.preventDefault();
					  jQuery(this).tab("show");
					})
			</script>';
    return $return_html;
}

$atts = array(
    'name' => __('Tab Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_tabs_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('tabs_posts','tfuse_tabs_posts', $atts);