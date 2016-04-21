<?php
/**
 * Latest Posts
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * items:
 * title:
 * image_width:
 * image_height:
 * image_class:
 */

function tfuse_latest_post($atts, $content = null)
{
    remove_filter('excerpt_more', 'custom_excerpt_more');
    add_filter( 'excerpt_more', 'custom_excerpt_more_shortcode' );
    $return_html = '';
    extract(shortcode_atts(array(
                                'items' => 5,
                                'title' => 'Recent Posts',
                                'image_width' => 86,
                                'image_height' => 86,
                                'image_class' => 'thumbnail'
                           ), $atts));

    $latest_posts = tfuse_shortcode_posts(array(
                                               'sort' => 'recent',
                                               'items' => $items,
                                               'image_post' => true,
                                               'image_width' => $image_width,
                                               'image_height' => $image_height,
                                               'image_class' => $image_class,
                                                'date_format'=> 'F jS,Y',
                                               'date_post' => true,
                                          ));
    $return_html .= '
    <div class="widget-container widget_postlist widget_recent_posts">';
         $return_html .= !empty($title) ? '<h3 class="widget-title">' . $title . '</h3>' : '';
    $return_html .= '<ul>';
    foreach ($latest_posts as $post_val):
        $return_html .= '<li class="clearfix">';
        $return_html .= '<a href="' . $post_val['post_link'] . '" class="post-title">' . $post_val['post_title'] . '</a>';
        $return_html .= '<div class="post-meta"><span class="post-date">'.$post_val['post_date_post'].'</span> &nbsp;|&nbsp;  <a href="'.$post_val['post_link'].'#comments" class="link-comments">'.strtolower(strip_tags($post_val['post_comnt_numb_link'])).'</a></div>';
        $return_html .= '<div class="extras">' . $post_val['post_img'];
		if(!empty($post_val['post_content']))
		{
			$return_html .= tfuse_shorten_string(strip_shortcodes($post_val['post_content']),17);
		}
		
		$return_html .='</div>
            <a href="' . $post_val['post_link'] . '" class="link-arrow">' . __('READ MORE', 'tfuse') . '<span></span></a>';
        $return_html .= '</li>';
    endforeach;
    $return_html .='</ul></div> ';

    return $return_html;
}

$atts = array(
    'name' => __('Latest Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_latest_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_latest_posts_title',
            'value' => __('Recent Posts','tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Image Width','tfuse'),
            'desc' => __('Specifies the width of an thumbnail','tfuse'),
            'id' => 'tf_shc_latest_posts_image_width',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Height','tfuse'),
            'desc' => __('Specifies the height of an thumbnail','tfuse'),
            'id' => 'tf_shc_latest_posts_image_height',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode. To specify multiple classes,<br /> separate the class names with a space, e.g. <b>"left important"</b>.','tfuse'),
            'id' => 'tf_shc_latest_posts_image_class',
            'value' => 'thumbnail',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('latest_posts', 'tfuse_latest_post', $atts);
