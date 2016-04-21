<?php
class TFuse_Widget_Map extends WP_Widget {

	function TFuse_Widget_Map() {
		$widget_ops = array('classname' => 'widget_map' );
		$this->WP_Widget('map', __('TFuse Map','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
                $uniq = rand(1,100);
		$title = $instance['title'];
		$before_widget = ' <div class="widget-container widget_contact">';
		$before_title = '<h3 class="widget-title"><span class="icon icon-building"></span>';
                $after_title = '</h3>';
		$after_widget = '</div>';
                $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';

		echo $before_widget;
                echo $tfuse_title;
                if(!empty($instance['adress']))
                {
                    ?>
                    <address>
                        <?php echo $instance['adress'];?>
                    </adress>
              <?php  }
                global $post;
                if($post->post_type == "event")
                {
                    $lat = tfuse_page_options("event_latitude",'',$post->ID);
                    $long = tfuse_page_options("event_longitude",'',$post->ID);
                }
                if (!empty($lat) && !empty($long))
                {
 
                    ?>                  <div class="sidebar_map">
                    <div id="map<?php echo $uniq;?>" class="map sortcode"></div>
                    <script>
                        var $j = jQuery.noConflict();
                        $j(window).load(function(){
                            $j("#map<?php echo $uniq;?>").gMap({
                                markers: [{
                                    latitude: <?php echo $lat;?>,
                                    longitude: <?php echo $long;?>}],
                                zoom: 12,
                                mapTypeControl: false
                            });
                        });
                    </script>
                </div>
                <?php
 
                }elseif(!empty($instance['latitude']) || !empty($instance['longitude']))
                {
?>                  <div class="sidebar_map">
                        <div id="map<?php echo $uniq;?>" class="map sortcode"></div>
                        <script>
                            var $j = jQuery.noConflict();
                            $j(window).load(function(){
                                $j("#map<?php echo $uniq;?>").gMap({
                                    markers: [{
                                        latitude: <?php echo $instance['latitude'];?>,
                                        longitude: <?php echo $instance['longitude'];?>}],
                                    zoom: 12,
                                    mapTypeControl: false
                                });
                            });
                        </script>
                    </div>
<?php
                }
                
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
                $instance['adress'] = $new_instance['adress'];
                $instance['longitude'] = $new_instance['longitude'];
                $instance['latitude'] = $new_instance['latitude'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'longitude' => '','latitude' => '','adress' => '' ) );
		$title = $instance['title'];
                $longitude = $instance['longitude'];
                $latitude = $instance['latitude'];
                $adress = $instance['adress'];

?>   <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    
        <p><label for="<?php echo $this->get_field_id('latitude'); ?>"><?php _e('Latitude:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('latitude'); ?>" name="<?php echo $this->get_field_name('latitude'); ?>" type="text" value="<?php echo esc_attr($latitude); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('longitude'); ?>"><?php _e('Longitude:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('longitude'); ?>" name="<?php echo $this->get_field_name('longitude'); ?>" type="text" value="<?php echo esc_attr($longitude); ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('adress'); ?>"><?php _e('Address:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('adress'); ?>" type="text" value="<?php echo esc_attr($adress); ?>" /></p>

    <?php
	}
}

function TFuse_Unregister_WP_Widget_Map() {
	unregister_widget('WP_Widget_Map');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Map');

register_widget('TFuse_Widget_Map');
