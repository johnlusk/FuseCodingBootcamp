<?php
if ( ! isset( $content_width ) ) $content_width = 900;

if (!function_exists('tfuse_browser_body_class')):

/* This Function Add the classes of body_class()  Function
 * To override tfuse_browser_body_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    add_filter('body_class', 'tfuse_browser_body_class');

    function tfuse_browser_body_class() {

        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if ($is_lynx)
            $classes[] = 'lynx';
        elseif ($is_gecko)
            $classes[] = 'gecko';
        elseif ($is_opera)
            $classes[] = 'opera';
        elseif ($is_NS4)
            $classes[] = 'ns4';
        elseif ($is_safari)
            $classes[] = 'safari';
        elseif ($is_chrome)
            $classes[] = 'chrome';
        elseif ($is_IE) {
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $browser = substr("$browser", 25, 8);
            if ($browser == "MSIE 7.0")
                $classes[] = 'ie7';
            elseif ($browser == "MSIE 6.0")
                $classes[] = 'ie6';
            elseif ($browser == "MSIE 8.0")
                $classes[] = 'ie8';
            else
                $classes[] = 'ie';
        }
        else
            $classes[] = 'unknown';

        if ($is_iphone)
            $classes[] = 'iphone';

        return $classes;
    } // End function tfuse_browser_body_class()
endif;


if (!function_exists('tfuse_class')) :
/* This Function Add the classes for middle container
 * To override tfuse_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    function tfuse_class($param, $return = false) {
        $tfuse_class = '';
        $sidebar_position = tfuse_sidebar_position();
        if ($param == 'middle') {
            if (is_page_template('template-contact.php')) {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft nobg"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight nobg"';
                else
                    $tfuse_class = ' class="middle"';
            }
            else {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight"';
                else
                    $tfuse_class = ' class="middle"';
            }
        }
        elseif ($param == 'content') {
            $tfuse_class = ( isset($sidebar_position) && $sidebar_position != 'full' ) ? ' class="grid_8 content"' : ' class="content"';
        }

        if ($return)
            return $tfuse_class;
        else
            echo $tfuse_class;
    }
endif;


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;

        global $post;

        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_custom_title')):

    function tfuse_custom_title() {
        global $post;
        $tfuse_title_type = tfuse_page_options('page_title');

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_page_options('custom_title');
        else
            $title = get_the_title();

        echo ( $title ) ? $title  : '';
    }

endif;

// page custom title
if (!function_exists('tfuse_page_custom_title')):

    function tfuse_page_custom_title() {
        global $post,$is_tf_blog_page,$is_tf_front_page;
        

        if($is_tf_front_page)
        {
            $page_id = tfuse_options('home_page');
            $tfuse_title_type = tfuse_page_options('page_title','',$page_id);
            
            if ($tfuse_title_type == 'hide_title')
            $title = '';
            elseif ($tfuse_title_type == 'custom_title')
                $title = tfuse_page_options('custom_title','',$page_id);
            else
                $title = get_the_title($page_id);
        }
        elseif($is_tf_blog_page)
        {
            
        }
        else
        {
            $tfuse_title_type = tfuse_page_options('page_title');
            if ($tfuse_title_type == 'hide_title')
            $title = '';
            elseif ($tfuse_title_type == 'custom_title')
                $title = tfuse_page_options('custom_title');
            else
                $title = get_the_title();
        }
        
        

        echo ( $title ) ? '<div class="title_box"> <span class="icon icon-magic"></span><h1>'.$title.'</h1></div>'  : '';
    }

endif;

if (!function_exists('tfuse_archive_custom_title')):

    function tfuse_archive_custom_title()
    {
        global $is_tf_blog_page,$is_tf_front_page;
        $cat_ID = 0;$title = '';
        
        if($is_tf_front_page)
        {
            $homepage_category = tfuse_options('homepage_category');
            if(($homepage_category == 'all') || ($homepage_category == 'specific')) 
            {
                $title = tfuse_options('home_cat_title');
            }
        }
        elseif ($is_tf_blog_page)
        {
            $homepage_category = tfuse_options('blogpage_category');
            if(($homepage_category == 'all') || ($homepage_category == 'specific')) 
            {
                $title = tfuse_options('home_cat_title_blog');
            }
        }
        elseif ( is_category() )
        {
            $cat_ID = get_query_var('cat');
            $title = tfuse_options('categ_title','',$cat_ID);
        }
        elseif ( is_post_type_archive() )
        {
            $title = post_type_archive_title('',false);
        }

        echo !empty($title) ? '<span class="icon icon-file-text-alt"></span><h1>'. $title . '</h1>' : '';
    }

endif;



if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        if (tfuse_page_options('disable_comments'))
            comments_template( '' );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' comments','tfuse');
            } else {
                $comments = __('1 comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link() . '">' . $comments . '</a>';
        } else {
            $write_comments = __('comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;

if (!function_exists('tfuse_pagination')):
    
function tfuse_pagination( $args = array(), $query = '' ) {
   
    global $wp_rewrite, $wp_query;
        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement
        /* If there's not more than one page, return nothing. */ 
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        
        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );  

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults ); 

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
            ?>
            <div class="tf_pagination">
                <div class="inner">
                    <?php 
                        $next = get_next_posts_link('<span class="page_next"><span>Next</span></span>');
                        $prev = get_previous_posts_link('<span class="page_prev"><span>Prev</span></span>');
                        if(!empty($next)) echo $next;
                        else echo '<span class="page_next"><span class="inactive">Next</span></span>';
                    
                        echo $page_links; 
                        
                        if(!empty($prev)) echo $prev;
                        else echo '<span class="page_prev"><span class="inactive">Prev</span></span>';
                    ?>
                </div>
            </div>
            
            <?php
}
endif;

