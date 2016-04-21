<?php

function tfuse_upcoming_events($atts, $content = null) {
    extract(shortcode_atts(array( 'item' => '','title' => '','category' => ''), $atts));
    $output = $count = ''; 
    
    if(!empty($category))
    {
        $term = get_term( $category, 'location');
    }
    
    $args = array(
                'posts_per_page' => -1,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'location',
                            'field' => 'id',
                            'terms' => $category
                        )
                )
        );
   $query = new WP_Query( $args );
   $posts = $query->posts;
   
   $today = date ('Y-m-d');

   if(!empty($posts))
   {
       foreach($posts as $post){
			
			$date_final = tfuse_page_options('date_final','',$post->ID);
			$date_from = tfuse_page_options('date_from','',$post->ID); 	
			
			if(!empty($date_final))
			{
				if($today <= $date_final)
					$date[$post->ID] = $date_final; 
			}
			else
			{
				if($today <= $date_from)	
					$date[$post->ID] = $date_from;
			}
       }
	   
       if(!empty($date))
       {
			arsort($date);
			foreach($date as $key => $post_date){ 
                if($count == (int)$item) break; $count++;
				$dates[$key] = $post_date;
			}
			if(!empty($dates))
			{
				asort($dates);
				$output .= '
					<div class="before_content divideline clearfix">
						<div class="title_box">
							<i class="icon icon-star"></i>
							<h2>'.$title.'</h2>
							<div class="subtitle"><a href="'.site_url( '?s=a&post_type=events&events=all-events' ).'">'.__('View all events','tfuse').'</a></div>
						</div>
					<div class="event_list clearfix">
						<ul>';
					foreach($dates as $key => $post_date){ 
					   $img = tfuse_page_options('thumbnail_image','',$key);
					   $output .='<li class="event_item">
							<div class="event_side">
								<div class="event_icon"><span class="icon '.tfuse_get_event_icon($key).'"></span></div>
								<div class="event_date">'.tfuse_get_event_date($key).'</div>
								<div class="event_price">'.__(' From','tfuse').' <strong>'.tfuse_page_options('ticket_price','',$key).'</strong></div>
							</div>
							<div class="event_descr">
								<div class="event_image"><a href="' . get_permalink( $key ) . '"><img src="' . TF_GET_IMAGE::get_src_link($img, 150, 150) . '" alt=""></a></div>
								<div class="event_location">'.tfuse_events_location($key,'location').'</div>
								<div class="event_title">
									<div class="inner">
									<h3>'.get_the_title($key).'</h3>
									<span>'.tfuse_page_options('short_desc','',$key).'</span>
									</div>
								</div>
								<div class="event_details">
									<a href="'.get_permalink( $key).'"><span class="icon icon-shopping-cart"></span> '.__(' BUY TICKETS','tfuse').'</a>
								</div>
							</div>
						</li>';
					}
			   $output .='
				   <li class="event_item not_event">
						<div class="title_box title_box_md title_right">
							<span class="icon icon-search"></span>
							<h3><a href="'.site_url( '?s=a&post_type=events&events=all-events' ).'">'.__('View All UPCOMING EVENTS','tfuse').'</a></h3>
							<div class="subtitle"><a href="'.site_url( '?s=a&post_type=events&events=all-events' ).'">'.__('or search for desired event','tfuse').'</a></div>
						</div>
					</li>
				   </ul></div></div>';
		   }
       }
   }
    return $output;
}

$atts = array(
    'name' => __('Upcoming Events','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 20,
    'options' => array(
        array(
            'name' => __('Select Category','tfuse'),
            'desc' => __('Select event category','tfuse'),
            'id' => 'tf_shc_upcoming_events_category',
            'value' => '',
             'options' => tfuse_list_events_locations(),
            'type' => 'select',
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_upcoming_events_item',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_upcoming_events_title',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('upcoming_events', 'tfuse_upcoming_events', $atts);
