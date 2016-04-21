<?php

if ( ! function_exists( 'tfuse_header_content' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */

    function tfuse_header_content($location = false)
    { 
        global $TFUSE, $post,$is_tf_blog_page,$is_tf_front_page,$header_slider,$header_img,$header_img2,$header_sh;
        $posts = $header_element = $header_slider = $slider = $header_img = $header_img2 = $header_sh = null;
        if (!$location) return;
        switch ($location)
        { 
            case 'header' :
                if(is_front_page())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $page_id = tfuse_options('home_page');
                    $header_element = tfuse_options('header_element');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {   $header_element = tfuse_page_options('header_element','',$page_id);
                        if($page_id != 0 && tfuse_page_options('header_element','',$page_id)=='slider')
                            $slider = tfuse_page_options('select_slider','',$page_id);
                    }
                    else{
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider');
                    }
                    
                }
                elseif($is_tf_blog_page)
                { 
                    $ID = $post->ID;
                    $header_element = tfuse_options('header_element_blog');
                    if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_blog');
                }
                elseif ( is_singular() )
                {  
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('header_element');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_slider');

                }
                elseif ( is_category() )
                { 
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('header_element', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider', null, $ID);
                }
                elseif ( is_tax() )
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('header_element', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider', null, $ID);
                } 
                elseif ( is_search() )
                { 
                    $header_element = tfuse_options('header_element_search');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_search');
                } 
                elseif ( is_404() )
                { 
                    $header_element = tfuse_options('header_element_404');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_404');
                } 
            break;
            case 'bottom' :
                if($is_tf_front_page)
                {  
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $page_id = tfuse_options('home_page');
                    $header_element = tfuse_options('header_bottom');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {   
                        $header_element = tfuse_page_options('header_bottom','',$page_id);
                        if($page_id != 0 && tfuse_page_options('header_bottom','',$page_id)=='title_slider')
                            $slider = tfuse_page_options('select_bottom_slider','',$page_id);
                        elseif ($page_id != 0 && tfuse_page_options('header_bottom','',$page_id)== 'title_img' )
                        {
                            $header_img['title'] = tfuse_page_options('header_bottom_title','',$page_id);
                            $header_img['icon'] = tfuse_page_options('header_bottom_icon','',$page_id);
                            $header_img['desc'] = tfuse_page_options('header_bottom_desc','',$page_id);
                            $header_img['img'] = tfuse_page_options('header_bottom_img','',$page_id);
                        }
                        elseif ( $page_id != 0 && tfuse_page_options('header_bottom','',$page_id)=='title_img2' )
                        {
                            $header_img2['title'] = tfuse_page_options('header_bottom_title','',$page_id);
                            $header_img2['icon'] = tfuse_page_options('header_bottom_icon','',$page_id);
                            $header_img2['desc'] = tfuse_page_options('header_bottom_desc','',$page_id);
                            $header_img2['img'] = tfuse_page_options('header_bottom_img','',$page_id);
                        }
                        elseif ($page_id != 0 && tfuse_page_options('header_bottom','',$page_id)== 'shortcode' )
                        {
                            $header_sh['title'] = tfuse_page_options('header_bottom_title','',$page_id);
                            $header_sh['icon'] = tfuse_page_options('header_bottom_icon','',$page_id);
                            $header_sh['desc'] = tfuse_page_options('header_bottom_desc','',$page_id);
                            $header_sh['shortcode'] = tfuse_page_options('header_bottom_shortcode','',$page_id);
                        }
                    }
                    else{
                        if ( 'title_slider' == $header_element )
                            $slider = tfuse_options('select_bottom_slider');
                        elseif ( 'title_img' == $header_element )
                        {
                            $header_img['title'] = tfuse_options('header_bottom_title');
                            $header_img['icon'] = tfuse_options('header_bottom_icon');
                            $header_img['desc'] = tfuse_options('header_bottom_desc');
                            $header_img['img'] = tfuse_options('header_bottom_img');
                        }
                        elseif ( 'title_img2' == $header_element )
                        {
                            $header_img2['title'] = tfuse_options('header_bottom_title');
                            $header_img2['icon'] = tfuse_options('header_bottom_icon');
                            $header_img2['desc'] = tfuse_options('header_bottom_desc');
                            $header_img2['img'] = tfuse_options('header_bottom_img');
                        }
                        elseif ( 'shortcode' == $header_element )
                        {
                            $header_sh['title'] = tfuse_options('header_bottom_title');
                            $header_sh['icon'] = tfuse_options('header_bottom_icon');
                            $header_sh['desc'] = tfuse_options('header_bottom_desc');
                            $header_sh['shortcode'] = tfuse_options('header_bottom_shortcode');
                        }
                    }
                }
                elseif($is_tf_blog_page)
                { 
                    $ID = $post->ID;
                    $header_element = tfuse_options('header_bottom_blog');
                    if ( 'title_slider' == $header_element )
                    {
                            $slider = tfuse_options('select_bottom_slider_blog'); 
                    }
                    elseif ( 'title_img' == $header_element )
                    {
                        $header_img['title'] = tfuse_options('header_bottom_title_blog');
                        $header_img['icon'] = tfuse_options('header_bottom_icon_blog');
                        $header_img['desc'] = tfuse_options('header_bottom_desc_blog');
                        $header_img['img'] = tfuse_options('header_bottom_img_blog');
                    }
                    elseif ( 'title_img2' == $header_element )
                    {
                        $header_img2['title'] = tfuse_options('header_bottom_title_blog');
                        $header_img2['icon'] = tfuse_options('header_bottom_icon_blog');
                        $header_img2['desc'] = tfuse_options('header_bottom_desc_blog');
                        $header_img2['img'] = tfuse_options('header_bottom_img_blog');
                    }
                    elseif ( 'shortcode' == $header_element )
                    {
                        $header_sh['title'] = tfuse_options('header_bottom_title_blog');
                        $header_sh['icon'] = tfuse_options('header_bottom_icon_blog');
                        $header_sh['desc'] = tfuse_options('header_bottom_desc_blog');
                        $header_sh['shortcode'] = tfuse_options('header_bottom_shortcode_blog');
                    }
                }
                elseif ( is_singular() )
                {  
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('header_bottom');
                    if ( 'title_slider' == $header_element )
                    {
                        $slider = tfuse_page_options('select_bottom_slider');
                    }
                    elseif ( 'title_img' == $header_element )
                    {
                        $header_img['title'] = tfuse_page_options('header_bottom_title');
                        $header_img['icon'] = tfuse_page_options('header_bottom_icon');
                        $header_img['desc'] = tfuse_page_options('header_bottom_desc');
                        $header_img['img'] = tfuse_page_options('header_bottom_img');
                    }
                    elseif ( 'title_img2' == $header_element )
                    {
                        $header_img2['title'] = tfuse_page_options('header_bottom_title');
                        $header_img2['icon'] = tfuse_page_options('header_bottom_icon');
                        $header_img2['desc'] = tfuse_page_options('header_bottom_desc');
                        $header_img2['img'] = tfuse_page_options('header_bottom_img');
                    }
                    elseif ( 'shortcode' == $header_element )
                    {
                        $header_sh['title'] = tfuse_page_options('header_bottom_title');
                        $header_sh['icon'] = tfuse_page_options('header_bottom_icon');
                        $header_sh['desc'] = tfuse_page_options('header_bottom_desc');
                        $header_sh['shortcode'] = tfuse_page_options('header_bottom_shortcode');
                    }

                }
                elseif ( is_category() )
                { 
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('header_bottom',null,$ID);
                    if ( 'title_slider' == $header_element )
                    {
                        $slider = tfuse_options('select_bottom_slider',null,$ID);
                    }
                    elseif ( 'title_img' == $header_element )
                    {
                        $header_img['title'] = tfuse_options('header_bottom_title',null,$ID);
                        $header_img['icon'] = tfuse_options('header_bottom_icon',null,$ID);
                        $header_img['desc'] = tfuse_options('header_bottom_desc',null,$ID);
                        $header_img['img'] = tfuse_options('header_bottom_img',null,$ID);
                    }
                    elseif ( 'title_img2' == $header_element )
                    {
                        $header_img2['title'] = tfuse_options('header_bottom_title',null,$ID);
                        $header_img2['icon'] = tfuse_options('header_bottom_icon',null,$ID);
                        $header_img2['desc'] = tfuse_options('header_bottom_desc',null,$ID);
                        $header_img2['img'] = tfuse_options('header_bottom_img',null,$ID);
                    }
                    elseif ( 'shortcode' == $header_element )
                    {
                        $header_sh['title'] = tfuse_options('header_bottom_title',null,$ID);
                        $header_sh['icon'] = tfuse_options('header_bottom_icon',null,$ID);
                        $header_sh['desc'] = tfuse_options('header_bottom_desc',null,$ID);
                        $header_sh['shortcode'] = tfuse_options('header_bottom_shortcode',null,$ID);
                    }
                }
                elseif ( is_tax() )
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('header_bottom',null,$ID);
                    if ( 'title_slider' == $header_element )
                    {
                        $slider = tfuse_options('select_bottom_slider',null,$ID);
                    }
                    elseif ( 'title_img' == $header_element )
                    {
                        $header_img['title'] = tfuse_options('header_bottom_title',null,$ID);
                        $header_img['icon'] = tfuse_options('header_bottom_icon',null,$ID);
                        $header_img['desc'] = tfuse_options('header_bottom_desc',null,$ID);
                        $header_img['img'] = tfuse_options('header_bottom_img',null,$ID);
                    }
                    elseif ( 'title_img2' == $header_element )
                    {
                        $header_img2['title'] = tfuse_options('header_bottom_title',null,$ID);
                        $header_img2['icon'] = tfuse_options('header_bottom_icon',null,$ID);
                        $header_img2['desc'] = tfuse_options('header_bottom_desc',null,$ID);
                        $header_img2['img'] = tfuse_options('header_bottom_img',null,$ID);
                    }
                    elseif ( 'shortcode' == $header_element )
                    {
                        $header_sh['title'] = tfuse_options('header_bottom_title',null,$ID);
                        $header_sh['icon'] = tfuse_options('header_bottom_icon',null,$ID);
                        $header_sh['desc'] = tfuse_options('header_bottom_desc',null,$ID);
                        $header_sh['shortcode'] = tfuse_options('header_bottom_shortcode',null,$ID);
                    }
                } 
                elseif ( is_search() )
                { 
                    $ID  = '';
                    $header_element = tfuse_options('header_bottom_search');
                    if ( 'title_slider' == $header_element )
                    {
                        $slider = tfuse_options('select_bottom_slider_search');
                    }
                    elseif ( 'title_img' == $header_element )
                    {
                        $header_img['title'] = tfuse_options('header_bottom_title_search');
                        $header_img['icon'] = tfuse_options('header_bottom_icon_search');
                        $header_img['desc'] = tfuse_options('header_bottom_desc_search');
                        $header_img['img'] = tfuse_options('header_bottom_img_search');
                    }
                    elseif ( 'title_img2' == $header_element )
                    {
                        $header_img2['title'] = tfuse_options('header_bottom_title_search');
                        $header_img2['icon'] = tfuse_options('header_bottom_icon_search');
                        $header_img2['desc'] = tfuse_options('header_bottom_desc_search');
                        $header_img2['img'] = tfuse_options('header_bottom_img_search');
                    }
                    elseif ( 'shortcode' == $header_element )
                    {
                        $header_sh['title'] = tfuse_options('header_bottom_title_search');
                        $header_sh['icon'] = tfuse_options('header_bottom_icon_search');
                        $header_sh['desc'] = tfuse_options('header_bottom_desc_search');
                        $header_sh['shortcode'] = tfuse_options('header_bottom_shortcode_search');
                    }
                }
                elseif ( is_404() )
                { 
                    $ID  = '';
                    $header_element = tfuse_options('header_bottom_404');
                    if ( 'title_slider' == $header_element )
                    {
                        $slider = tfuse_options('select_bottom_slider_404');
                    }
                    elseif ( 'title_img' == $header_element )
                    {
                        $header_img['title'] = tfuse_options('header_bottom_title_404');
                        $header_img['icon'] = tfuse_options('header_bottom_icon_404');
                        $header_img['desc'] = tfuse_options('header_bottom_desc_404');
                        $header_img['img'] = tfuse_options('header_bottom_img_404');
                    }
                    elseif ( 'title_img2' == $header_element )
                    {
                        $header_img2['title'] = tfuse_options('header_bottom_title_404');
                        $header_img2['icon'] = tfuse_options('header_bottom_icon_404');
                        $header_img2['desc'] = tfuse_options('header_bottom_desc_404');
                        $header_img2['img'] = tfuse_options('header_bottom_img_404');
                    }
                    elseif ( 'shortcode' == $header_element )
                    {
                        $header_sh['title'] = tfuse_options('header_bottom_title_404');
                        $header_sh['icon'] = tfuse_options('header_bottom_icon_404');
                        $header_sh['desc'] = tfuse_options('header_bottom_desc_404');
                        $header_sh['shortcode'] = tfuse_options('header_bottom_shortcode_404');
                    }
                }
            break;
            case 'footer' : 
                if($is_tf_front_page)
                { 
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $page_id = tfuse_options('home_page');
                    $header_element = tfuse_options('footer_top');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {   $header_element = tfuse_page_options('footer_top','',$page_id);
                        if($page_id != 0 && tfuse_page_options('footer_top','',$page_id)=='slider')
                            $slider = tfuse_page_options('select_footer_slider','',$page_id);
                    }
                    else{
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_footer_slider');
                    }
                    
                }
                elseif($is_tf_blog_page)
                { 
                    $ID = $post->ID;
                    $header_element = tfuse_options('footer_top_blog');
                    if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_footer_slider');
                }
                elseif ( is_singular() )
                {  
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('footer_top');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_footer_slider');

                }
                elseif ( is_category() )
                { 
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('footer_top', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_footer_slider', null, $ID);
                }
                elseif ( is_tax() )
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('footer_top', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_footer_slider', null, $ID);
                } 
                elseif ( is_search() )
                { 
                    $ID  = '';
                    $header_element = tfuse_options('footer_top_search');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_footer_slider_search');
                } 
                elseif ( is_404() )
                { 
                    $ID  = '';
                    $header_element = tfuse_options('footer_top_404');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_footer_slider_404');
                } 
            break;
        }  
        if( $header_element == 'title_img')
        {   
            get_template_part( 'header', 'image');
            return;
        }
        elseif( $header_element == 'title_img2')
        {
            get_template_part( 'header', 'image2');
            return;
        }
        elseif( $header_element == 'shortcode')
        {
            get_template_part( 'header', 'shortcode');
            return;
        }
        elseif ( !$slider )
            return;

        $slider = $TFUSE->ext->slider->model->get_slider($slider);

        switch ($slider['type']):
           case 'custom':

                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    foreach ($slider['slides'] as $k => $slide) : 
                        $image = new TF_GET_IMAGE();
                        if ( $slider['design'] == 'play')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(960)->height(543)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif( $slider['design'] == 'showcase')
                        { 
                            @$slider['slides'][$k]['slide_src'] = $image->width(960)->height(543)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif( $slider['design'] == 'carousel')
                        { 
                            @$slider['slides'][$k]['slide_src'] = $image->width(320)->height(550)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif( $slider['design'] == 'album')
                        {  
                            @$slider['slides'][$k]['slide_src'] = $image->width(158)->height(158)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        else {
                            @$slider['slides'][$k]['slide_src'] = $image->width(960)->height(543)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                    endforeach;
                endif;

                break;
            case 'posts':
                $slides_posts = array();
                $post_type = '';
                $post_type = isset($slider['general']['sliders_posts_type']) ? $slider['general']['sliders_posts_type'] : '';
                
                if($post_type == 'album')
                {
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select_album']) );
                    $slides_posts = explode(',',$slider['general']['posts_select_album']);
                }
                elseif($post_type == 'product')
                {
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select_product']) );
                    $slides_posts = explode(',',$slider['general']['posts_select_product']);
                }
                elseif($post_type == 'event')
                {
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select_event']) );
                    $slides_posts = explode(',',$slider['general']['posts_select_event']);
                }
                else
                {
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select']) );
                    $slides_posts = explode(',',$slider['general']['posts_select']);
                }
                
               
                foreach($slides_posts as $slide_posts):
                    $posts[] = get_post($slide_posts);
                endforeach; 
                $posts = array_reverse($posts);
                $args = apply_filters('tfuse_slider_posts_args', $args, $slider);
                $args = apply_filters('tfuse_slider_posts_args_'.$ID, $args, $slider);
                break;
            case 'categories':
                $post_type = '';
                $post_type = isset($slider['general']['sliders_posts_types']) ? $slider['general']['sliders_posts_types'] : '' ;
                
                if($post_type == 'albums')
                {
                    $args = 'cat='.$slider['general']['posts_select_albums'].
                    '&posts_per_page='.$slider['general']['sliders_posts_number'];
                    
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    
                    $slides_posts = explode(',',$slider['general']['posts_select_albums']);
                        $args = array(
                                'posts_per_page' => $slider['general']['sliders_posts_number'],
                                'relation' => 'AND',
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'albums',
                                                'field' => 'id',
                                                'terms' => $slides_posts
                                        )
                                )
                        );
                }
                elseif($post_type == 'products')
                {
                    $args = 'cat='.$slider['general']['posts_select_products'].
                    '&posts_per_page='.$slider['general']['sliders_posts_number'];
                    
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    
                    $slides_posts = explode(',',$slider['general']['posts_select_products']);
                        $args = array(
                                'posts_per_page' => $slider['general']['sliders_posts_number'],
                                'relation' => 'AND',
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'products',
                                                'field' => 'id',
                                                'terms' => $slides_posts
                                        )
                                )
                        );
                }
                elseif($post_type == 'events')
                {
                    $args = 'cat='.$slider['general']['posts_select_events'].
                    '&posts_per_page='.$slider['general']['sliders_posts_number'];
                    
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    
                    $slides_posts = explode(',',$slider['general']['posts_select_events']);
                        $args = array(
                                'posts_per_page' => $slider['general']['sliders_posts_number'],
                                'relation' => 'AND',
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'events',
                                                'field' => 'id',
                                                'terms' => $slides_posts
                                        )
                                )
                        );
                }
                else
                {
                    $args = 'cat='.$slider['general']['categories_select'].
                    '&posts_per_page='.$slider['general']['sliders_posts_number'];
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    $slides_posts = explode(',',$slider['general']['categories_select']);
                        $args = array(
                                'posts_per_page' => $slider['general']['sliders_posts_number'],
                                'relation' => 'AND',
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'events',
                                                'field' => 'id',
                                                'terms' => $slides_posts
                                        )
                                )
                        );
                }
                        $query = new WP_Query($args);
                        $posts  = $query->get_posts();
                        
                break;

        endswitch;

        if ( is_array($posts) ) :
            $slider['slides'] = tfuse_get_slides_from_posts($posts,$slider);
        endif;

        if ( !is_array($slider['slides']) ) return;

        include_once(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php' ));
    }

