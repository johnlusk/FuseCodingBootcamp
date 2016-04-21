<?php
class TFuse_Widget_Testimonial extends WP_Widget {

    function TFuse_Widget_Testimonial()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display and rotate your testimonials","tfuse"));
        $this->WP_Widget('testimonial', __('TFuse - Testimonial','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
		$testimonials_uniq = rand(1, 300);
        $title = apply_filters( 'widget_title',  empty($instance['title']) ? __('Testimonial','tfuse') : $instance['title'], $instance, $this->id_base);
        $item = $instance['item'];

        $slide = $nav = $single = '';
        query_posts('post_type=testimonials&posts_per_page=-1&order=ASC');
        $k = 0;
        if (have_posts()) {
        while (have_posts()) {
           if($k == $item) break; 
            $k++;
            the_post();
            $positions = '';
            $terms = get_the_terms(get_the_ID(), 'testimonials');
                
            if (!is_wp_error($terms) && !empty($terms))
                foreach ($terms as $term)
                    $positions .= ', ' . $term->name;
            $slide .= '
                <div class="slider-item">
                    <div class="quote-text">
                        '.get_the_excerpt() . '
                    </div>
                        <div class="quote-author">
                            ' . get_the_title() . '
                        </div>
                    
                </div>
        ';
        } // End WHILE Loop
    } // End IF Statement
    wp_reset_query();

    $output = '
     <div class="widget-container slider slider_quotes">
     <h3 class="widget-title"><span class="icon icon-quote-left"></span>'.$title.'</h3>
      <div class="slider_container clearfix" id="testimonials'.$testimonials_uniq.'">
        ' . $slide . '
    </div>
    <a class="prev" id="testimonials'.$testimonials_uniq.'_prev" href="#"><span class="icon icon-chevron-left"></span></a>
    <a class="next" id="testimonials'.$testimonials_uniq.'_next" href="#"><span class="icon icon-chevron-right"></span></a>
    </div>
<script>
              jQuery(document).ready(function($) {
                        jQuery("#testimonials'.$testimonials_uniq.'").carouFredSel({
                            next : "#testimonials'.$testimonials_uniq.'_next",
                            prev : "#testimonials'.$testimonials_uniq.'_prev",
                            width: "100%",
                            responsive: true,
                            infinite: false,
                            items: 1,
                            auto: false,
                            scroll: {
                                items : 1,
                                fx: "crossfade",
                                easing: "linear",
                                pauseOnHover: true,
                                duration: 300
                            }
                        });
                    });
            </script>  ';

    echo $output;

    }
    function update($new_instance, $old_instance)
    { $instance = $old_instance;
        $instance['item'] = $new_instance['item'];
        $instance['title'] = $new_instance['title'];
        return $instance;

    } // End function update

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'item' => '') );
        $title = $instance['title'];
        $item = $instance['item'];

        ?>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
      <p><label for="<?php echo $this->get_field_id('item'); ?>"><?php _e('Items:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('item'); ?>" name="<?php echo $this->get_field_name('item'); ?>" type="text" value="<?php echo esc_attr($item); ?>" /></p>
          
         <?php
       }

}
register_widget('TFuse_Widget_Testimonial'); ?>