if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$post;
        $position = ( $position == 'before' ) ? 'content_top' : 'content_bottom';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = tfuse_options('home_page'); 
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        { 
           $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        } 
        elseif (is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);

        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if((($position == 'content_bottom') && !empty($page_shortcodes)) || (($position == 'blog_content_bottom') && !empty($page_shortcodes)))
            { 
                echo '<div class="middle_bot clearfix">';
                    echo $page_shortcodes;
                echo '</div>';
            }
            elseif((($position == 'content_top') && !empty($page_shortcodes))|| (($position == 'blog_content_top') && !empty($page_shortcodes) || (($position == 'content_top_ann') && !empty($page_shortcodes))) )
            {
               echo '<div class="middle_top_shortcode clearfix">';
                    echo $page_shortcodes;
                echo '</div>';
            }
            else
                echo $page_shortcodes;
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'specific_promos')
        {
            $archive = 'archive-promos.php';
           
            include_once(locate_template($archive));
            return;
        }
        elseif($homepage_categ == 'all_promos')
        {
            $archive = 'archive-promos.php';
            
            include_once(locate_template($archive));
            die();
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive-content.php';

            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if ( !function_exists('tfuse_pass_ajax_info')):

    function tfuse_pass_ajax_info() {
        global $post,$TFUSE,$is_tf_blog_page,$is_tf_front_page,$wp_query;
        $posts = '';
        $max_specific =  $num_post = $posttype = $col = 0 ;
        $items = get_option('posts_per_page');
        
        if(!empty($post)) $posttype = $post->post_type;  else $posttype = '';
        
        if(is_search())
        {
            if($TFUSE->request->isset_GET('post_type') || $TFUSE->request->isset_GET('events'))
            {
                $search_param = $TFUSE->request->GET('s');
                $date = $TFUSE->request->GET('filter_date');
                $slug = $TFUSE->request->GET('events');
                $post_type = $TFUSE->request->GET('post_type');
                $search_query = get_search_query();

                if(!empty($date))
                {
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'event'
                    );
                    $all_posts = new WP_Query( $args );
                    $al_posts = $all_posts->posts;
                    
                    $date_from = new DateTime($date);
                    $year = $date_from->format('Y');
                    $month = $date_from->format('m'); 
                    $day = $date_from->format('d');
                    $search_event['date'] = $year.'-'.$month.'-'.$day;

                    if(!empty($al_posts))
                        foreach ($al_posts as $post) {
                           $date_post = tfuse_page_options('date_from','',$post->ID);

                            if($date_post == $search_event['date'])
                            {
                                $posts[] = $post;
                            }
                    }
                }
                elseif($post_type == 'events' && empty($slug))
                {
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'event'
                    );
                    $all_posts = new WP_Query( $args );
                    $posts = $all_posts->posts;
                }
                else {
                    if(!empty($search_query) && !empty($slug))
                    {
                        if($search_query == ' ')
                        {
                            $args = array(
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                        'taxonomy' => 'events',
                                        'field' => 'slug',
                                        'terms' => $slug
                                    )
                                )
                            );
                            $all_events = new WP_Query( $args );
                            $posts = $all_events->get_posts();
                        }
                        else
                        {
                            $args = array(
                            'posts_per_page' => -1,
                                's' => $search_query,
                            'tax_query' => array(
                                array(
                                        'taxonomy' => 'events',
                                        'field' => 'slug',
                                        'terms' => $slug
                                    )
                                )
                            );
                            $aevents = new WP_Query( $args );
                            $posts = $aevents->get_posts();
                        }
                    }
                    else
                    {
                        $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'event',
                        'tax_query' => array(
                            array(
                                    'taxonomy' => 'events',
                                    'field' => 'slug',
                                    'terms' => $slug
                                )
                            )
                        );
                        $all_posts = new WP_Query( $args );
                        $posts = $all_posts->posts;
                    }
                    
                }
            }
            else
            {
                $search_query = get_search_query();
                $cat = (get_query_var('cat')) ? get_query_var('cat') : '';
                $term = (get_query_var('term')) ? get_query_var('term') : '';
                
                if(!empty($cat))
                {
                    $query = new WP_Query(array( 'cat' => $cat,'s' => $search_query,'posts_per_page' => -1));
                    $posts = $query->get_posts();
                }
                elseif(!empty($term))
                {
                    $query = new WP_Query(array( 
                    'posts_per_page' => -1 ,
                    's' => $search_query,
                    'tax_query' => array(
                                    array(
                                        'taxonomy' => 'promos',
                                        'field' => 'slug',
                                        'terms' => $term
                                    )
                            )));
                    $posts = $query->get_posts();
                }
                else
                {
                    $query = new WP_Query(array( 's' => $search_query ,'posts_per_page' => -1));
                    $posts = $query->get_posts();
                }
            }
        }
        elseif(is_tax())
        {  
            if($posttype == 'promo')
            { $term = get_term_by('slug', get_query_var('term'), 'promos'); $type = 'promos'; }
            elseif($posttype == 'event')
            {
                $term = get_term_by('slug', get_query_var('term'), 'location');
                $type = 'location';
                
                if(empty($term)) {$term = get_term_by('slug', get_query_var('term'), 'events'); $type = 'events';}
            }
            elseif($posttype == 'date')
            { $term = get_term_by('slug', get_query_var('term'), 'dates'); $type = 'dates'; }
            elseif($posttype == 'album')
            { $term = get_term_by('slug', get_query_var('term'), 'albums'); $type = 'albums'; }
            elseif($posttype == 'product')
            { $term = get_term_by('slug', get_query_var('term'), 'products'); $type = 'products'; }
            
            if(!empty($term))
            {
                $ID = $term->term_id; 
                $query = new WP_Query(array( 
                    'posts_per_page' => -1 ,
                    'tax_query' => array(
                                    array(
                                        'taxonomy' => $type,
                                        'field' => 'id',
                                        'terms' => $ID
                                    )
                            )));
                $posts = $query->get_posts();
            }
        }
        elseif($is_tf_front_page || $is_tf_blog_page)
        { 
            if($is_tf_front_page){
                $select_blog = tfuse_options('homepage_category','');
            }
            else {
                $select_blog = tfuse_options('blogpage_category', '');
            }

            if($select_blog=='specific'){
                if($is_tf_front_page) $cats = tfuse_options('categories_select_categ', '');
                else $cats = tfuse_options('categories_select_categ_blog', '');
                $cat_ids = explode(",",$cats);
                $type = 'post';
                $tax = 'category';
            }
            elseif($select_blog=='specific_promos'){
                if($is_tf_front_page) $cats = tfuse_options('categories_select_promos', '');
                else $cats = tfuse_options('categories_select_promos_blog', '');
                $cat_ids = explode(",",$cats);
                $type = 'promo';
                $tax = 'promos';
            }
            elseif($select_blog=='all_promos'){
                $cats = get_terms('promos');
                $cat_ids = array();
                foreach($cats as $cat){
                    $cat_ids[] = $cat->term_id;
                }
                $type = 'promo';
                $tax = 'promos';
            }
            else{
                $cats = get_terms('category');
                $cat_ids = array();
                foreach($cats as $cat){
                    $cat_ids[] = $cat->term_id;
                }
                $type = 'post';
                $tax = 'category';
            }

            $args = array(
                'post_type' => $type,
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $tax,
                        'field' => 'id',
                        'terms' => $cat_ids
                    )
                )
            );
            $posts = new WP_Query( $args );
            $posts = $posts -> posts;
            
            if($select_blog=='specific' || $select_blog=='specific_promos'){
                $num_posts = count($posts);
                $max_specific = $num_posts/$items;
                if($num_posts%$items != 0) $max_specific++;
            }
            else
                $max_specific = 0;
            
        }
        elseif(is_category())
        { 
            $ID = get_query_var('cat');
            $query = new WP_Query(array( 'cat' => $ID,'posts_per_page' => -1));
            $posts = $query->get_posts();
        }
        else
        {
            $posts = '';
        }
        
        if($is_tf_front_page){
            $select_front = tfuse_options('homepage_category','');
        }
        else {
            $select_front = tfuse_options('blogpage_category', '');
        }
        
        if($is_tf_blog_page)
        { 
            $paged = 1;
            $num_posts = count($posts);
            $max = $num_posts/$items;
            if($num_posts%$items != 0) $max++; 
        }
        elseif( !is_singular() || $is_tf_blog_page != true ) {
            $max = $wp_query->max_num_pages; 
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        }
        else { 
            $paged = '';
            $max = '';
        }
        
        wp_localize_script(
                'general',
                'display',
                array(
                    'max_specific' => $max_specific,
                    'number' => count($posts),
                    'items' => $items,
                    'startPage' => $paged,
                    'maxPages' => $max,
                    'nextLink' => next_posts($max, false)
                )
            );
    }
    add_action('wp_print_scripts', 'tfuse_pass_ajax_info', 1000);
