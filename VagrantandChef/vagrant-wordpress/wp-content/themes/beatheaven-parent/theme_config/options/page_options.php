<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for pages area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

    /* Single Page */
    array('name' => __('Single Page','tfuse'),
        'id' => TF_THEME_PREFIX . '_side_media',
        'type' => 'metabox',
        'context' => 'side',
        'priority' => 'low' /* high/low */
    ),
    // Disable Page Comments
    array('name' => __('Enable Comments','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_comments',
        'value' => tfuse_options('disable_page_comments','true'),
        'type' => 'checkbox',
        'divider' => true
    ),
    // Page Title
    array('name' => __('Page Title','tfuse'),
        'desc' => __('Select your preferred Page Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_page_title',
        'value' => 'default_title',
        'options' => array('hide_title' => __('Hide Page Title','tfuse'), 'default_title' => __('Default Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
        'type' => 'select'
    ),
    // Custom Title
    array('name' => __('Custom Title','tfuse'),
        'desc' => __('Enter your custom title for this page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_title',
        'value' => '',
        'type' => 'text'
    ),
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

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
        'desc' => __('Enable page player.','tfuse'),
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

/* * *********************************************************
  Advanced
 * ********************************************************** */
?>