endif;
add_action('tfuse_header_content', 'tfuse_get_header_content');

if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
/**
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
    
        global $post;
        
        $slides = array(); $numb = $album_single = $album_thumb = $album_img = $tfuse_album_image = '';
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        $k = 0; 
        foreach ($posts as $k => $post) : $k++;
            $term = get_the_terms($post->ID,'events');
            
            setup_postdata( $post );
            
            if(!empty($slider['general']['sliders_posts_number'])) {$numb = $slider['general']['sliders_posts_number']; $numb += 1;}
            if($numb == $k) break;
            
            
            
            $attachments = tfuse_get_gallery_images($post->ID,TF_THEME_PREFIX . '_track_songs');  //tf_print($attachments);
            $songs = array();
                if ($attachments) {
                    foreach ($attachments as $attachment){
                        $songs[] = array(
                            'order'        =>$attachment->menu_order,
                            'mp3'    => $attachment->guid,
                            'title'       => $attachment->post_title
                        );
                    }
                }
            
           $songs = tfuse_aasort($songs,'order');
            
            //album image
            $album_single = tfuse_page_options('single_image');
            $album_thumb = tfuse_page_options('thumbnail_image');
            
            if(!empty($album_thumb))
                $album_img = $album_thumb;
            elseif(!empty($album_single))
                $album_img = $album_single;
            else
                continue;

            $single = tfuse_page_options('single_image');
            if(empty($single)) continue;
            if(!empty ($single)) $single_image = $single;

            $image = new TF_GET_IMAGE();
            $tfuse_image = $image->width(960)->height(543)->src($single_image)->resize($slider_image_resize)->get_src();
            
            $tfuse_album_image = $album_img;

            $title = get_the_title();
            if (mb_strlen($title, 'UTF-8') > 20)  $title = substr($title, 0 ,30);
            $slides[$k]['slide_title'] = $title;
            $slides[$k]['slide_desc'] = tfuse_substr( get_the_excerpt(), 90 );
            $slides[$k]['slide_post_desc'] = tfuse_substr( get_the_excerpt(), 60 );
            $slides[$k]['slide_src'] = $tfuse_image;
            $slides[$k]['slide_img_src'] = $tfuse_album_image;
            $slides[$k]['slide_url'] = get_permalink();
            $slides[$k]['slide_artist'] = tfuse_page_options('album_artist');
            $slides[$k]['slide_songs'] = $songs;
            
            $slides[$k]['slide_featured'] = tfuse_page_options('event_type');
            
            if(!empty($term))
            {
                foreach($term as $terms)
                    $cat = $terms;
                
                $slides[$k]['slide_category_title'] = strtoupper($cat->name);
                
                $slides[$k]['slide_category_icon'] = tfuse_options('icon_class', null , $cat->term_id);
            }
            
            $rating_info = get_post_meta($post->ID, TF_THEME_PREFIX . '_rating', true);
            
            $rate = 0;
            if(!empty($rating_info))
            {
                $val = $counts = '';
                foreach ($rating_info as $rating) {
                    $val += $rating['val'];
                }
                $attachments = tfuse_get_gallery_images($post->ID ,TF_THEME_PREFIX . '_track_songs');
                $rate = round($val/count($attachments));
            }
            
            switch ($rate) {
                    case 1:  $slides[$k]['slide_rating'] = 'rating1'; break;
                    case 2:  $slides[$k]['slide_rating'] = 'rating2'; break;
                    case 3:  $slides[$k]['slide_rating'] = 'rating3'; break;
                    case 4:  $slides[$k]['slide_rating'] = 'rating4'; break;
                    case 5:  $slides[$k]['slide_rating'] = 'rating5'; break;
                    default: $slides[$k]['slide_rating'] = '';break;
                }
            
        endforeach;
		wp_reset_postdata();
        return $slides;
    }
endif;
