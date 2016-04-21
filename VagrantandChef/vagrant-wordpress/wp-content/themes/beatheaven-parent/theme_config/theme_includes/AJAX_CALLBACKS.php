<?php 
 if (!function_exists('tfuse_ajax_get_childs')) :
    /**
     *
     *
     * To override tfuse_ajax_get_childs() in a child theme, add your own tfuse_ajax_get_childs()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_ajax_get_childs ()
    {
        global $TFUSE;

        $id = intval($TFUSE->request->POST('id'));
        $childs = get_term_children( $id,'property_location');
        echo json_encode($childs);
        die();
    }

    add_action('wp_ajax_tfuse_ajax_get_childs','tfuse_ajax_get_childs');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_childs','tfuse_ajax_get_childs');

endif;

if (!function_exists('tfuse_ajax_get_parents')) :
    /**
     *
     *
     * To override tfuse_ajax_get_parents() in a child theme, add your own tfuse_ajax_get_parents()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_ajax_get_parents ()
    {
        global $TFUSE;

        $id = intval($TFUSE->request->POST('id'));
        $parents = tfuse_get_term_parent( $id,'location');
        echo json_encode($parents);
        die();
    }

    add_action('wp_ajax_tfuse_ajax_get_parents','tfuse_ajax_get_parents');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_parents','tfuse_ajax_get_parents');

endif;


if (!function_exists('tfuse_get_term_parent')):

    /*
     * To override tfuse_get_term_parent() in a child theme, add your own tfuse_get_term_parent()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
    */

    function tfuse_get_term_parent( $term_id, $taxonomy ) {
        if ( ! taxonomy_exists($taxonomy) )
            return new WP_Error('invalid_taxonomy', __('Invalid taxonomy','tfuse'));

        $term_id = intval( $term_id );
        $parents = array();
        $term = get_term( $term_id, $taxonomy );
        $parent_id = $term->parent;
        $parents[] = $parent_id;
        while ( $parent_id != 0 )
        {
            $term = get_term( $parent_id, $taxonomy );
            $parent_id = $term->parent;
            $parents[] = $parent_id;
        }
        array_pop($parents);
        return $parents;
    }

endif;


