<?php
/**
 * Create custom posts types
 *
 * @since  Beatheaven 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
		        $labels = array(
                        'name' => __('Reservation', 'tfuse'),
                        'singular_name' => __('Reservation', 'tfuse'),
                        'add_new' => __('Add New', 'tfuse'),
                        'add_new_item' => __('Add New Reservation', 'tfuse'),
                        'edit_item' => __('Edit Reservation info', 'tfuse'),
                        'new_item' => __('New Reservation', 'tfuse'),
                        'all_items' => __('All Reservations', 'tfuse'),
                        'view_item' => __('View Reservation info', 'tfuse'),
                        'parent_item_colon' => ''
                );
                $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
                $res_args = array(
                                'labels' => $labels,
                                'public' => true,
                                'publicly_queryable' => false,
                                'show_ui' => false,
                                'query_var' => true,
                                'exclude_from_search'=>true,
                                //'menu_icon' => get_template_directory_uri() . '/images/icons/doctors.png',
                                'has_archive' => true,
                                'rewrite' => array('slug'=> $reservationform_rewrite),
                                'menu_position' => 6,
                                'supports' => array(null)
                        );
               register_taxonomy('reservations', array('reservations'), array(
                            'hierarchical' => true,
                            'labels' => array(
                                'name' => __('Reservation Forms', 'post type general name', 'tfuse'),
                                'singular_name' => __('Reservation Form', 'post type singular name', 'tfuse'),
                                'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                            ),
                            'show_ui' => false,
                            'query_var' => true,
                            'rewrite' => array('slug' => $reservationform_rewrite)
                        ));
                        register_post_type( 'reservations' , $res_args );
        
        // Promos
        $labels = array(
                'name' => __('Promos' ,'tfuse'),
                'singular_name' => __('Promo','tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Promo info', 'tfuse'),
                'new_item' => __('New Promo', 'tfuse'),
                'all_items' => __('All Promos', 'tfuse'),
                'view_item' => __('View Promo info', 'tfuse'),
                'search_items' => __('Search Promo', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $promolist_rewrite = apply_filters('tfuse_promolist_rewrite','all-promo-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $promolist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $promolist_taxonomy_rewrite = apply_filters('tfuse_promolist_taxonomy_rewrite','promo-list');
        register_taxonomy('promos', array('promo'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $promolist_taxonomy_rewrite)
        ));
        register_post_type( 'promo' , $args );
        
         // Events
        $labels = array(
                'name' => __('Events', 'tfuse'),
                'singular_name' => __('Event', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Resource', 'tfuse'),
                'edit_item' => __('Edit Events info', 'tfuse'),
                'new_item' => __('New Event', 'tfuse'),
                'all_items' => __('All Events', 'tfuse'),
                'view_item' => __('View Event info', 'tfuse'),
                'search_items' => __('Search Events', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $eventlist_rewrite = apply_filters('tfuse_eventlist_rewrite','all-event-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $eventlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $eventlist_taxonomy_rewrite = apply_filters('tfuse_eventlist_taxonomy_rewrite','event-list');
        register_taxonomy('events', array('event'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $eventlist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag', 'tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tag','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
            $reviewlist_taxonomy_tags_rewrite = apply_filters('tfuse_reviewlist_taxonomy_tags_rewrite','tag-list'); 
		
            register_taxonomy('tags', 'event', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $reviewlist_taxonomy_tags_rewrite)
            ));    
        
        $labels = array(
            'name' => __('Locations', 'tfuse'),
            'singular_name' => __('Location', 'tfuse'),
            'search_items' => __('Search Locations','tfuse'),
            'all_items' => __('All Locations','tfuse'),
            'parent_item' => __('Parent Location','tfuse'),
            'parent_item_colon' => __('Parent Location:','tfuse'),
            'edit_item' => __('Edit Location','tfuse'),
            'update_item' => __('Update Location','tfuse'),
            'add_new_item' => __('Add New Location','tfuse'),
            'new_item_name' => __('New Location Name','tfuse')
        );
        
        $locationlist_taxonomy_rewrite = apply_filters('tfuse_locationlist_taxonomy_rewrite','location-list');
        register_taxonomy('location', array('event'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $locationlist_taxonomy_rewrite)
        ));
            

        register_post_type( 'event' , $args );
        
        // Album
        $labels = array(
                'name' => __('Albums', 'tfuse'),
                'singular_name' => __('Album', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Album', 'tfuse'),
                'edit_item' => __('Edit Album info', 'tfuse'),
                'new_item' => __('New Album', 'tfuse'),
                'all_items' => __('All Albums', 'tfuse'),
                'view_item' => __('View Album info', 'tfuse'),
                'search_items' => __('Search Album', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $albumlist_rewrite = apply_filters('tfuse_albumlist_rewrite','all-album-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $albumlist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category','tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $albumlist_taxonomy_rewrite = apply_filters('tfuse_albumlist_taxonomy_rewrite','album-list');
        register_taxonomy('albums', array('album'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $albumlist_taxonomy_rewrite)
        ));
       

        register_post_type( 'album' , $args );
        
        // Marchandise
        $labels = array(
                'name' => __('Products', 'tfuse'),
                'singular_name' => __('Product','tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Product', 'tfuse'),
                'edit_item' => __('Edit Product info', 'tfuse'),
                'new_item' => __('New Product', 'tfuse'),
                'all_items' => __('All Products', 'tfuse'),
                'view_item' => __('View Product info', 'tfuse'),
                'search_items' => __('Search Product', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $productlist_rewrite = apply_filters('tfuse_productlist_rewrite','all-product-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $productlist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $productlist_taxonomy_rewrite = apply_filters('tfuse_productlist_taxonomy_rewrite','product-list');
        register_taxonomy('products', array('product'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $productlist_taxonomy_rewrite)
        ));
       

        register_post_type( 'product' , $args );
        
        // Tour Dates
        $labels = array(
                'name' => __('Tour Dates', 'tfuse'),
                'singular_name' => __('Tour Date', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Tour Date', 'tfuse'),
                'edit_item' => __('Edit Tour Date info', 'tfuse'),
                'new_item' => __('New Tour Date', 'tfuse'),
                'all_items' => __('All Tour Dates', 'tfuse'),
                'view_item' => __('View Tour Date info', 'tfuse'),
                'search_items' => __('Search Tour Date', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $datelist_rewrite = apply_filters('tfuse_datelist_rewrite','all-date-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $datelist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories','tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $datelist_taxonomy_rewrite = apply_filters('tfuse_datelist_taxonomy_rewrite','date-list');
        register_taxonomy('dates', array('date'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $datelist_taxonomy_rewrite)
        ));
       

        register_post_type( 'date' , $args );
        // TESTIMONIALS
        $labels = array(
                'name' => __('Testimonials', 'tfuse'),
                'singular_name' => __('Testimonial','tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'testimonials' , $args );

    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}
