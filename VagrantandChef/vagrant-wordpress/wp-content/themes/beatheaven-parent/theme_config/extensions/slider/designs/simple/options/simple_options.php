<?php
/**
 * Play slider's configurations
 *
 * @since Beatheaven 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings', 'tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings', 'tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title', 'tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)', 'tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Title icon', 'tfuse'),
                            'desc' => __('Icon class (ex: icon-music)', 'tfuse'),
                            'id' => 'slider_icon',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Slider Description', 'tfuse'),
                            'desc' => __('Slider short description', 'tfuse'),
                            'id' => 'slider_description',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Resize images?', 'tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?', 'tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides', 'tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        array('name' => __('Type','tfuse'),
                            'desc' => __('Select  type.','tfuse'),
                            'id' => 'slide_featured',
                            'value' => 'none',
                            'options' => array('none'=>'Simple','featured' => __('Fetaured','tfuse'),'latest' => __('Latest','tfuse')),
                            'type' => 'select',
                            'divider' =>true
                        ),
                        array('name' => __('URL', 'tfuse'),
                            'desc' => __('When a user will click the image, the browser will load this URL.', 'tfuse'),
                            'id' => 'slide_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Image <br />(550px × 320px)', 'tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.', 'tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => TRUE)
                    )
                )
            )
        ),
        array(
            'name' => __('Category Setup', 'tfuse'),
            'id' => 'slider_type_categories',
            'headings' => array(
                array(
                    'name' => __('Category options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Slider From:', 'tfuse'),
                            'desc' => __('Select slider post type', 'tfuse'),
                            'id' => 'sliders_posts_types',
                            'value' => 'events',
                            'options'=> array('events'=>'Events','albums'=>'Albums','products'=>'Products'),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific Event Categories', 'tfuse'),
                            'desc' => __('Pick one or more event categories','tfuse'),
                            'id' => 'posts_select_events',
                            'type' => 'multi',
                            'subtype' => 'events'
                        ),
                        array(
                            'name' => __('Select specific Album Categories', 'tfuse'),
                            'desc' => __('Pick one or more album categories','tfuse'),
                            'id' => 'posts_select_albums',
                            'type' => 'multi',
                            'subtype' => 'albums'
                        ),
                        array(
                            'name' => __('Select specific Product categories', 'tfuse'),
                            'desc' => __('Pick one or more product categories','tfuse'),
                            'id' => 'posts_select_products',
                            'type' => 'multi',
                            'subtype' => 'products'
                        ),
                        array(
                            'name' => __('Number of images in the slider', 'tfuse'),
                            'desc' => __('How many images do you want in the slider?', 'tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Posts Setup', 'tfuse'),
            'id' => 'slider_type_posts',
            'headings' => array(
                array(
                    'name' => __('Posts options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Slider From:', 'tfuse'),
                            'desc' => __('Select slider post type', 'tfuse'),
                            'id' => 'sliders_posts_type',
                            'value' => 'event',
                            'options'=> array('event'=>'Events','album'=>'Albums','product'=>'Products'),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
                                            you selected.',
                            'id' => 'posts_select_event',
                            'type' => 'multi',
                            'subtype' => 'event'
                        ),
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
                                            you selected.',
                            'id' => 'posts_select_album',
                            'type' => 'multi',
                            'subtype' => 'album'
                        ),
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
                                            you selected.',
                            'id' => 'posts_select_product',
                            'type' => 'multi',
                            'subtype' => 'product'
                        ),
                        array(
                            'name' => __('Number of images in the slider', 'tfuse'),
                            'desc' => __('How many images do you want in the slider?', 'tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();
?>