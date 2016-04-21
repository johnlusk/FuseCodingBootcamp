<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {
        
        wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.css', false, '') );
        wp_enqueue_style( 'bootstrap' );
        
        wp_register_style( 'style', get_stylesheet_uri());
        wp_enqueue_style( 'style' );
		
		wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Pathway+Gothic+One|Source+Sans+Pro:400,400italic,600,600italic,700');
		wp_enqueue_style( 'fonts' );
        
        wp_register_style( 'screen', tfuse_get_file_uri('/screen.css'));
        wp_enqueue_style( 'screen' );

        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'jquery-ui-1.10.3.custom',  tfuse_get_file_uri('/css/beat-theme/jquery-ui-1.10.3.custom.css', false, '') );
        wp_enqueue_style( 'jquery-ui-1.10.3.custom' );
        
        wp_register_style( 'aw-showcase',  tfuse_get_file_uri('/css/aw-showcase.css', false, '') );
        wp_enqueue_style( 'aw-showcase' );
        
        wp_register_style( 'cusel',  tfuse_get_file_uri('/css/cusel.css', false, '') );
        wp_enqueue_style( 'cusel' );
        
        wp_register_style( 'jplayer',  tfuse_get_file_uri('/css/jplayer.css', false, '') );
        wp_enqueue_style( 'jplayer' );
        
        wp_register_style( 'jslider',  tfuse_get_file_uri('/css/jslider.css', false, '') );
        wp_enqueue_style( 'jslider' );
        
        wp_register_style( 'playSlider',  tfuse_get_file_uri('/css/playSlider.css', false, '') );
        wp_enqueue_style( 'playSlider' );
        
        wp_register_style( 'shCore',  tfuse_get_file_uri('/css/shCore.css', true, '') );
        wp_enqueue_style( 'shCore' );
        
        wp_register_style( 'shThemeDefault',  tfuse_get_file_uri('/css/shThemeDefault.css', true, '') );
        wp_enqueue_style( 'shThemeDefault' );
        
        wp_register_style( 'font-awesome',  tfuse_get_file_uri('/css/font-awesome.css', false, '') );
        wp_enqueue_style( 'font-awesome' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        
        wp_register_script( 'bootstrap.min', tfuse_get_file_uri('/js/libs/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap.min' );	
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );
        
         wp_register_script( 'jquery-migrate', tfuse_get_file_uri('/js/libs/jquery-migrate.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-migrate' );
        
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );	
		
        wp_register_script( 'jquery-ui.custom.min', tfuse_get_file_uri('/js/libs/jquery-ui.custom.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-ui.custom.min' );	

        wp_register_script( 'jquery.easing', tfuse_get_file_uri('/js/jquery.easing.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.easing' );
        
        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
        
	wp_register_script( 'touchSwipe', tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'touchSwipe' );
        
        wp_register_script( 'awkward',  tfuse_get_file_uri('/js/awkward.js'), array('jquery'), '', true );
        wp_enqueue_script( 'awkward' );
        
        wp_register_script( 'cusel-min',  tfuse_get_file_uri('/js/cusel-min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'cusel-min' );
        
        wp_register_script( 'jplayer',  tfuse_get_file_uri('/js/jquery.jplayer.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jplayer' );
        
        wp_register_script( 'jquery.aw-showcase',  tfuse_get_file_uri('/js/jquery.aw-showcase.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.aw-showcase' );
		
	wp_register_script( 'jquery.carouFredSel',  tfuse_get_file_uri('/js/jquery.carouFredSel.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.carouFredSel' );
        
        wp_register_script( 'jquery.customInput',  tfuse_get_file_uri('/js/jquery.customInput.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.customInput' );
        
        wp_register_script( 'hoverIntent',  tfuse_get_file_uri('/js/hoverIntent.js'), array('jquery'), '', true );
        wp_enqueue_script( 'hoverIntent' );
        
        wp_register_script( 'jquery.mousewheel.min',  tfuse_get_file_uri('/js/jquery.mousewheel.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.mousewheel.min' );
        
        wp_register_script( 'jquery.jscrollpane.min',  tfuse_get_file_uri('/js/jquery.jscrollpane.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.jscrollpane.min' );
        
        wp_register_script( 'jplayer.playlist.min',  tfuse_get_file_uri('/js/jplayer.playlist.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jplayer.playlist.min' );
        
        wp_register_script( 'jquery.placeholder.min',  tfuse_get_file_uri('/js/jquery.placeholder.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.placeholder.min' );
        
        wp_register_script( 'jquery.slider.bundle',  tfuse_get_file_uri('/js/jquery.slider.bundle.js'), array('jquery'), '', true );
        //wp_enqueue_script( 'jquery.slider.bundlen' );
        
        wp_register_script( 'jquery.slider',  tfuse_get_file_uri('/js/jquery.slider.js'), array('jquery'), '', true );
        //wp_enqueue_script( 'jquery.slider' );
        
        wp_register_script( 'knobRot',  tfuse_get_file_uri('/js/knobRot.js'), array('jquery'), '', true );
        wp_enqueue_script( 'knobRot' );
        
        wp_register_script( 'playSlider',  tfuse_get_file_uri('/js/playSlider.js'), array('jquery'), '', true );
        wp_enqueue_script( 'playSlider' );
        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
        
        wp_register_script( 'jquery.gmap',  tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap' );
        
        // JS is include on the footer
        wp_register_script( 'shCore', tfuse_get_file_uri('/js/shCore.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shCore' );
        
        wp_register_script( 'shBrushPlain', tfuse_get_file_uri('/js/shBrushPlain.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shBrushPlain' );
        
        wp_register_script( 'sintaxHighlighter', tfuse_get_file_uri('/js/sintaxHighlighter.js'), array('jquery'), '', true );
        wp_enqueue_script( 'sintaxHighlighter' );
    }
endif;
