<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php
    if(tfuse_options('disable_tfuse_seo_tab')) {
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
    } else
        wp_title('');?>
    </title>
    <?php tfuse_meta(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php
        global $is_tf_blog_page;
        if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );

        tfuse_head();
        wp_head();
    ?>
    <style type="text/css">
        <?php tfuse_change_style();?>
    </style>
</head>
<body <?php body_class();?>>
    <div class="body_wrap" <?php tfuse_change_header();?>>
        <div class="header">
            <div class="container">
                <?php tfuse_type_logo();?>
                <div class="head_menu">
                    <div class="topsearch">
                        <form id="searchForm" action="<?php echo home_url( '/' ) ?>" method="get">
                            <label for="stext"><?php _e('SEARCH','tfuse');?></label>
                            <button type="submit" id="searchSubmit" class="btn-search"><span class="icon icon-search"></span></button>
                            <input type="text" name="s" id="stext" value="" class="stext">
                        </form>
                    </div>
                    <div class="login_links">
                        <a href="<?php echo wp_registration_url();?>" class="sign-up"><?php _e('Sign-up','tfuse');?></a> <span class="separator">|</span>
                        <a href="<?php echo wp_login_url();?>"><?php _e('Login','tfuse');?></a> <span class="separator">|</span>
                    </div>
                </div>
            </div>   
        </div>
        <div class="container mainblock">
            <nav class="topmenu">
                <?php  tfuse_menu('default'); ?>
            </nav>     
<?php  tfuse_header_content('header');?>
<?php if($is_tf_blog_page) tfuse_category_on_blog_page();?>

