<?php

/*---------------------------------------------------------------------------------*/
/*  Facebook Widget */
/*---------------------------------------------------------------------------------*/
/**
 * @author ThemeFuse
 * @since 1.0.0
 */

class TFuse_facebook extends WP_Widget {
    /**
     * @author ThemeFuse
     * @since 1.0.0
     */

    function TFuse_facebook() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Facebook', 'tfuse'),$widget_ops);
    }
    /**
     * @author ThemeFuse
     * @since 1.0.0
     */

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $facebook_id = $instance['facebook_id'].'<br><br>';
        $before_title = '<h3 class="widget-title"><span class="icon icon-facebook-sign"></span>';
        $after_title = '</h3>';
        $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';
        
       echo '<div class="widget-container widget_fb_acivity">
                    '.$tfuse_title.'
                    <div class="fb_activity">
                        '.$facebook_id.'
                    </div>
                </div>';
    }
    /**
     * @author ThemeFuse
     * @since 1.0.0
     */

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'','facebook_id'=>'') );
        $instance['facebook_id']      = $new_instance['facebook_id'];
        $instance['title']      = $new_instance['title'];
        return $instance;
    }
    /**
     * @author ThemeFuse
     * @since 1.0.0
     */

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'facebook_id' => '','title'=>'') );
        $facebook_id = $instance['facebook_id'];
        $title = $instance['title'];
        ?>
<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Facebook Social Plugins:','tfuse'); ?> (<a href="http://developers.facebook.com/docs/plugins/"><?php _e('Social Plugins:','tfuse'); ?></a>):</label>
        <textarea name="<?php echo $this->get_field_name('facebook_id'); ?>" class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>"><?php echo $facebook_id; ?></textarea>
    </p>
    <?php
    }
}
register_widget('TFuse_facebook');

?>