endif;

if (!function_exists('tfuse_pre_get_posts')) :
    
function tfuse_pre_get_posts($query){
    global $TFUSE;
    
    if ( $query->is_home() && $query->is_main_query() ) {
        global $is_tf_front_page;
         $is_tf_front_page = true;
         $homepage_category = tfuse_options('homepage_category');
         if($homepage_category == 'all_promos') 
         {
            $items = get_option('posts_per_page');
            $query->set( 'posts_per_page', $items );
            $query->set( 'post_type', array('promo') );
         }
         elseif($homepage_category == 'specific_promos'){
             
            $homepage_tax = tfuse_options('categories_select_promos');
            $homepage_tax = explode(",",$homepage_tax);
            $items = get_option('posts_per_page');
            $query->set( 'posts_per_page', $items );
            $query->set( 'post_type', array('promo') );
            $query->set( 'tax_query', array(
                    array(
                        'taxonomy' => 'promos',
                        'field' => 'id',
                        'terms' => $homepage_tax,
                    ) ));
         }

    }
    elseif(($query->is_search && $TFUSE->request->isset_GET('post_type')) || ($query->is_search && $TFUSE->request->isset_GET('events')))
    {
        $ids = array();
       // $items = get_option('posts_per_page');
        //$query->set( 'posts_per_page', $items );
        
        $date = $TFUSE->request->GET('filter_date');
        $search = $TFUSE->request->GET('s');  
        $slug = $TFUSE->request->GET('events');
        $post_type = $TFUSE->request->GET('post_type');
        
        if(!empty($date))
        {
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'event'
            );
        }
        elseif($post_type == 'events' && empty($slug))
        {
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'event'
            );
        }
        else {
            $args = array(
            'posts_per_page' => -1,
            'post_type' => 'event',
            'tax_query' => array(
		array(
			'taxonomy' => 'events',
			'field' => 'slug',
			'terms' => $slug
                    )
                )
            );
        }
        $all_posts = new WP_Query( $args );
        $posts = $all_posts->posts;

        if(!empty($date))
        {
            $date_from = new DateTime($date);
            $year = $date_from->format('Y');
            $month = $date_from->format('m'); 
            $day = $date_from->format('d');
            $search_event['date'] = $year.'-'.$month.'-'.$day;
            
            if(!empty($posts))
                foreach ($posts as $post) {
                   $date_post = tfuse_page_options('date_from','',$post->ID);

                    if($date_post == $search_event['date'])
                    {
                     $ids[] = $post->ID;
                    }
            }
        }
        else
        {
            if(!empty($posts))
            foreach ($posts as $post) {
                $ids[] = $post->ID;
            }
        }

        
        if(!empty($ids) && $post_type == 'events')
        {
            $query->set( 'post_type', array('event') );
            $query->set( 's', ' ' );
            $query->set( 'post__in', $ids );
        }
        elseif(!empty($ids))
        {
            $query->set( 'post_type', array('event') );
            $query->set( 's', $search );
            $query->set( 'post__in', $ids );
        }
        else
        {
            $query->set( 'post__in', array(0));
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'tfuse_pre_get_posts');

endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        elseif($blogpage_categ == 'all_promos')
        {
            $archive = 'archive-promos.php';
            $items = get_option('posts_per_page');
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $is_tf_blog_page = true;
            
            $taxonomies = get_terms('promos', array('hide_empty' => 0));

            $slug=array();
            foreach($taxonomies as $tax){
                $slug[]=$tax->slug;
            }
            
            $args = array(
                'paged' => $paged,
                'posts_per_page' => $items,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'promos',
                        'field' => 'slug',
                        'terms' => $slug,
                    ),
                )
            );
            $posts = query_posts ($args);
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
        elseif($blogpage_categ == 'specific_promos')
        {   
            $is_tf_blog_page = true;
            $archive = 'archive-promos.php';
            $items = get_option('posts_per_page');
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;            
            $taxonomies = get_terms('promos', array('hide_empty' => 0));
            $homepage_tax = tfuse_options('categories_select_promos_blog');
            $homepage_tax = explode(",",$homepage_tax);

            $slug=array();
            foreach($taxonomies as $tax){
                $slug[]=$tax->slug;
            }
           
            $args = array(
                'paged' => $paged,
                'posts_per_page' => $items,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'promos',
                        'field' => 'id',
                        'terms' => $homepage_tax,
                    ),
                )
            );
            $posts = query_posts ($args);
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
        else
        {  
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

if (!function_exists('tfuse_action_footer')) :

/**
 * Dsiplay footer content
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_footer() {
    
        if(tfuse_options('enable_footer_widgets'))
        {
    ?>
        <div class="footer_widgets">
            <div class="container clearfix">
                <div class="f_col alpha">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>

                <div class="f_col">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
                <div class="f_col">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>

                <div class="f_col omega">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            </div>
        </div>
            <?php
        }
    }

    add_action('tfuse_footer', 'tfuse_action_footer');
endif;
    
function new_excerpt_more( $more ) {
    $more = '...';
        return $more;
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


if ( !function_exists('tfuse_img_content')):

    function tfuse_img_content(){ 
        $content = $link = '';
		$args = array(
			'numberposts'     => -1,
		); 
        $posts_array = get_posts( $args );
        $option_name = 'thumbnail_image';
		foreach($posts_array as $post):
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
			if(tfuse_page_options('thumbnail_image',false,$post->ID)) continue;
			
			if(!empty($featured))
			{
				$value = $featured[0];
				tfuse_set_page_option($option_name, $value, $post->ID);
				tfuse_set_page_option('disable_image', true , $post->ID); 
			}
			else
			{
				$args = array(
				 'post_type' => 'attachment',
				 'numberposts' => -1,
				 'post_parent' => $post->ID
				); 
				$attachments = get_posts($args);
				if ($attachments) {
				 foreach ($attachments as $attachment) { 
								$value = $attachment->guid; 
								tfuse_set_page_option($option_name, $value, $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID); 
							 }
				}
				else
				{
					$content = $post->post_content;
						if(!empty($content))
						{   
							preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content,$matches);
							if(!empty($matches))
							{
								$link = $matches[1]; 
								tfuse_set_page_option($option_name, $link , $post->ID);
								tfuse_set_page_option('disable_image', false , $post->ID);
							}
						}
				}
			}
                        
		endforeach;
			tfuse_set_option('enable_content_img',false, $cat_id = NULL);
    }
endif;

if ( tfuse_options('enable_content_img'))
{ 
    add_action('tfuse_head','tfuse_img_content');
}

if(!function_exists('tfuse_feedFilter')) :

    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }

endif;

if (!function_exists('tfuse_aasort')) :
    /**
     *
     *
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
     */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;

function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="submenu-1" /',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');

