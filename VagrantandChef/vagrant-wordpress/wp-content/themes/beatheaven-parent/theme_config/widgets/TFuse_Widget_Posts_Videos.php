<?php
class TFuse_Widget_Posts_Videos extends WP_Widget {

	function TFuse_Widget_Posts_Videos() {
		$widget_ops = array('classname' => 'widget_posts_videos' );
		$this->WP_Widget('gallery', __('TFuse Posts_Videos','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
                $uniq = rand(1,100);
                $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
                $posts = isset($instance['posts']) ? $instance['posts'] : array();
                $before_widget = '<div class="widget-container widget_carousel">';
                $after_widget = '</div>';
                $before_title = '<h3 class="widget-title"><span class="icon icon-film"></span>';
                $after_title = '</h3>';
                $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';
                 echo $before_widget;
                // echo widgets title
                echo $tfuse_title;
		echo '
                    <div class="sidebar_carousel">
                        <ul class="carousel_content" id="side_carousel'.$uniq.'">';
                            foreach ($posts as $key => $post)
                            {
                                echo '<li class="carousel_item">
                                        <a href="'.  tfuse_page_options('video_links','',$key).'" data-rel="prettyPhoto[vg_1]">
                                            <img src="' . TF_GET_IMAGE::get_src_link(tfuse_page_options('thumbnail_image','',$key), 220, 92) . '" alt="">
                                        </a>
                                    </li>';
                            }
                echo ' </ul>
                        <a class="prev" id="side_carousel'.$uniq.'_prev" href="#"></a>
                        <a class="next" id="side_carousel'.$uniq.'_next" href="#"></a>
                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                        jQuery("#side_carousel'.$uniq.'").carouFredSel({
                            next : "#side_carousel'.$uniq.'_next",
                            prev : "#side_carousel'.$uniq.'_prev",
                            direction: "up",
                            auto: false,
                            height: "100%",
                            infinite: true,
                            circular: false,
                            scroll: {
                                items : 1
                            }
                        });
                    });
                    </script>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance) {
            $instance = $old_instance;
            $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'posts' => '') );
            $instance['title']      = $new_instance['title'];
            $instance['posts']      = $new_instance['posts'];
                return $new_instance;
            }

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'posts' => '' ) );
                $title = $instance['title'];
                $posts = tfuse_list_posts();
?>
<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
		 <label for="<?php echo $this->get_field_id('pages'); ?>"><?php _e('Select Posts','tfuse'); ?></label>
                <br />
            <?php  
			foreach ($posts as $post) {  ?>
                <br/>
                        <?php
                        if ( esc_attr(@$instance['posts'][$post]) ) $checked = ' checked="checked" '; else $checked = '';
			?>
                            <input <?php echo $checked; ?> type="checkbox" name="<?php   echo $this->get_field_name('posts') ?>[<?php echo $post;?>]" value="1" id="<?php echo $this->get_field_id('posts'); ?>" />&nbsp;&nbsp;<?php echo get_the_title($post); ?>
                        <?php
 			}
                    ?>
    <?php
	}
}


register_widget('TFuse_Widget_Posts_Videos');