//shortcode pagination
if (!function_exists('tfuse_ajax_get_shortcode_posts')) :
    function tfuse_ajax_get_shortcode_posts(){  
        $max = (intval($_POST['max'])); 
        $pageNum = (intval($_POST['pageNum']));
        $type = ($_POST['type']);
        $items = get_option('posts_per_page');  
        
        $allpos = $pos = $pos1 = '';
        $posts = array();
        
    if($pageNum <= $max) {
        
        if($type == 'location')
        {
            $locations = get_terms('location',$args = array( 'orderby' => 'count','order' => 'DESC'));
            if(!empty($locations))
            {
                foreach($locations as $location)
                {
                    $child = get_term_children( $location->term_id, 'location' );
                    if(empty($child))
                    {
                        $posts[] = $location;
                    }
               
                }
            }
        }  
        elseif($type == 'artist')
        {
            $posts = get_terms('tags',$args = array( 'orderby' => 'count','order' => 'DESC'));
        } 
        elseif($type == 'events')
        {
            $events = get_terms('events',$args = array( 'orderby' => 'count','order' => 'DESC'));
            if(!empty($events))
            {
                foreach($events as $event)
                {
                    $child = get_term_children( $event->term_id, 'location' );
                    if(empty($child))
                    {
                        $posts[] = $event;
                    }
               
                }
            }
        } 
        $cnt = 0; 
        foreach($posts as $post)
        { 
            $cnt++;
            if($cnt <= $items) continue;

            if($type == 'location')
            {
                $link = get_term_link( $post, 'location' );
                $pos1 .= '<div class="post-item clearfix">
                            <div class="post-image"><a href="'.$link.'"><img src="'.TF_GET_IMAGE::get_src_link(tfuse_options('location_thumbnail','',$post->term_id), 220, 200) . '" alt=""></a></div>
                            <div class="post-title">
                                <h3><a href="'.$link.'">'.$post->name.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.$post->description.'</p>
                            </div>
                            <div class="post-more"><a href="'.$link.'">'.__('Events for this location','tfuse').'</a></div>
                        </div>';
                $pos = $pos1; $pos1 = '';
            }
            elseif($type == 'artist')
            {
                $link = get_term_link( $post, 'tags' );
                $pos1 .= '<div class="post-item clearfix">
                            <div class="post-image"><a href="'.$link.'"><img src="' . TF_GET_IMAGE::get_src_link(tfuse_options('tags_thumbnail','',$post->term_id), 220, 200) . '" alt=""></a></div>
                            <div class="post-title">
                                <h3><a href="'.$link.'">'.$post->name.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.$post->description.'</p>
                            </div>
                            <div class="post-more"><a href="'.$link.'">'.__('Events for this location','tfuse').'</a></div>
                        </div>';
                $pos = $pos1; $pos1 = '';
            }
            elseif($type == 'events')
            {
                $link = get_term_link( $post, 'events' );
                $pos1 .= '<div class="post-item clearfix">
                            <div class="post-image"><a href="'.$link.'"><img src="' . TF_GET_IMAGE::get_src_link(tfuse_options('events_thumbnail','',$post->term_id), 220, 200) . '" alt=""></a></div>
                            <div class="post-title">
                                <h3><a href="'.$link.'">'.$post->name.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.$post->description.'</p>
                            </div>
                            <div class="post-more"><a href="'.$link.'">'.__('Events for this location','tfuse').'</a></div>
                        </div>';
                $pos = $pos1; $pos1 = '';
            }
            $allpos[] = $pos;
        }
        $rsp = array('html'=> $allpos,'items' => count($allpos),'per_page' => $items); 
        echo json_encode($rsp);
    }
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_shortcode_posts','tfuse_ajax_get_shortcode_posts');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_shortcode_posts','tfuse_ajax_get_shortcode_posts');
endif;

