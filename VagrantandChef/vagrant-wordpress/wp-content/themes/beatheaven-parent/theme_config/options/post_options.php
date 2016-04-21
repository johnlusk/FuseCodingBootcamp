<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

    /* Single Post */
    array('name' => __('Single Post','tfuse'),
        'id' => TF_THEME_PREFIX . '_side_media',
        'type' => 'metabox',
        'context' => 'side',
        'priority' => 'low' /* high/low */
    ),
    // Disable Single Post Image
    array('name' => __('Enable Image','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_image',
        'value' => tfuse_options('disable_image','true'),
        'type' => 'checkbox'
        ),
    // Disable Single Post Video
    array('name' => __('Enable Video','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_video',
        'value' => tfuse_options('disable_video','true'),
        'type' => 'checkbox',
        'divider' => true
    ),
     // Post Meta
    array('name' => __('Enable Meta','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_post_meta',
        'value' => tfuse_options('disable_post_meta','true'),
        'type' => 'checkbox'
    ),
    // Published Date
    array('name' => __('Enable Published Date','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_published_date',
        'value' => tfuse_options('disable_published_date','true'),
        'type' => 'checkbox'
    ),
    // Published Date
    array('name' => __('Enable Comments','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_comments',
        'value' => tfuse_options('disable_posts_comments','true'),
        'type' => 'checkbox' 
    ),
    // Author Info
    array('name' => __('Enable Author Info','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_author_info',
        'value' => tfuse_options('disable_author_info','true'),
        'type' => 'checkbox'
    ),
     // Post Title
    array('name' => __('Post Title','tfuse'),
        'desc' => __('Select your preferred Post Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_page_title',
        'value' => 'default_title',
        'options' => array('hide_title' => __('Hide Post Title','tfuse'), 'default_title' => __('Default Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
        'type' => 'select'
    ),
    // Custom Title
    array('name' => __('Custom Title','tfuse'),
        'desc' => __('Enter your custom title for this post.','tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_title',
        'value' => '',
        'type' => 'text'
    ),
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Media */
    array('name' => __('Media','tfuse'),
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Single Image
    array('name' => __('Image','tfuse'),
        'desc' => __('This is the main image for your post. Upload one from your computer, or specify an online address for your image (Ex: http://yoursite.com/image.png).','tfuse'),
        'id' => TF_THEME_PREFIX . '_single_image',
        'value' => '',
        'type' => 'upload',
        'hidden_children' => array(
            TF_THEME_PREFIX . '_single_img_dimensions',
            TF_THEME_PREFIX . '_single_img_position'
        )
    ),
    // Single Image Dimensions
    array('name' => __('Image Resize (px)','tfuse'),
        'desc' => __('These are the default width and height values. If you want to resize the image change the values with your own. If you input only one, the image will get resized with constrained proportions based on the one you specified.','tfuse'),
        'id' => TF_THEME_PREFIX . '_single_img_dimensions',
        'value' => tfuse_options('single_image_dimensions'),
        'type' => 'textarray'
    ),
    // Single Image Position
    array('name' => __('Image Position','tfuse'),
        'desc' => __('Select your preferred image  alignment','tfuse'),
        'id' => TF_THEME_PREFIX . '_single_img_position',
        'value' => tfuse_options('single_image_position'),
        'options' => array(
            '' => array($url . 'full_width.png', __('Don\'t apply an alignment','tfuse')),
            'alignleft' => array($url . 'left_off.png', __('Align to the left','tfuse')),
            'alignright' => array($url . 'right_off.png', __('Align to the right','tfuse'))
            ),
        'type' => 'images',
        'divider' => true
    ),    
     // Thumbnail Image
    array('name' => __('Thumbnail','tfuse'),
        'desc' => __('This is the thumbnail for your post. Upload one from your computer, or specify an online address for your image (Ex: http://yoursite.com/image.png).','tfuse'),
        'id' => TF_THEME_PREFIX . '_thumbnail_image',
        'value' => '',
        'type' => 'upload',
        'hidden_children' => array(
            TF_THEME_PREFIX . '_thumbnail_dimensions',
            TF_THEME_PREFIX . '_thumbnail_position'
        )
    ),
    // Posts Thumbnail Dimensions
    array('name' => __('Thumbnail Dimension (px)','tfuse'),
        'desc' => __('These are the default width and height values. If you want to resize the thumbnail change the values with your own. If you input only one, the thumbnail will get resized with constrained proportions based on the one you specified.','tfuse'),
        'id' => TF_THEME_PREFIX . '_thumbnail_dimensions',
        'value' => tfuse_options('thumbnail_dimensions'),
        'type' => 'textarray'
    ),
    // Thumbnail Position
    array('name' => __('Thumbnail Position','tfuse'),
        'desc' => __('Select your preferred thumbnail alignment','tfuse'),
        'id' => TF_THEME_PREFIX . '_thumbnail_position',
        'value' => tfuse_options('thumbnail_position'),
        'options' => array(
            'noalign' => array($url . 'full_width.png', __('Don\'t apply an alignment','tfuse')),
            'alignleft' => array($url . 'left_off.png', __('Align to the left','tfuse')),
            'alignright' => array($url . 'right_off.png', __('Align to the right','tfuse'))
        ),
        'type' => 'images',
        'divider' => true
    ),
    // Custom Post Video
    array('name' => __('Video','tfuse'),
        'desc' => __('Copy paste the video URL or embed code. The video URL works only for Vimeo and YouTube videos. Read ','tfuse').'<a target="_blank" href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">'.__('prettyPhoto documentation','tfuse').'</a>
                    for more info on how to add video or flash in this text area
                    ',
        'id' => TF_THEME_PREFIX . '_video_links',
        'value' => '',
        'type' => 'textarea',
        'hidden_children' => array(
            TF_THEME_PREFIX . '_video_dimensions',
            TF_THEME_PREFIX . '_video_position'
        )
    ),
    // Video Dimensions
    array('name' => __('Video Size (px)','tfuse'),
        'desc' => __('These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.','tfuse'),
        'id' => TF_THEME_PREFIX . '_video_dimensions',
        'value' => tfuse_options('video_dimensions'),
        'type' => 'textarray'
    ),
    // Video Position
    array('name' => __('Video Position','tfuse'),
        'desc' => __('Select your preferred video alignment','tfuse'),
        'id' => TF_THEME_PREFIX . '_video_position',
        'value' => tfuse_options('video_position'),
        'options' => array(
            '' => array($url . 'full_width.png', __('Don\'t apply an alignment','tfuse')),
            'alignleft' => array($url . 'left_off.png', __('Align to the left','tfuse')),
            'alignright' => array($url . 'right_off.png', __('Align to the right','tfuse'))
            ),
        'type' => 'images'
    ),   
    /* Header Options */
    array('name' => __('Header','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Element of Hedear
    array('name' => __('Element of Hedear','tfuse'),
        'desc' => __('Select type of element on the header.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_element',
        'value' => 'without',
        'options' => array('without' => __('Without Header Element','tfuse'),'slider' => __('Slider on Header','tfuse')),
        'type' => 'select',
    ),
    // Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => __('Slider','tfuse'),
        'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('carousel','play','showcase')),
        'type' => 'select',
		'divider'=>true
            ) :
            array(
        'name' => __('Slider','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
        'type' => 'raw'
            ) ,
    
   array('name' => __('Select Header Bottom','tfuse'),
            'desc' => __('Select your preferred  header bottom option.','tfuse'),
            'id' => TF_THEME_PREFIX . '_header_bottom',
            'value' => '',
            'options' => array('without' => __('Without Header Bottom Element','tfuse'),'title_slider' => __('Title & Slider','tfuse'),'title_img' => __('Title & Image','tfuse'),'title_img2' => __('Title & Image','tfuse'),'shortcode' => __('Title & Shortcode','tfuse')),
            'type' => 'select',
        ),
    array('name' => __('Title','tfuse'),
        'desc' => __('Give a title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_bottom_title',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Title Icon','tfuse'),
        'desc' => __('Title icon class.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_bottom_icon',
        'value' => '',
        'type' => 'text'
    ),
     array('name' => __('Description','tfuse'),
        'desc' => __('Short Description.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_bottom_desc',
        'value' => '',
        'type' => 'text'
    ),
    // Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => __('Slider','tfuse'),
        'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
        'id' => TF_THEME_PREFIX . '_select_bottom_slider',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown('simple'),
        'type' => 'select'
            ) :
            array(
        'name' => __('Slider','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_bottom_slider',
        'value' => '',
        'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
        'type' => 'raw'
            ) ,
    array('name' => __('Image','tfuse'),
        'desc' => __('Upload image.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_bottom_img',
        'value' => '',
        'type' => 'upload'
    ),
    array('name' => __('Shortcodes','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_bottom_shortcode',
        'value' => '',
        'type' => 'textarea',
        'divider'=>true
    ),
    
    array('name' => __('Select Footer Top','tfuse'),
            'desc' => __('Select footer top map option.','tfuse'),
            'id' => TF_THEME_PREFIX . '_footer_top',
            'value' => 'without',
            'options' => array('without' => __('Without Footer Top Element','tfuse'),'slider' => __('Slider','tfuse')),
            'type' => 'select',
        ),// Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => __('Slider','tfuse'),
        'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
        'id' => TF_THEME_PREFIX . '_select_footer_slider',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown('album'),
        'type' => 'select'
            ) :
            array(
        'name' => __('Slider','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_footer_slider',
        'value' => '',
        'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
        'type' => 'raw'
            ) ,
    
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array(
        'name' => __('Content Background','tfuse'),
        'desc' => __('Select Content Background.','tfuse'),
        'id' => TF_THEME_PREFIX . '_middle_color',
        'value' => tfuse_options('middle_color'),
        'type' => 'colorpicker',
        'divider' => true
    ),
    array(
        'name' => __('Enable Player','tfuse'),
        'desc' => __('Enable post player.','tfuse'),
        'id' => TF_THEME_PREFIX . '_palyer_enable',
        'value' => tfuse_options('enable_site_player'),
        'type' => 'checkbox',
        'divider' => true
    ),
    array(
        'name' => __('Enable Breadcrumbs','tfuse'),
        'desc' => __('Enable page breadcrumbs.','tfuse'),
        'id' => TF_THEME_PREFIX . '_breadcrumbs',
        'value' => tfuse_options('frame_breadcrumbs'),
        'type' => 'checkbox',
        'divider' => true
    ),
    array('name' => __('Shortcodes before Content', 'tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
);

?>