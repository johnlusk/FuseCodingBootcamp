<?php
// =============================== Recent Posts Widget ======================================

class TFuse_Popular_Posts extends WP_Widget {

    function TFuse_Popular_Posts() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Popular Posts', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts','tfuse') : $instance['title'], $instance, $this->id_base);
        $number = esc_attr($instance['number']);
        if ($number>0) {} else $number = 8;
    ?>

    <div class="widget-container widget_postlist widget_popular_posts">
        <h3 class="widget-title"><span class="icon icon-star-empty"></span> <?php echo tfuse_qtranslate($title); ?></h3>
        <ul>
            <?php
            $pop_posts =  tfuse_shortcode_posts(array(
                                'sort' => 'popular',
                                'items' => $number,
                                'image_post' => false
                            ));

            foreach($pop_posts as $post_val):?>
                <li class="clearfix">
                    <a href="<?php echo $post_val['post_link']; ?>" class="post-title"><?php echo $post_val['post_title']; ?></a>
                    <div class="post-meta">
                        <span class="post-date"><?php _e('posted ','tfuse'); ?><?php tfuse_time_ago($post_val['post_date_post']);?></span> 
                        <?php echo $post_val['post_comnt_numb_link'];?>
                    </div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>

    <?php
    }

   function update($new_instance, $old_instance) {
       return $new_instance;
   }

   function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(  'title' => '', 'number' => '') );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = esc_attr($instance['number']);
        ?>
       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
       <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>

    <?php
    }
}
    function TFuse_Unregister_WP_Widget_Popular_Posts() {
            unregister_widget('WP_Widget_Popular_Posts');
    }
add_action('widgets_init','TFuse_Unregister_WP_Widget_Popular_Posts');

register_widget('TFuse_Popular_Posts');
