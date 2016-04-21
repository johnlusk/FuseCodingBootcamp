<?php


function tfuse_shortcode_menu($atts, $content = null)
{
    extract(shortcode_atts(array(  'menu' => ''), $atts));
    $out = '';
    $name = '';
    $items =wp_get_nav_menu_items($menu);
    if(!empty($items))
    {
        $out .='<div class="botmenu"><ul>';
        foreach ($items as $item)
        {
            if($item->menu_item_parent == 0)
            {
                if(empty($item->post_title)) $name = $item->title;
                else $name = $item->post_title;
                $out .='<li><a href="'.$item->url.'">'.$name.'</a></li>';
            }
        }
        $out .= '</ul></div>';
    }
    return $out;
}

$atts = array(
    'name' => __('Menu','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Select Menu','tfuse'),
            'desc' => __('Select menu to display','tfuse'),
            'id' => 'tf_shc_menu_menu',
            'value' => '',
            'options' => tfuse_list_menu(),
            'type' => 'select'
            ),
        )
);

tf_add_shortcode('menu', 'tfuse_shortcode_menu', $atts);
