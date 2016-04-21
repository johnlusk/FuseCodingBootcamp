<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;


if (!function_exists('tfuse_list_menu')) :
    function tfuse_list_menu() {
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		$result = array();
        foreach ( $menus as $menu ) {
            $result[$menu->term_id] = $menu->name;
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_posts')) :
    function tfuse_list_posts() {
        $posts = get_posts(array('post_type' => 'post','posts_per_page' => -1,'orderby' => 'post_date'));
        $result = array();
        if(!empty($posts))
        {
            foreach ( $posts as $post ) {
                $video = tfuse_page_options('video_links','',$post->ID);
                if(!empty($video))
                    $result[] = $post->ID;
            }
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_events_categories')) :
    function tfuse_list_events_categories() {
        $events = get_terms('events',$args = array( 'orderby' => 'count','order' => 'DESC'));
        $result = array();
        
        if(!empty($events))
        {
            foreach($events as $event)
            {
                $child = get_term_children( $event->term_id, 'events' );
                if(empty($child))
                {
                     $result[$event->term_id] = $event->name;
                }
            }
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_events_locations')) :
    function tfuse_list_events_locations() {
        $events = get_terms('location',$args = array( 'orderby' => 'count','order' => 'DESC'));
        $result = array();
        
        if(!empty($events))
        {
            foreach($events as $event)
            {
                if($event->parent == 0)
                {
                     $result[$event->term_id] = $event->name;
                }
            }
        }
        return $result;
    }
endif;