//display logo
if (!function_exists('tfuse_type_logo')) :
    function tfuse_type_logo() { 
        $logo_upload = tfuse_options('logo');
        if(!empty($logo_upload)) 
        {  ?> 
              <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo tfuse_options('logo'); ?>"   border="0" /></a></div>
  <?php }
        else
        {      
            ?>
                <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo tfuse_logo(); ?>"   border="0" /></a></div>
            <?php 
         }
    }
endif;

if (!function_exists('tfuse_shorten_string')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array);
    }
    return $retval;
}

endif;

if (!function_exists('tfuse_extract_shortcodes')) :	
    function tfuse_extract_shortcodes() 
    {	
        global $TFUSE,$post,$is_tf_blog_page,$is_tf_front_page;
        if(isset($post->post_type))$posttype = $post->post_type;
        $shortcode = ''; 
        if($posttype == 'announcement' && !is_singular()){
            $shortcode = tfuse_options('header_bottom_shortcode_ann');
        }
        elseif($is_tf_blog_page)
        { 
            $shortcode = tfuse_options('header_bottom_shortcode_blog');
        }
        elseif($is_tf_front_page)
        {
            $page_options = tfuse_options('use_page_options');
            if($page_options)
            {
               $page_id = tfuse_options('home_page');
               $shortcode = tfuse_page_options('header_bottom_shortcode','',$page_id);
            }
            else
            {
                $shortcode = tfuse_options('header_bottom_shortcode_home');
            }
        }
        elseif(is_singular())
        {
            $shortcode = tfuse_page_options('header_bottom_shortcode');
        }
        elseif ( is_category() )
        { 
            $ID = get_query_var('cat');
            $shortcode = tfuse_options('header_bottom_shortcode','',$ID);
        }
        elseif ( is_tax() )
        { 
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $shortcode = tfuse_options('header_bottom_shortcode','',$ID);
        }
        else{
            $shortcode = tfuse_options('header_bottom_shortcode');
        }
        
            echo $page_shortcodes = apply_filters('themefuse_shortcodes', $shortcode); 
    }
endif;

if (!function_exists('tfuse_filter_get_avatar')){

    function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){
        $email_hash = '';
        $avatar_src = tfuse_options('default_avatar', false);
        if(empty($avatar_src)) {
            return $avatar;
        }

        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;

            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }

        if ( !empty($email) )
            $email_hash = md5( strtolower( trim( $email ) ) );

        $url = 'http://gravatar.com/' . $email_hash . '.php';
        $result = unserialize(@file_get_contents($url));
        
        if(!is_array($result)){ 
            $avatar = "<img alt='' src='" . TF_GET_IMAGE::get_src_link($avatar_src, $size, $size)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
        }
        return $avatar;
    }
    add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}


if (!function_exists('tfuse_get_search_categories')) :
    function tfuse_get_search_categories()
    {
        $terms = array(); 
        if(is_category())
        {
            $categories = get_categories();
            if(!empty($categories))
                foreach($categories as $val)
                {
                    $terms[$val->term_id] = $val->name;
                }
        }
        elseif(is_tax())
        {
            $taxonomies = get_terms( 'promos' );
            if(!empty($taxonomies))
                foreach($taxonomies as $val)
                {
                    $terms[$val->slug] = $val->name;
                }
        }
        
        return $terms;
    }
endif;

if (!function_exists('tfuse_get_search_event_categories')) :
    function tfuse_get_search_event_categories()
    {
        $terms = array(); 
        if(is_tax() || is_search())
        {
            $taxonomies = get_terms( 'events' );
            if(!empty($taxonomies))
                foreach($taxonomies as $val)
                {
                    $terms[$val->slug] = $val->name;
                }
        }
        
        return $terms;
    }
endif;

//get current category id
if (!function_exists('tfuse_get_current_term_id')) :
    function tfuse_get_current_term_id()
    {
        global $is_tf_blog_page;
        $ID = ''; 
        if($is_tf_blog_page)
        {
            $ID = '';
        }
        elseif(is_category())
        {
            $ID = get_query_var('cat');
        }
        elseif(is_tax())
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
        }
        
        return $ID;
    }
endif;


//get current category id
if (!function_exists('tfuse_get_current_term_slug')) :
    function tfuse_get_current_term_slug()
    {
        $slug = ''; 
        if(is_tax())
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $slug = $term->slug;
        }
        
        return $slug;
    }
endif;

if (!function_exists('tfuse_enable_breadcrumbs')) :
    function tfuse_enable_breadcrumbs()
    {
        global $is_tf_blog_page,$is_tf_front_page; 
        $breadcrumbs = false;
        if($is_tf_front_page)
        {
            $page_id = tfuse_options('home_page');
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {
                if(tfuse_page_options('breadcrumbs','',$page_id))
                $breadcrumbs = true;
            }
            else {
                if(tfuse_options('breadcrumbs_home'))
                $breadcrumbs = true;
            }
        }
        elseif($is_tf_blog_page)
        {
            if(tfuse_options('breadcrumbs_blog'))
                $breadcrumbs = true;
        }
        elseif(is_category())
        {
            $ID = tfuse_get_current_term_id();
            if(tfuse_options('breadcrumbs','',$ID))
                $breadcrumbs = true;
        }
        elseif(is_tax())
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            
            if(tfuse_options('breadcrumbs','',$ID))
                $breadcrumbs = true;
        }
        elseif(is_singular())
            if(tfuse_page_options('breadcrumbs'))
                $breadcrumbs = true;
        
        if($breadcrumbs)
        {
            echo '<div class="white_row breadcrumbs clearfix">';
                tfuse_breadcrumbs();
            echo '</div>';
        }
    }
endif;
             

if (!function_exists('tfuse_get_sarch_id')) :
    function tfuse_get_sarch_id()
    {
        $key = '';
        if(is_category())
        {
            $key = 'cat';
        }
        elseif(is_tax())
        {
            $key = get_query_var('taxonomy');
            if($key == 'location')
                $key = 'events';
        }
        elseif(is_search())
        {
            $key = 'events';
        }
        return $key;
    }
endif;

