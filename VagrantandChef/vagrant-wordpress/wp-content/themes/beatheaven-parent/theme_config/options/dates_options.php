<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    array(
        'name' => __('Content Background','tfuse'),
        'desc' => __('Select Content Background.','tfuse'),
        'id' => TF_THEME_PREFIX . '_middle_color',
        'value' => tfuse_options('middle_color'),
        'type' => 'colorpicker',
        'divider' => true
    ),
    array('name' => __('Title','tfuse'),
        'desc' => __('Category title','tfuse'),
        'id' => TF_THEME_PREFIX . '_date_title',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Icon class','tfuse'),
        'desc' => __('Category icon class (ex:icon-picture)','tfuse'),
        'id' => TF_THEME_PREFIX . '_icon_class',
        'value' => '',
        'type' => 'text'
    ),
    array(
        'name' => __('Enable Player','tfuse'),
        'desc' => __('Enable category player.','tfuse'),
        'id' => TF_THEME_PREFIX . '_palyer_enable',
        'value' => tfuse_options('enable_site_player'),
        'type' => 'checkbox',
        'divider' => true
    ),
    array(
        'name' => __('Enable Breadcrumbs','tfuse'),
        'desc' => __('Enable category breadcrumbs.','tfuse'),
        'id' => TF_THEME_PREFIX . '_breadcrumbs',
        'value' => tfuse_options('frame_breadcrumbs'),
        'type' => 'checkbox'
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
        'type' => 'select'
            ) :
            array(
        'name' => __('Slider','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
        'type' => 'raw',
                'divider'=>true
            ),
    
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
    
    array('name' => __('Shortcodes before Content', 'tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
   
);

?>