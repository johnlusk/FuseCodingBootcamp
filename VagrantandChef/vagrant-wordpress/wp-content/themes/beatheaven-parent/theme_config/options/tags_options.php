<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    array('name' => __('Thumbnail','tfuse'),
        'desc' => __('Upload category thumbnail (220x200).','tfuse'),
        'id' => TF_THEME_PREFIX . '_tags_thumbnail',
        'value' => '',
        'type' => 'upload'
    ),
    array(
        'name' => __('Content Background','tfuse'),
        'desc' => __('Select Content Background.','tfuse'),
        'id' => TF_THEME_PREFIX . '_middle_color',
        'value' => tfuse_options('middle_color'),
        'type' => 'colorpicker',
        'divider' => true
    ),
   
);

?>