if (!function_exists('tfuse_categories_postcount_filter')) :

function tfuse_categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<i class="badge pull-right"> ', $variable);
   $variable = str_replace(')', ' </i>', $variable);
   return $variable;
}
add_filter('wp_list_categories','tfuse_categories_postcount_filter');

endif;

if (!function_exists('tfuse_time_ago')) :

function tfuse_time_ago ($post_time) {
    $today = time();    
    $createdday= strtotime($post_time); //mysql timestamp of when post was created  
    $datediff = abs($today - $createdday);  
    $difftext="";  
    $years = floor($datediff / (365*60*60*24));  
    $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
    $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
    $hours= floor($datediff/3600);  
    $minutes= floor($datediff/60);  
    $seconds= floor($datediff);  
    //year checker  
    if($difftext=="")  
    {  
      if($years>1)  
       $difftext=$years. __(' years ago','tfuse');  
      elseif($years==1)  
       $difftext=$years. __(' year ago','tfuse');  
    }  
    //month checker  
    if($difftext=="")  
    {  
       if($months>1)  
       $difftext=$months. __(' months ago','tfuse');  
       elseif($months==1)  
       $difftext=$months. __(' month ago','tfuse');  
    }  
    //month checker  
    if($difftext=="")  
    {  
       if($days>1)  
       $difftext=$days. __(' days ago','tfuse');  
       elseif($days==1)  
       $difftext=$days.__(' day ago','tfuse');  
    }  
    //hour checker  
    if($difftext=="")  
    {  
       if($hours>1)  
       $difftext=$hours.__(' hours ago','tfuse');  
       elseif($hours==1)  
       $difftext=$hours.__(' hour ago','tfuse');  
    }  
    //minutes checker  
    if($difftext=="")  
    {  
       if($minutes>1)  
       $difftext=$minutes.__(' minutes ago','tfuse');  
       elseif($minutes==1)  
       $difftext=$minutes.__(' minute ago','tfuse');  
    }  
    //seconds checker  
    if($difftext=="")  
    {  
       if($seconds>1)  
       $difftext=$seconds.__(' seconds ago','tfuse');  
       elseif($seconds==1)  
       $difftext=$seconds.__(' second ago','tfuse');  
    }  
    echo $difftext;  
}

endif;

if (!function_exists('tfuse_get_event_date')) :

function tfuse_get_event_date ($ID) {
    $date_in = tfuse_page_options('date_from','',$ID);
    $date_out = tfuse_page_options('date_final','',$ID);
    $date_echo = '';
    if(!empty($date_in) && !empty($date_out))
    {
        $date_from = new DateTime($date_in);
        $month_in = $date_from->format('M'); 
        $day_in = $date_from->format('d');
        
        $date_fin = new DateTime($date_out);
        $month_out = $date_fin->format('M'); 
        $day_out = $date_fin->format('d');
        
        if($month_in != $month_out)
        {
            $date_echo =  $month_in.' <strong>'.$day_in.'-'.$day_out.'</strong> '.$month_out;
        }
        else
        {
            $date_echo = $month_in.' <strong>'.$day_in.'-'.$day_out.'</strong>';
        }
    }
    elseif(!empty($date_in) && empty($date_out))
    {
        $date_from = new DateTime($date_in);
        $month_in = $date_from->format('M'); 
        $day_in = $date_from->format('d');
        
        $date_echo =  $month_in.' <strong>'.$day_in.'</strong>';
    }
    else
        $date_echo = '';
    
    return $date_echo;
}

endif;


if (!function_exists('tfuse_tour_date')) :

function tfuse_tour_date ($ID) {
    $date_in = tfuse_page_options('date_from','',$ID);
    $date_out = tfuse_page_options('date_final','',$ID);
    $date_echo = '';
    if(!empty($date_in) && !empty($date_out))
    {
        $date_from = new DateTime($date_in);
        $year_in = $date_from->format('Y'); 
        $month_in = $date_from->format('F'); 
        $day_in = $date_from->format('d');
        
        $date_fin = new DateTime($date_out);
        $year_out = $date_fin->format('Y');
        $month_out = $date_fin->format('F'); 
        $day_out = $date_fin->format('d');

        if($year_out == $year_in)
        {
            $year = $year_in;
        }
        else
        {
            $year = $year_in.'-'.$year_out;
        }
        
        if($month_in != $month_out)
        {
            $date_echo =  $month_in.' '.$day_in.'-'.$day_out.' '.$month_out.', '.$year;
        }
        else
        {
            $date_echo = $month_in.' '.$day_in.'-'.$day_out.', '.$year;
        }
    }
    elseif(!empty($date_in) && empty($date_out))
    {
        $date_from = new DateTime($date_in);
        $year_in = $date_from->format('Y'); 
        $month_in = $date_from->format('F'); 
        $day_in = $date_from->format('jS');
        
        $date_echo =  $month_in.' '.$day_in.', '.$year_in;
    }
    else
        $date_echo = '';
    
    return $date_echo;
}

endif;

if (!function_exists('tfuse_events_location')):

    function tfuse_events_location( $ID, $taxonomy ) {
        $location = array();
    
        $terms = get_the_terms( $ID, $taxonomy );
        if(!empty($terms))
		{
			foreach ($terms as $term) {
				$location = array(); 
				$child = get_term_children( $term->term_id, $taxonomy );
				if(empty($child))
				{
					$parents = array();
					$last_child = $term;
					$parents[] = $last_child->term_id;
					$term_id = intval( $last_child->term_id );
					$term = get_term( $term_id, $taxonomy );
					$parent_id = $term->parent;
					$parents[] = $parent_id;
					array_pop($parents);
				}
					
			}
			
			if(!empty($parents))
			{
				foreach ($parents as $id) {
					$term = get_term( $id, $taxonomy );
					$location[] = $term->name;
				}
			}
			else
			{
				$location[] = $term->name;
			}
		}
        
        return implode(', ', $location);
    }

endif;


if (!function_exists('tfuse_get_event_icon')):

    function tfuse_get_event_icon( $post_id ) {
        $terms = get_the_terms( $post_id , 'events' );
    
        if(!empty($terms))
        {
            foreach ($terms as $term) {
                $ID = $term->term_id;
            }

            return tfuse_options('icon_class','',$ID);
        }
    }

endif;


if (!function_exists('tfuse_archive_header')):

    function tfuse_archive_header() {
        $type = '';
        if(is_category())
        {
            $type = is_category();
        }
        elseif(is_tax())
        {
            $type = is_tax();
        }
    
        if(is_archive() && !$type)
        {
            echo '<div class="white_row filters filter_short clearfix">';
                echo '<h1>'. __( 'Archive | ', 'tfuse' ); the_time('F, Y').'</h1>';
            echo '</div>';
        }
    }

endif;