if (!function_exists('tfuse_ajax_get_posts')) :
    function tfuse_ajax_get_posts(){ 
    
        $search_cat = $_POST['search_cat'];
        $search_tax = $_POST['search_tax'];

        $post_type = $_POST['post_type'];
        $filter_date = $_POST['filter_date']; 
        $search_param = $_POST['search_param'];
        $events_exist = $_POST['events'];
    
        $max = (intval($_POST['max'])); 
        $pageNum = (intval($_POST['pageNum']));
        $search_key = $_POST['search_key'];
        $search_date = $_POST['search_date'];
        $allhome = $_POST['allhome'];
        $allblog = $_POST['allblog'];
        $homepage = $_POST['homepage'];
        $cat_ids = $_POST['cat_ids'];           
        $cat_ID = (intval($_POST['id']));
        $is_tax = $_POST['is_tax']; 
        $items = get_option('posts_per_page');  
        
        $pos4 = $pos1 = $pos2= $pos3 =$pos5 = $pos6 = $pos7 = $pos8 = $allpos = $pos = $pos10 = '';
        $posts = array();
    if($pageNum <= $max) {
        if($homepage == 'homepage' && $allhome == 'nonehomeall')
        {  
            $all = tfuse_options('homepage_category'); 
            if($all == 'specific')
            {
                $specific = tfuse_options('categories_select_categ'); 
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ) ,
                                'paged' => $pageNum,
                                'cat' => $specific
                    );
                }
                else 
                {
                    $args = array(
                        'post_status' => array( 'publish') ,
                                'paged' => $pageNum,
                                'cat' => $specific
                    );
                }
            }
            else
            {
                $specific = tfuse_options('categories_select_promos');
                $cat_ids = explode(",",$specific);
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ),
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'id',
                                            'terms' => $cat_ids
                                    )
                            )
                    );
                }
                else
                {
                    $args = array(
                        'post_status' => array( 'publish' ),
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'id',
                                            'terms' => $cat_ids
                                    )
                            )
                    );
                }
            }
            $query = new WP_Query($args);
            $posts = $query->posts; 
        }
        elseif($homepage == 'blogpage' && $allblog == 'allblogcategories')
        { 
            $all = tfuse_options('blogpage_category'); 
            if($all == 'all')
            {
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ) ,
                        'paged' => $pageNum,
                        'post_type' => 'post'
                    );
                }
                else
                {
                    $args = array(
                        'post_status' => array( 'publish' ) ,
                        'paged' => $pageNum,
                        'post_type' => 'post'
                    );
                }
            }
            else
            {
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ) ,
                        'paged' => $pageNum,
                        'post_type' => 'promo'
                    );
                }
                else
                {
                    $args = array(
                        'post_status' => array( 'publish' ) ,
                        'paged' => $pageNum,
                        'post_type' => 'promo'
                    );
                }
            }
            
            $query = new WP_Query( $args );
            $posts = $query -> posts; 
        }
        elseif($homepage == 'blogpage' && $allblog == 'noneblogall')
        { 
            $all = tfuse_options('blogpage_category');
            if($all == 'specific')
            {
                $specific = tfuse_options('categories_select_categ_blog'); 
                    $args = array(
                        'paged' => $pageNum,
                        'cat' => $specific
                    );
            }
            else
            {
                $specific = tfuse_options('categories_select_promos_blog');
                $cat_ids = explode(",",$specific);
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ),
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'id',
                                            'terms' => $cat_ids
                                    )
                            )
                    );
                }
                else
                {
                    $args = array(
                        'post_status' => array( 'publish' ),
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'id',
                                            'terms' => $cat_ids
                                    )
                            )
                    );
                }
            }
            $query = new WP_Query( $args );
            $posts = $query -> posts; 
        }
        elseif(($homepage == 'homepage') && ($allhome == 'allhomecategories'))
        { 
            $all = tfuse_options('homepage_category'); 
            if($all == 'all')
            {
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ) ,
                        'paged' => $pageNum,
                        'post_type' => 'post'
                    );
                }
                else 
                {
                    $args = array(
                        'post_status' => array( 'publish') ,
                                'paged' => $pageNum,
                                'cat' => $cat_ids
                    );
                }
            }
            else
            {
                if(is_user_logged_in())
                {
                    $args = array(
                        'post_status' => array( 'publish','private' ),
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'id',
                                            'terms' => $cat_ids
                                    )
                            )
                    );
                }
                else
                {
                    $args = array(
                        'post_status' => array( 'publish' ),
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'id',
                                            'terms' => $cat_ids
                                    )
                            )
                    );
                }
            }
            $query = new WP_Query($args);
            $posts = $query->posts; 
        }
        
        elseif($is_tax == 'category')
        { 
            if(is_user_logged_in())
            {
                $query = new WP_Query(array('post_status' => array( 'publish','private' ) , 'cat' => $cat_ID,'paged' => $pageNum));
            }
            else
            {
                $query = new WP_Query(array('post_status' => array( 'publish' ) , 'cat' => $cat_ID,'paged' => $pageNum));
            }
            $posts = $query->posts;
        }
        elseif($is_tax == 'promos')
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'promos',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'promos',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'location')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'location',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'location',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'events')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'events',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'events',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'dates')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'dates',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'dates',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'albums')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'albums',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'albums',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'products')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'products',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'products',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'search') 
        { 
            if($search_date == 'search_date')
            {
                    if(!empty($filter_date))
                    {
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'event'
                        );
                        $all_posts = new WP_Query( $args );
                        $al_posts = $all_posts->posts;

                        $date_from = new DateTime($filter_date);
                        $year = $date_from->format('Y');
                        $month = $date_from->format('m'); 
                        $day = $date_from->format('d');
                        $search_event['date'] = $year.'-'.$month.'-'.$day;

                        if(!empty($al_posts))
                            foreach ($al_posts as $post) {
                               $date_post = tfuse_page_options('date_from','',$post->ID);
                                if($date_post == $search_event['date'])
                                {
                                    $ids[] = $post->ID;
                                }
                        }
                        
                        if(!empty($ids))
                        {
                            $args = array(
                                'paged' => $pageNum,
                                'post_type' => 'event',
                                'post__in' => $ids
                            );
                            $all_posts = new WP_Query( $args );
                            $posts = $all_posts->posts;
                        }

                    }
                    elseif($post_type == 'events' && empty($events_exist))
                    {
                        $args = array(
                            'paged' => $pageNum,
                            'post_type' => 'event'
                        );
                        $all_posts = new WP_Query( $args );
                        $posts = $all_posts->posts;
                    }
                    else {
                        if($search_key != ' ')
                        {
                            $args = array(
                            'paged' => $pageNum,
                            's' => $search_param,
                            'post_type' => 'event',
                            'tax_query' => array(
                                array(
                                        'taxonomy' => 'events',
                                        'field' => 'slug',
                                        'terms' => $events_exist
                                    )
                                )
                            );
                        }
                        else
                        {
                            $args = array(
                            'paged' => $pageNum,
                            'post_type' => 'event',
                            'tax_query' => array(
                                array(
                                        'taxonomy' => 'events',
                                        'field' => 'slug',
                                        'terms' => $events_exist
                                    )
                                )
                            );
                        }
                        $all_posts = new WP_Query( $args );
                        $posts = $all_posts->posts;
                    }
            }
            else
            {
                if(is_user_logged_in())
                {
                    if(!empty($search_cat))
                    {
                        $query = new WP_Query(array('post_status' => array( 'publish','private' ) ,'cat' => $search_cat, 's' => $search_key ,'paged' => $pageNum));
                    }
                    elseif(!empty($search_tax))
                    {
                        $args = array(
                            'post_status' => array( 'publish','private' ),
                            's' => $search_key,
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'slug',
                                            'terms' => $search_tax
                                    )
                            )
                        );
                        $query = new WP_Query($args);
                    }
                    else
                        $query = new WP_Query(array('post_status' => array( 'publish','private' ) , 's' => $search_key ,'paged' => $pageNum));
                }
                else
                {
                    if(!empty($search_cat))
                    {
                        $query = new WP_Query(array('post_status' => array( 'publish' ) ,'cat' => $search_cat, 's' => $search_key ,'paged' => $pageNum));
                    }
                    elseif(!empty($search_tax))
                    {
                        $args = array(
                            'post_status' => array( 'publish' ),
                            's' => $search_key,
                            'paged' => $pageNum,
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => 'promos',
                                            'field' => 'slug',
                                            'terms' => $search_tax
                                    )
                            )
                        );
                        $query = new WP_Query($args);
                    }
                    else
                        $query = new WP_Query(array('post_status' => array( 'publish' ) , 's' => $search_key ,'paged' => $pageNum));
                }
                $posts = $query->posts;
            }
        }
        
        $cnt = 0; 
        foreach($posts as $post)
        { 
            $cnt++;
            //get date format
            $d = get_option('date_format');
            //get comments number
            $num_comments = get_comments_number($post->ID);
            if ( $num_comments == 0 ) {
                $comments = $num_comments.__(' comments','tfuse');
            } elseif ( $num_comments > 1 ) {
                    $comments = $num_comments . __(' comments','tfuse');
            } else {
                    $comments = __('1 comment','tfuse');
            }
            
            if($is_tax == 'promos')
            { 
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="200" width="220" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="200" width="220" alt="" ></a>';
                }
                
                $pos1 .='<div class="post-item clearfix">
                            <div class="post-image">'.$image.'</div>
                            <div class="post-meta">';
                                if ( tfuse_options('date_time')) :
                                    $pos2 .='<span class="post-date">'.get_the_time( $d, $post->ID ).'</span> &nbsp;|&nbsp;'; 
                                endif;
                                $pos3 .='<a href="' . get_comments_link($post->ID) .'" class="link-comments">'.$comments.'</a>
                            </div>
                            <div class="post-title">
                                <h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),30)).'</p>
                            </div>
                            <div class="post-more"><a href="'.get_permalink($post->ID).'">'.__('READ THE ARTICLE','tfuse').'</a></div>
                        </div>';
                $pos = $pos1.$pos2.$pos3;
                $pos1 = $pos2 = $pos3 = '';
            }
            elseif($is_tax == 'location' || $is_tax == 'events' || $search_date == 'search_date')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="150" width="150" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="150" width="150" alt="" ></a>';
                }
                $pos4 .='<li class="event_item clearfix">
                            <div class="event_side">
                                <div class="event_icon"><span class="icon '.tfuse_get_event_icon($post->ID).'"></span></div>
                                <div class="event_date">'. tfuse_get_event_date($post->ID).'</div>
                                <div class="event_price">'.__('From','tfuse').' <strong>'.tfuse_page_options('ticket_price','',$post->ID).'</strong></div>
                            </div>
                            <div class="event_descr">
                                <div class="event_image">'.$image.'</div>
                                <div class="event_location">'.tfuse_events_location($post->ID,'location').'</div>
                                <div class="event_title">
                                    <div class="inner">
                                        <h3>'.$post->post_title.'</h3>
                                        <span>'.tfuse_page_options('short_desc','',$post->ID).'</span>
                                    </div>
                                </div>
                                <div class="event_details">
                                    <a href="'.get_permalink( $post->ID ).'"><span class="icon icon-shopping-cart"></span>'.__(' BUY TICKETS','tfuse').'</a>
                                </div>
                            </div>
                        </li>';
                $pos = $pos4;
                $pos4 = '';
            }
            elseif($is_tax == 'dates')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="150" width="150" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="150" width="150" alt="" ></a>';
                }
                $pos5 .='<li class="event_item clearfix">
                            <div class="event_side">
                                <div class="event_icon"><span class="icon '.tfuse_options('icon_class','',$cat_ID).'"></span></div>
                                <div class="event_date">'. tfuse_get_event_date($post->ID).'</div>
                                <div class="event_price">'.__('From','tfuse').' <strong>'.tfuse_page_options('ticket_price','',$post->ID).'</strong></div>
                            </div>
                            <div class="event_descr">
                                <div class="event_image">'.$image.'</div>
                                <div class="event_location">'.tfuse_page_options('tour_location','',$post->ID).'</div>
                                <div class="event_title">
                                    <div class="inner">
                                        <h3>'.$post->post_title.'</h3>
                                        <span>'.tfuse_tour_date($post->ID).'</span>
                                    </div>
                                </div>
                                <div class="event_details">
                                    <a href="'.get_permalink( $post->ID ).'"><span class="icon icon-shopping-cart"></span>'.__(' BUY TICKETS','tfuse').'</a>
                                </div>
                            </div>
                        </li>';
                $pos = $pos5;
                $pos5 = '';
            }
            elseif($is_tax == 'albums')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="200" width="220" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="200" width="220" alt="" ></a>';
                }
                
                $pos6 .='<div class="post-item clearfix">
                            <div class="post-image">'.$image.'</a></div>
                            <div class="post-title">
                                <h3><a href="'.get_permalink( $post->ID ).'">'.$post->post_title.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                               <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),15)).'</p>
                            </div>
                            <div class="post-more"><a href="'.tfuse_page_options('itunes_link','',$post->ID).'">'.__('PURCHASE IN iTUNES STORE','tfuse').'</a></div>
                        </div>';
                $pos = $pos6;
                $pos6 = '';
            }
            elseif($is_tax == 'products')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="200" width="220" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="200" width="220" alt="" ></a>';
                }
                
                $pos7 .='<div class="post-item clearfix">
                            <div class="post-image">'.$image.'</a></div>
                            <div class="post-title">
                                <h3><a href="'.get_permalink( $post->ID ).'">'.$post->post_title.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                               <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),15)).'</p>
                            </div>
                            <div class="post-more"><a href="'.tfuse_page_options('product_link','',$post->ID).'">'.__('Add to Cart','tfuse').'</a></div>
                        </div>';
                $pos = $pos7;
                $pos7 = '';
            }
            elseif($is_tax == 'category' || ($is_tax == 'search' && !empty($search_cat)))
            { 
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                $position = tfuse_page_options('thumbnail_position',null,$post->ID);
                
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" class="'.$position.'" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'"  alt="" class="'.$position.'"></a>';
                }
                
                $pos5 .='<div class="post-item clearfix">
                            <div class="post-image image_center">'.$image.'</div>
                            <div class="post-meta">';
                                if ( tfuse_options('date_time')) :
                                    $pos6 .= '<span class="post-date">'.get_the_time( $d, $post->ID ).'</span> &nbsp;|&nbsp;';
                                endif;
                                $pos7 .='<a href="' . get_comments_link($post->ID) .'" class="link-comments">'.$comments.'</a>
                            </div>
                            <div class="post-title">
                                <h2><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h2>
                            </div>
                            <div class="post-descr entry">
                                <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),30)).'</p>
                            </div>
                            <div class="post-more">
                                <a href="' . get_comments_link($post->ID) .'" class="link-comments">'.__(' POST A NEW COMMENT ','tfuse').'
                                    <span class="icon icon-comment"></span></a>
                                <a href="'.get_permalink($post->ID).'">'.__('READ THE ARTICLE','tfuse').'</a>
                            </div>
                        </div>';
                $pos = $pos5.$pos6.$pos7;
                $pos5 = $pos6 = $pos7 = '';
            }
            elseif($is_tax == 'search')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="200" width="220" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="200" width="220" alt="" ></a>';
                }
                
                $pos1 .='<div class="post-item clearfix">
                            <div class="post-image">'.$image.'</div>
                            <div class="post-meta">';
                                if ( tfuse_options('date_time')) :
                                    $pos2 .='<span class="post-date">'.get_the_time( $d, $post->ID ).'</span> &nbsp;|&nbsp;'; 
                                endif;
                                $pos3 .='<a href="' . get_comments_link($post->ID) .'" class="link-comments">'.$comments.'</a>
                            </div>
                            <div class="post-title">
                                <h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),30)).'</p>
                            </div>
                            <div class="post-more"><a href="'.get_permalink($post->ID).'">'.__('READ THE ARTICLE','tfuse').'</a></div>
                        </div>';
                $pos = $pos1.$pos2.$pos3;
                $pos1 = $pos2 = $pos3 = '';
            }
                $allpos[] = $pos;
        }
        $rsp = array('html'=> $allpos,'items' => $items,'posts'=> $posts); 
        echo json_encode($rsp);
    }
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_posts','tfuse_ajax_get_posts');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_posts','tfuse_ajax_get_posts');
endif;


//shortcode pagination
if (!function_exists('tfuse_ajax_get_rating')) :
    function tfuse_ajax_get_rating(){  
        if(is_singular('album')) die();
        
        $id = (intval($_POST['id'])); 
        $parent = $_POST['parent']; 
        $current = ($_POST['current']); 
        $rating_array = tfuse_object_to_array(json_decode(stripslashes($_POST['rating_array'])));
        
        $values = $rating_array;
        
            foreach ($values as  $key =>$value) {
                if($parent == $key)
                {
                    $sum = $current + $value['val'];
                    $values[$key]['val'] = $sum;
                    $values[$key]['count'] = ++$value['count'];
                }

            tf_update_post_meta( $id, TF_THEME_PREFIX . '_rating', $values);
        }
        
        $rsp = $values;
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_rating','tfuse_ajax_get_rating');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_rating','tfuse_ajax_get_rating');
endif;

if (!function_exists('tfuse_object_to_array')) :
    function tfuse_object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = tfuse_object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
endif;