if (!function_exists('tfuse_player_enabled')):

    function tfuse_player_enabled() {
        global $is_tf_blog_page,$is_tf_front_page;
        $player = tfuse_options('enable_site_player');
        
        if($is_tf_front_page)
        {
            $page_id = tfuse_options('home_page');
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {
                $player = tfuse_page_options('palyer_enable','',$page_id);
            }  
            else
            {
                $player = tfuse_options('palyer_enable_home');
            }
        }
        elseif($is_tf_blog_page)
        {
            $player = tfuse_options('palyer_enable_blog');
        }
        elseif(is_singular())
        {
            $player = tfuse_page_options('palyer_enable');
        }
        elseif(is_category())
        {
            $ID = get_query_var('cat');
            $player = tfuse_options('palyer_enable',null,$ID);
        }
        elseif(is_tax())
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $player = tfuse_options('palyer_enable',null,$ID);
        }
        elseif(is_search())
        {
            $player = tfuse_options('enable_site_player');
        }
        elseif(is_404())
        {
            $player = tfuse_options('enable_site_player');
        }
        
        return $player;
    }

endif;

if (!function_exists('tfuse_middle_background')):

    function tfuse_middle_background() {
        global $is_tf_blog_page,$is_tf_front_page;
        $content = tfuse_options('middle_color');
        
        if($is_tf_front_page)
        {
            $page_id = tfuse_options('home_page');
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {
                $content = tfuse_page_options('middle_color','',$page_id);
            }
            else{
                $content = tfuse_options('middle_color_home');
            } 
        }
        elseif($is_tf_blog_page)
        {
            $content = tfuse_options('middle_color_blog');
        }
        elseif(is_singular())
        {
            $content = tfuse_page_options('middle_color');
        }
        elseif(is_category())
        {
            $ID = get_query_var('cat');
            $content = tfuse_options('middle_color',null,$ID);
        }
        elseif(is_tax())
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $content = tfuse_options('middle_color',null,$ID);
        }
        
        return $content;
    }

endif;

if (!function_exists('tfuse_get_promo_title')):

    function tfuse_get_promo_title() {
        global $is_tf_blog_page,$is_tf_front_page;
        
        $title = '';
        if($is_tf_front_page)
        {
            $homepage_category = tfuse_options('homepage_category');
            if(($homepage_category == 'all_promos') || ($homepage_category == 'specific_promos')) 
            {
                $title = tfuse_options('home_cat_title');
            }
        }
        elseif ($is_tf_blog_page)
        {
            $homepage_category = tfuse_options('blogpage_category');
            if(($homepage_category == 'all_promos') || ($homepage_category == 'specific_promos')) 
            {
                $title = tfuse_options('home_cat_title_blog');
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $title = tfuse_options('promo_title',null,$term->term_id);
        }
        
        return $title;
    }

endif;

if (!function_exists('tfuse_select_pagination')):

    function tfuse_select_pagination() {
        $pagination_type = tfuse_options('pagination_type');
        
        if($pagination_type == 'type1')
            tfuse_pagination();
        elseif($pagination_type == 'type2')
        {
            global $post;$type = '';
            if(isset($post->post_type))
                $posttype = $post->post_type;
            else 
                $posttype = '';
            
            if(is_category())
            {
                $type = is_category();
            }
            elseif(is_tax())
            {
                $type = is_tax();
            }
            
            if(is_archive() && !$type)
            {
                tfuse_pagination();
            }
            elseif($posttype == 'event' || $posttype == 'date' || $posttype == 'product' || $posttype == 'album')
                echo '<div class="tf_pagination">
                    <div class="inner_page"><a href="#" class="btn btn-primary btn-wide" id="ajax_load_posts">
                          <span class="icon icon-plus-sign"></span> '.__('MORE POSTS','tfuse').'
                      </a></div></div>';
            else
                echo '<a href="#" class="btn btn-primary btn-wide" id="ajax_load_posts">
                          <span class="icon icon-plus-sign"></span> '.__('MORE POSTS','tfuse').'
                      </a>';
        }
        else
            tfuse_pagination();
    }

endif;



if ( !function_exists('tfuse_get_cat_id')):

    function tfuse_get_cat_id() {
        global $post;
	$ID = $posttype = '';
        
        if(!empty($post)) $posttype = $post->post_type;  else $posttype = '';
        
        if(is_tax())
        {
            if($posttype == 'promo')
                $term = get_term_by('slug', get_query_var('term'), 'promos');
            elseif($posttype == 'event')
            {
                 $term = get_term_by('slug', get_query_var('term'), 'location');
                 
                 if(empty($term))
                     $term = get_term_by('slug', get_query_var('term'), 'events');
            }
            elseif($posttype == 'date')
                $term = get_term_by('slug', get_query_var('term'), 'dates');
            elseif($posttype == 'album')
                $term = get_term_by('slug', get_query_var('term'), 'albums');
            elseif($posttype == 'product')
                $term = get_term_by('slug', get_query_var('term'), 'products');
            
            if(!empty($term))
                $ID = $term->term_id;
        }
        elseif(is_category())
        { 
            $ID = get_query_var('cat');
        }
        return $ID;
    }
endif;


if (!function_exists('tfuse_content_id')):

    function tfuse_content_id() {
        $pagination_type = tfuse_options('pagination_type');
        
        if($pagination_type == 'type1')
            $id = '';
        elseif($pagination_type == 'type2')
        {
            global $post;$type = '';
            
            if(is_category())
            {
                $type = is_category();
            }
            elseif(is_tax())
            {
                $type = is_tax();
            }
            
            if(is_archive() && !$type)
            {
                $id = '';
            }
            else
                $id = 'id="content_load"';
        }
        else
            $id = '';
        
        return $id;
    }

endif;

if ( !function_exists('tfuse_is_homepage')):

    function tfuse_is_homepage() {
        global $is_tf_blog_page,$is_tf_front_page;
        
        if($is_tf_front_page) return 'homepage';
        elseif($is_tf_blog_page) return 'blogpage';
        else return;
           
    }
endif;

if ( !function_exists('tfuse_select_all_home')):

    function tfuse_select_all_home() {
        $select= tfuse_options('homepage_category');
        
        if($select == 'all' || $select == 'all_promos') return 'allhomecategories';
        if($select == 'specific_promos') return 'nonehomeall';
        else return 'nonehomeall';
    }
endif;

if ( !function_exists('tfuse_select_all_blog')):

    function tfuse_select_all_blog() {
        $select = tfuse_options('blogpage_category');
        
        if($select == 'all' || $select == 'all_promos') return 'allblogcategories';
        if($select == 'specific_promos') return 'noneblogall';
        else return 'noneblogall';
    }
endif;

if ( !function_exists('tfuse_get_categories_ids')):

    function tfuse_get_categories_ids() {
        global $post; 
        if(isset($post->post_type))$post_type = $post->post_type; else $post_type = '';

        if($post_type=='promo' ){
            $categories = get_terms('promos');
        }
        else{
            $categories = get_categories();
        }
        $id = array();
        foreach ($categories as $category):
            $id[] = $category->term_id;
        endforeach;

        $ids = implode(',',$id);
        return $ids;
    }
endif;

if ( !function_exists('tfuse_pass_post_id')):

    function tfuse_pass_post_id() {
        global $post;
        
        if(is_singular('album'))
        {  
            $attachments = tfuse_get_gallery_images($post->ID ,TF_THEME_PREFIX . '_track_songs');
            
            if(!empty($attachments))
            {
                $rating = array();
                $song_numb = count($attachments);

                for($i = 1; $i <= $song_numb; $i++)
                {
                    $rating['rating_'.$post->ID.'_track_'.$i]['val'] = '';
                    $rating['rating_'.$post->ID.'_track_'.$i]['count'] = 0;
                }
                
                $rating_info = get_post_meta($post->ID, TF_THEME_PREFIX . '_rating', true);
                
                if(empty($rating_info)) {$rating_info = $rating;}

                wp_localize_script(
                        'general',
                        'rating',
                        array(
                            'id' => $post->ID,
                            'rating_info' => $rating_info,
                        )
                    );
            }
        }
        else
        {
            wp_localize_script(
                        'general',
                        'rating',
                        array(
                            'id' => '',
                            'rating_info' => '',
                        )
                    );
        }
    }
    add_action('wp_print_scripts', 'tfuse_pass_post_id', 1000);
endif;

if ( !function_exists('tfuse_change_style')):

    function tfuse_change_style() {
        $first_color = tfuse_options('primary_color');
        $second_color = tfuse_options('secondary_color');

        if(isset($_GET['color1']) && $_GET['color1'] != '')
            $first_color = '#'.$_GET['color1'];

        if(isset($_GET['color2']) && $_GET['color2'] != '')
            $second_color = '#'.$_GET['color2'];
        
        if(!empty($first_color))
        {
            echo '::-moz-selection {
                        background-color: '.$first_color.';
                    }
                    ::selection {
                        background-color: '.$first_color.';
                    }
                    .rating span.star:hover:before, 
                    .rating span.over:before, 
                    .rating span.on:before, 
                    .rating span.voted:before {
                        color: '.$first_color.';
                    }
                    .btn-primary,
                    .panel-primary > .panel-heading,
                    .table-primary table tr th,
                    .tf_pagination .inner{
                        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, '.$first_color.'), color-stop(1, '.$first_color.') );
                        background:-moz-linear-gradient( center top,'.$first_color.'  5%,  '.$first_color.' 100% );
                        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="'.$first_color.'", endColorstr=" '.$first_color.'");
                        background-color: '.$first_color.';
                        color: #fff !important;
                        border-color: '.$first_color.';
                    }
                    .entry .postlist a {
                    color: '.$first_color.';
                    }
                    .tf_pagination .current, .tf_pagination .current:hover {
                        background: rgba(0,0,0,0.2);
                        width: 24px;
                        height: 24px;
                        line-height: 23px;
                        -webkit-border-radius: 50%;
                        -moz-border-radius: 50%;
                        border-radius: 50%;
                        opacity: 1;
                    }
                    .tf_pagination .page_prev,
                    .tf_pagination .page_next span{
                        border-color:rgba(0,0,0,0.1);
                    }
                    .tf_pagination .page_next,
                    .tf_pagination .page_prev span {
                        border-color: rgba(0,0,0,0.2);
                    }
                    .tf_pagination .page_next:hover,
                    .tf_pagination .page_prev:hover{
                        background-color: rgba(0,0,0,0.2);
                    }
                    .panel-primary,
                    .panel-primary > .panel-heading + .panel-collapse .panel-body,
                    .panel-primary > .panel-footer + .panel-collapse .panel-body,
                    .styled_table.table-primary table{
                        border-color: '.$first_color.';
                    }
                    

                    /* primary color */
                    a,
                    .dropdown li ul li:hover a,
                    .dropdown li:hover li ul li:hover a,
                    .dropdown .current-menu-ancestor .current-menu-item a,
                    .dropdown .current-menu-ancestor .current-menu-ancestor a,
                    .dropdown .current-menu-ancestor .current-menu-ancestor .current-menu-item a,
                    .title_box .icon,
                    .widget-title .icon,
                    .event_price,
                    .copyright a:hover,
                    .link_primary,
                    .entry .link_primary,
                    .quote_right, .quote_left, .quote_center, blockquote, .frame_quote blockquote,
                    .row-icons a:hover [class^="icon-"],
                    .row-icons a:hover [class^=" icon-"],
                    .slider_quotes .prev:hover span,
                    .slider_quotes .next:hover span,
                    .quote-text,
                    .testimonials .quote-author,
                    .sidebar .widget-container li a:hover,
                    .content .widget-container li a:hover,
                    .sidebar .widget-container .current-menu-item a,
                    .sidebar .widget-container .current-menu-ancestor a,
                    .sidebar .widget-container .current-menu-item li a:hover,
                    .sidebar .widget-container .current-menu-ancestor li a:hover,
                    .sidebar .widget-container .current-menu-ancestor .current-menu-item a,
                    .widget-container.widget_nav_menu a:hover,
                    .widget-container.widget_nav_menu .current-menu-item li a:hover,
                    .widget-container.widget_categories a:hover,
                    .widget-container.widget_categories .current-menu-item li a:hover,
                    .widget-container.widget_archive a:hover,
                    .widget-container.widget_links a:hover,
                    .widget-container.widget_meta a:hover,
                    .widget-container.widget_pages a:hover,
                    .widget_calendar table a:hover,
                    .mark_today .icon,
                    .sidebar .widget_text .textwidget a,
                    .widget_tag_cloud .tagcloud a,
                    .post_list li a:hover,
                    .widget_postlist .post-meta a:hover,
                    .widget_postlist ul li .post-title:hover,
                    .content .widget-container .link-arrow,
                    .content .widget_recent_entries .post-meta a,
                    .sidebar .widget_recent_entries .post-meta a,
                    .sidebar .widget-container.widget_recent_comments a,
                    .newsletter_text .icon-rss,
                    .link-news-rss span,
                    .widget_login .forget_password a:hover,
                    .postlist .post-title h2 a:hover,
                    .postlist .post-title h3 a:hover,
                    .entry a:hover,
                    .entry a.btn-link:hover,
                    .ticket_price,
                    .author-text .author-name,
                    .link-add-comment,
                    .comment-list h2,
                    .add-comment h3,
                    .link-reset,
                    .body_wrap .cusel .cuselActive{
                        color: '.$first_color.';
                    }
                    .middle_bot .title_box_big,
                    .styled_table table,
                    .minigallery_carousel li:hover a img{
                        border-color: '.$first_color.';
                    }
                    .widget_calendar #today,
                    .widget_calendar #today a,
                    .widget_tag_cloud .tagcloud a:hover{
                        background-color:'.$first_color.';
                    }
                    /* primary color - lighter */
                    a:hover, a:focus {
                        color: '.$first_color.';
                    }
                    .Highlighted a{
                        background-color : '.$first_color.' !important;
                        background-image :none !important;
                        color: White !important;
                        font-weight:bold !important;
                        font-size: 12pt;
                     }';
        }
        
        
        if(!empty($second_color))
        {
            echo '.ribbon-text {
                        -moz-box-shadow:inset 0px 0px 3px 2px '.$second_color.', 0px 2px 4px 1px rgba(0,0,0,0.9);
                        -webkit-box-shadow:inset 0px 0px 3px 2px '.$second_color.', 0px 2px 4px 1px rgba(0,0,0,0.9);
                        box-shadow:inset 0px 0px 3px 2px '.$second_color.', 0px 2px 4px 1px rgba(0,0,0,0.9);
                        background-color:'.$second_color.';
                        color: rgba(0,0,0,0.8);
                    }
                    .mark_event .icon {
                        color: '.$second_color.';
                    }
                    .ribbon-text:before, .ribbon-text:after {
                        border-color: rgba(0,0,0,0.8);
                    }
                    /* second color */
                    .topsearch button,
                    .title_box .subtitle a,
                    .title_box_big .subtitle a,
                    .title_box_big .subtitle strong,
                    .event_location,
                    .testimonials .quote-text a,
                    .breadcrumbs a,
                    .widget_twitter .tweet_item a,
                    .widget_contact address strong,
                    .widget_contact .info_row a:hover,
                    .widget_postlist ul li .post-title,
                    .f_col .widget_postlist .post-meta .link-comments:hover,
                    .f_col .widget_postlist ul li .post-title:hover,
                    .widget_login .forget_password a,
                    .postlist .post-meta,
                    .postlist .post-meta .link-comments,
                    .post-detail .post-meta,
                    .entry a,
                    .entry a.btn-link,
                    .ticket_descr strong,
                    .link-author,
                    a.link-author:hover,
                    .link-reply:hover,
                    .add-comment h3,
                    .body_wrap .top_player .song_title, .body_wrap .top_player .next_song_title,
                    .twitter li:before{
                        color: '.$second_color.';
                    }
                    .tabs_framed .tabs,
                    .widget_calendar table caption,
                    .widget_calendar table tfoot a{
                        background-color:'.$second_color.';
                    }
                    .carousel_slider .slider_caption strong {
                        border-color:'.$second_color.';
                    }
                    /* second color - lighter */
                    .carousel_slider .slider_caption em,
                    .copyright a,
                    .slider_quotes .prev,
                    .slider_quotes .next,
                    .f_col .quote-text a {
                        color: '.$second_color.';
                    }
                    .tabs_framed .nav-tabs li a,
                    .tabs_framed .tabs li a{
                        background-color:'.$second_color.';
                    }
                    .widget_calendar table tbody a {
                        background-color: '.$second_color.';
                    }
                    ';
        }
    }
endif;

if ( !function_exists('tfuse_change_header')):

    function tfuse_change_header() {
        $img = tfuse_options('header_img_ch');
        if(!empty($img))
        {
            echo 'style="background-image: url('.$img.')"';
        }
        else
        {
            echo 'style="background-image: url('.get_template_directory_uri().'/images/body_style_1_1920.jpg)"';
        }
    }
endif;

if ( !function_exists('tfuse_convert_date')):

    function tfuse_convert_date() {
        global $TFUSE;
        if($TFUSE->request->isset_GET('filter_date'))
        {
            $date = $TFUSE->request->GET('filter_date');
            
            $date_from = new DateTime($date);
            $year = $date_from->format('Y');
            $month = $date_from->format('m'); 
            $day = $date_from->format('d');
            echo  $year.'-'.$month.'-'.$day;
        }
    }
endif;

if ( !function_exists('tfuse_get_events_calendar')):

    function tfuse_get_events_calendar() {
        $dates = $ids = $date_echo = array();
    
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'event'
        );
        $all_posts = new WP_Query( $args );
        $posts = $all_posts->posts;
        
        if(!empty($posts))
        {
            foreach ($posts as $post) {
                $ids[] = $post->ID;
            }
            
            if(!empty($ids))
            {
                foreach ($ids as $id) {
                    $dates[] = $date_in = tfuse_page_options('date_from','',$id);
                }
                
                if(!empty($dates))
                {
                    foreach ($dates as $date) {
                        $date_from = new DateTime($date);
                        $year = $date_from->format('Y'); 
                        $month = $date_from->format('m'); 
                        $day = $date_from->format('d');
                        
                        $date_echo[] =  $year.'/'.$month.'/'.$day;
                    }
                }
            }
        }
        
        return $date_echo;
    }
endif;


if ( !function_exists('tfuse_search_term_name')):

    function tfuse_search_term_name() {
        global $TFUSE;
        $search_query = get_search_query();
        $term_name = '';
        $events = $TFUSE->request->GET('events');
        
        if(!empty($events) && $search_query == ' ') 
        {
            $term = get_term_by('slug',$events,'events');
            
            $term_name = $term->name;
        }
        
        return $term_name;
    }
endif;

add_filter("comment_id_fields","tfuse_my_submit_comment_message");
function tfuse_my_submit_comment_message($result){
    return $result.'<span class="icon comment-form-icon icon-plus-sign  "></span>
	<a onclick="document.getElementById(&#39;addcomments&#39;).reset();return false" href="#" class="link-reset">'. __('Reset all fields', 'tfuse').'</a>';
}

if(!function_exists('tfuse_update_reservation_forms'))
{
	function tfuse_update_reservation_forms()
	{
		$forms = get_terms( 'reservations', array(
			'orderby'    => 'count',
			'hide_empty' => 0
		) );

		$args = array(
			'0' =>  'text',
			'1' =>  'textarea',
			'2' =>  'radio',
			'3' =>  'checkbox',
			'4' =>  'select',
			'5' =>  'email',
			'6' =>  'captcha',
			'7' =>  'date_in',
			'8' =>  'date_out',
			'9' =>  'res_email',
		);

		foreach($forms as $form)
		{
			$check_option = get_option( 'tfuse_update_reservation_forms', 'none' );
			if($check_option == 'set')
			{
				return;
			}
			$description = unserialize($form->description);
			if(isset($description['version']) AND $description['version'] == '1.1')
				continue;

			foreach($description['input'] as $key => $input)
			{
				if(isset($args[$input['type']]))
					$input['type'] = $args[$input['type']];
				$description['input'][$key]['type'] = $input['type'];
			}
			$description['version'] = '1.1';
			wp_update_term($form->term_id, 'reservations', array('description' => serialize($description)));
			add_option('tfuse_update_reservation_forms', 'set');
		}
	}
	add_action('wp_head', 'tfuse_update_reservation_forms');
}


add_theme_support( 'automatic-feed-links' );


function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);