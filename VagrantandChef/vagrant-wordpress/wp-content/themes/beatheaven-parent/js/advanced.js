jQuery(document).ready(function($) {
    
    function inArray(needle, haystack) {
        var length = haystack.length;
        for(var i = 0; i < length; i++) {
            if(haystack[i] == needle) return true;
        }
        return false;
    }

    jQuery('#taxonomy-location input:checkbox').bind('change', function(e){
       var term_id = jQuery(this).attr("value");
       if (jQuery(this).is(':checked'))
       {
           jQuery.ajax({
               type: "POST",
               url: tf_script.ajaxurl,
               data: "action=tfuse_ajax_get_parents&id=" + term_id,
               success: function(msg){
                   var obj = jQuery.parseJSON(msg);
                   var msg_array = jQuery.makeArray( obj );
                   jQuery('#taxonomy-location input:checkbox').each(function()
                   {
                       if(inArray(jQuery(this).attr("value"),msg_array)) jQuery(this).attr("checked","true");

                   });
               }
           });
       }
       else
       {
           jQuery.ajax({
               type: "POST",
               url: tf_script.ajaxurl,
               data: "action=tfuse_ajax_get_childs&id=" + term_id,
               success: function(msg){
                   var obj = jQuery.parseJSON(msg);
                   var msg_array = jQuery.makeArray( obj );
                   jQuery('#taxonomy-location input:checkbox').each(function()
                   {
                       if(inArray(jQuery(this).attr("value"),msg_array)) jQuery(this).removeAttr("checked");

                   });
               }
           });
       }
    });
    
    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'carousel'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');
            }
            else if(sel == 'album'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="categories">Automatically, fetch images from categories</option><option value="posts">Automatically, fetch images from posts</option>');
            }
           else
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option><option value="categories">Automatically, fetch images from categories</option><option value="posts">Automatically, fetch images from posts</option>');
            }
               
       },12);
    });
    
     if(!$('#beatheaven_enable_play').is(':checked')){
        jQuery('.beatheaven_custom_btn_title').hide();
    }
        $('#beatheaven_enable_play').live('change',function () {
	if(!jQuery(this).is(':checked'))
        {
            jQuery('.beatheaven_custom_btn_title').hide();
        }
	else
        {
            jQuery('.beatheaven_custom_btn_title').show();
        }
    });
    
     if(!$('#beatheaven_enable_download').is(':checked')){
        jQuery('.beatheaven_custom_btn_down').hide();
    }
        $('#beatheaven_enable_download').live('change',function () {
	if(!jQuery(this).is(':checked'))
        {
            jQuery('.beatheaven_custom_btn_down').hide();
        }
	else
        {
            jQuery('.beatheaven_custom_btn_down').show();
        }
    });
   

jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });
    
    $('#tf_rf_form_name_select').change(function(){
        $_get=getUrlVars();
        if($(this).val()==-1 && 'formid' in $_get){
            delete $_get.formid;
        } else if($(this).val()!=-1){
            $_get.formid=$(this).val();
        }
        $_url_str='?';
        $.each($_get,function(key,val){
            $_url_str +=key+'='+val+'&';
        })
        $_url_str = $_url_str.substring(0,$_url_str.length-1);
        window.location.href=$_url_str;
    });


    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#beatheaven_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#beatheaven_map_lat,#beatheaven_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    $('#beatheaven_framework_options_metabox .handlediv, #beatheaven_framework_options_metabox .hndle').hide();
    $('#beatheaven_framework_options_metabox .handlediv, #beatheaven_framework_options_metabox .hndle').hide();

    var options = new Array();

    options['beatheaven_footer_top'] = jQuery('#beatheaven_footer_top').val();
    jQuery('#beatheaven_footer_top').bind('change', function() {
        options['beatheaven_footer_top'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_footer_top_search'] = jQuery('#beatheaven_footer_top_search').val();
    jQuery('#beatheaven_footer_top_search').bind('change', function() {
        options['beatheaven_footer_top_search'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

options['beatheaven_footer_top_404'] = jQuery('#beatheaven_footer_top_404').val();
    jQuery('#beatheaven_footer_top_404').bind('change', function() {
        options['beatheaven_footer_top_404'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['beatheaven_footer_top_blog'] = jQuery('#beatheaven_footer_top_blog').val();
    jQuery('#beatheaven_footer_top_blog').bind('change', function() {
        options['beatheaven_footer_top_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_header_type'] = jQuery('#beatheaven_header_type').val();
    jQuery('#beatheaven_header_type').bind('change', function() {
        options['beatheaven_header_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_post_type'] = jQuery('#beatheaven_post_type').val();
    jQuery('#beatheaven_post_type').bind('change', function() {
        options['beatheaven_post_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });    
    
    options['beatheaven_homepage_category'] = jQuery('#beatheaven_homepage_category').val();
    jQuery('#beatheaven_homepage_category').bind('change', function() {
        options['beatheaven_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });


    options['beatheaven_type_post'] = jQuery('#beatheaven_type_post').val();
    jQuery('#beatheaven_type_post').bind('change', function() {
        options['beatheaven_type_post'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_type_post1'] = jQuery('#beatheaven_type_post1').val();
    jQuery('#beatheaven_type_post1').bind('change', function() {
        options['beatheaven_type_post1'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['beatheaven_header_element'] = jQuery('#beatheaven_header_element').val();
    jQuery('#beatheaven_header_element').bind('change', function() {
        options['beatheaven_header_element'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_header_element_search'] = jQuery('#beatheaven_header_element_search').val();
    jQuery('#beatheaven_header_element_search').bind('change', function() {
        options['beatheaven_header_element_search'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_header_element_404'] = jQuery('#beatheaven_header_element_404').val();
    jQuery('#beatheaven_header_element_404').bind('change', function() {
        options['beatheaven_header_element_404'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    
    options['beatheaven_header_element_posts'] = jQuery('#beatheaven_header_element_posts').val();
    jQuery('#beatheaven_header_element_posts').bind('change', function() {
        options['beatheaven_header_element_posts'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    
    options['sliders_posts_type'] = jQuery('#sliders_posts_type').val();
    jQuery('#sliders_posts_type').bind('change', function() {
        options['sliders_posts_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['sliders_posts_types'] = jQuery('#sliders_posts_types').val();
    jQuery('#sliders_posts_types').bind('change', function() {
        options['sliders_posts_types'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['beatheaven_page_title'] = jQuery('#beatheaven_page_title').val();
    jQuery('#beatheaven_page_title').bind('change', function() {
        options['beatheaven_page_title'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['slider_hoverPause'] = jQuery('#slider_hoverPause').val();
    jQuery('#slider_hoverPause').bind('change', function() {
       if (jQuery(this).next('.tf_checkbox_switch').hasClass('on'))  options['slider_hoverPause']= true;
        else  options['slider_hoverPause'] = false;
        tfuse_toggle_options(options);
    });

    options['map_type'] = jQuery('#beatheaven_map_type').val();
    jQuery(' #beatheaven_map_type').bind('change', function() {
        options['map_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['beatheaven_blogpage_category'] = jQuery('#beatheaven_blogpage_category').val();
     jQuery('#beatheaven_blogpage_category').bind('change', function() {
         options['beatheaven_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });

     options['beatheaven_header_element_blog'] = jQuery('#beatheaven_header_element_blog').val();
     jQuery('#beatheaven_header_element_blog').bind('change', function() {
         options['beatheaven_header_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     options['beatheaven_before_content_element_blog'] = jQuery('#beatheaven_before_content_element_blog').val();
     jQuery('#beatheaven_before_content_element_blog').bind('change', function() {
         options['beatheaven_before_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
      options['beatheaven_content_element'] = jQuery('#beatheaven_content_element').val();
     jQuery('#beatheaven_content_element').bind('change', function() {
         options['beatheaven_content_element'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['beatheaven_header_bottom'] = jQuery('#beatheaven_header_bottom').val();
     jQuery('#beatheaven_header_bottom').bind('change', function() {
         options['beatheaven_header_bottom'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['beatheaven_header_bottom_search'] = jQuery('#beatheaven_header_bottom_search').val();
     jQuery('#beatheaven_header_bottom_search').bind('change', function() {
         options['beatheaven_header_bottom_search'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['beatheaven_header_bottom_404'] = jQuery('#beatheaven_header_bottom_404').val();
     jQuery('#beatheaven_header_bottom_404').bind('change', function() {
         options['beatheaven_header_bottom_404'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['beatheaven_header_bottom_home'] = jQuery('#beatheaven_header_bottom_home').val();
     jQuery('#beatheaven_header_bottom_home').bind('change', function() {
         options['beatheaven_header_bottom_home'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['beatheaven_header_bottom_blog'] = jQuery('#beatheaven_header_bottom_blog').val();
     jQuery('#beatheaven_header_bottom_blog').bind('change', function() {
         options['beatheaven_header_bottom_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 
	  options['beatheaven_choose_logo'] = jQuery('#beatheaven_choose_logo').val();
    jQuery('#beatheaven_choose_logo').bind('change', function() {
        options['beatheaven_choose_logo'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
     
     options['posts_select_type'] = jQuery('#posts_select_type').val();
     jQuery('#posts_select_type').bind('change', function() {
         options['posts_select_type'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['beatheaven_content_element_blog'] = jQuery('#beatheaven_content_element_blog').val();
     jQuery('#beatheaven_content_element_blog').bind('change', function() {
         options['beatheaven_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('#beatheaven_select_footer_slider_search,#beatheaven_select_footer_slider_404,#beatheaven_select_slider_404,#beatheaven_select_slider_search,#beatheaven_select_bottom_slider_404,#beatheaven_header_bottom_img_404,#beatheaven_header_bottom_shortcode_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404,#beatheaven_select_bottom_slider_search,#beatheaven_header_bottom_img_search,#beatheaven_header_bottom_shortcode_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search,#beatheaven_select_bottom_slider_blog,#beatheaven_header_bottom_img_blog,#beatheaven_header_bottom_shortcode_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog,#beatheaven_home_cat_title,#beatheaven_categories_select_promos,#beatheaven_select_footer_slider_blog,#beatheaven_select_footer_slider,#posts_select_products,#posts_select_albums,#posts_select_events,#posts_select_product,#posts_select_album,#posts_select_event,#beatheaven_header_bottom_img,#beatheaven_select_bottom_slider,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc,#beatheaven_page_map_blog,#beatheaven_page_map_home,#beatheaven_page_map,#beatheaven_header_bottom_shortcode_home,#beatheaven_header_bottom_shortcode_blog,#beatheaven_select_slider_ann,#beatheaven_single_pdf,#beatheaven_single_mp3,#beatheaven_header_bottom_shortcode,#beatheaven_logo_text_subtitle,#beatheaven_logo,#beatheaven_logo_text,#beatheaven_use_page_options,#beatheaven_select_slider_blog,#beatheaven_select_slider_posts,#beatheaven_select_slider_portf,#beatheaven_select_slider,#beatheaven_home_page,#beatheaven_categories_select_categ,#beatheaven_slide_image,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#beatheaven_select_footer_slider_search,#beatheaven_select_footer_slider_404,#beatheaven_select_slider_404,#beatheaven_select_slider_search,#beatheaven_select_bottom_slider_404,#beatheaven_header_bottom_img_404,#beatheaven_header_bottom_shortcode_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404,#beatheaven_select_bottom_slider_search,#beatheaven_header_bottom_img_search,#beatheaven_header_bottom_shortcode_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search,#beatheaven_select_bottom_slider_blog,#beatheaven_header_bottom_img_blog,#beatheaven_header_bottom_shortcode_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog,#beatheaven_home_cat_title,#beatheaven_categories_select_promos,#beatheaven_select_footer_slider_blog,#beatheaven_select_footer_slider,#posts_select_products,#posts_select_albums,#posts_select_events,#posts_select_product,#posts_select_album,#posts_select_event,#beatheaven_header_bottom_img,#beatheaven_select_bottom_slider,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc,#beatheaven_page_map_blog,#beatheaven_page_map_home,#beatheaven_page_map,#beatheaven_header_bottom_shortcode_home,#beatheaven_header_bottom_shortcode_blog,#beatheaven_select_slider_ann,#beatheaven_single_pdf,#beatheaven_single_mp3,#beatheaven_header_bottom_shortcode,#beatheaven_logo_text_subtitle,#beatheaven_logo,#beatheaven_logo_text,#beatheaven_use_page_options,#beatheaven_select_slider_blog,#beatheaven_select_slider_posts,#beatheaven_select_slider_portf,#beatheaven_select_slider,#beatheaven_home_page,#beatheaven_categories_select_categ,#beatheaven_slide_image,.homepage_category_header_element').parents('.form-field').hide();        

        /*--------------------------------------------------*/
        //slider post type 
        if(options['sliders_posts_type']=='event'){
            jQuery('#posts_select_event').parents('.option-inner').show();
            jQuery('#posts_select_event').parents('.form-field').show();
        }
        else if(options['sliders_posts_type']=='album'){
            jQuery('#posts_select_album').parents('.option-inner').show();
            jQuery('#posts_select_album').parents('.form-field').show();
        }
        else if(options['sliders_posts_type']=='product'){
            jQuery('#posts_select_product').parents('.option-inner').show();
            jQuery('#posts_select_product').parents('.form-field').show();
        }
        //slider post type 
        if(options['sliders_posts_types']=='events'){
            jQuery('#posts_select_events').parents('.option-inner').show();
            jQuery('#posts_select_events').parents('.form-field').show();
        }
        else if(options['sliders_posts_types']=='albums'){
            jQuery('#posts_select_albums').parents('.option-inner').show();
            jQuery('#posts_select_albums').parents('.form-field').show();
        }
        else if(options['sliders_posts_types']=='products'){
            jQuery('#posts_select_products').parents('.option-inner').show();
            jQuery('#posts_select_products').parents('.form-field').show();
        }
        
        //footer top
        if(options['beatheaven_footer_top']=='slider'){
            jQuery('#beatheaven_select_footer_slider').parents('.option-inner').show();
            jQuery('#beatheaven_select_footer_slider').parents('.form-field').show();
        }
        //footer top search
        if(options['beatheaven_footer_top_search']=='slider'){
            jQuery('#beatheaven_select_footer_slider_search').parents('.option-inner').show();
            jQuery('#beatheaven_select_footer_slider_search').parents('.form-field').show();
        }
        //footer top search
        if(options['beatheaven_footer_top_404']=='slider'){
            jQuery('#beatheaven_select_footer_slider_404').parents('.option-inner').show();
            jQuery('#beatheaven_select_footer_slider_404').parents('.form-field').show();
        }
        if(options['beatheaven_footer_top_blog']=='slider'){
            jQuery('#beatheaven_select_footer_slider_blog').parents('.option-inner').show();
            jQuery('#beatheaven_select_footer_slider_blog').parents('.form-field').show();
        }
        //header bottom
        if(options['beatheaven_header_bottom']=='title_slider'){
            jQuery('#beatheaven_select_bottom_slider').parents('.option-inner').show();
            jQuery('#beatheaven_select_bottom_slider').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom']=='title_img')
        {
            jQuery('#beatheaven_header_bottom_img,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom']=='title_img2')
        {
            jQuery('#beatheaven_header_bottom_img,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom']=='shortcode')
        {
            jQuery('#beatheaven_header_bottom_shortcode,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_shortcode,#beatheaven_header_bottom_title,#beatheaven_header_bottom_icon,#beatheaven_header_bottom_desc').parents('.form-field').show();
        }
        //header bottom 404
        if(options['beatheaven_header_bottom_404']=='title_slider'){
            jQuery('#beatheaven_select_bottom_slider_404').parents('.option-inner').show();
            jQuery('#beatheaven_select_bottom_slider_404').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_404']=='title_img')
        {
            jQuery('#beatheaven_header_bottom_img_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_404']=='title_img2')
        {
            jQuery('#beatheaven_header_bottom_img_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_404']=='shortcode')
        {
            jQuery('#beatheaven_header_bottom_shortcode_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_shortcode_404,#beatheaven_header_bottom_title_404,#beatheaven_header_bottom_icon_404,#beatheaven_header_bottom_desc_404').parents('.form-field').show();
        }
        
        //header bottom search
        if(options['beatheaven_header_bottom_search']=='title_slider'){
            jQuery('#beatheaven_select_bottom_slider_search').parents('.option-inner').show();
            jQuery('#beatheaven_select_bottom_slider_search').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_search']=='title_img')
        {
            jQuery('#beatheaven_header_bottom_img_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_search']=='title_img2')
        {
            jQuery('#beatheaven_header_bottom_img_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_search']=='shortcode')
        {
            jQuery('#beatheaven_header_bottom_shortcode_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_shortcode_search,#beatheaven_header_bottom_title_search,#beatheaven_header_bottom_icon_search,#beatheaven_header_bottom_desc_search').parents('.form-field').show();
        }
        
        //header bottom for blogpage
        if(options['beatheaven_header_bottom_blog']=='title_slider'){
            jQuery('#beatheaven_select_bottom_slider_blog').parents('.option-inner').show();
            jQuery('#beatheaven_select_bottom_slider_blog').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_blog']=='title_img')
        {
            jQuery('#beatheaven_header_bottom_img_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_blog']=='title_img2')
        {
            jQuery('#beatheaven_header_bottom_img_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_img_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog').parents('.form-field').show();
        }
        else if(options['beatheaven_header_bottom_blog']=='shortcode')
        {
            jQuery('#beatheaven_header_bottom_shortcode_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog').parents('.option-inner').show();
            jQuery('#beatheaven_header_bottom_shortcode_blog,#beatheaven_header_bottom_title_blog,#beatheaven_header_bottom_icon_blog,#beatheaven_header_bottom_desc_blog').parents('.form-field').show();
        }
        
        
        //logo type
        if(options['beatheaven_choose_logo'] == 'text')
        { 
            jQuery('#beatheaven_logo_text').parents('.option-inner').show();
            jQuery('#beatheaven_logo_text').parents('.form-field').show();
			jQuery('#beatheaven_logo_text_subtitle').parents('.option-inner').show();
            jQuery('#beatheaven_logo_text_subtitle').parents('.form-field').show();
        }
        else
        {
            jQuery('#beatheaven_logo').parents('.option-inner').show();
            jQuery('#beatheaven_logo').parents('.form-field').show();
        }
        
        //homepage
       if(options['beatheaven_homepage_category']=='specific'){
            jQuery('.beatheaven_display_type_home').show();
            jQuery('.beatheaven_categories_select_categ,.beatheaven_home_cat_title').next().show();
            jQuery('#beatheaven_categories_select_categ,#beatheaven_home_cat_title').parents('.option-inner').show();
            jQuery('#beatheaven_categories_select_categ,#beatheaven_home_cat_title').parents('.form-field').show();
           
            if($('#beatheaven_use_page_options').is(':checked')) 
                jQuery('#beatheaven_header_element,#beatheaven_home_cat_title').removeAttr('style');
        }
        else if (options['beatheaven_homepage_category']=='specific_promos')
        {
            jQuery('.beatheaven_display_type_home').show();
            jQuery('.beatheaven_categories_select_promos,.beatheaven_home_cat_title').next().show();
            jQuery('#beatheaven_categories_select_promos,#beatheaven_home_cat_title').parents('.option-inner').show();
            jQuery('#beatheaven_categories_select_promos,#beatheaven_home_cat_title').parents('.form-field').show();
           
            if($('#beatheaven_use_page_options').is(':checked')) 
                jQuery('#beatheaven_header_element,#beatheaven_home_cat_title').closest('.postbox').removeAttr('style');
        }
        else if (options['beatheaven_homepage_category']=='all' || options['beatheaven_homepage_category']=='all_promos')
        {
            jQuery('.beatheaven_display_type_home').show();
            jQuery('.beatheaven_categories_select_categ,.beatheaven_home_cat_title').next().show();
            jQuery('#beatheaven_home_cat_title').parents('.option-inner').show();
            jQuery('#beatheaven_home_cat_title').parents('.form-field').show();
            if($('#beatheaven_use_page_options').is(':checked')) 
                jQuery('#beatheaven_header_element,#beatheaven_home_cat_title').closest('.postbox').removeAttr('style');
        }
        else if(options['beatheaven_homepage_category']=='page'){
            jQuery('#beatheaven_home_page,#beatheaven_use_page_options').parents('.option-inner').show();
            jQuery('#beatheaven_home_page,#beatheaven_use_page_options').parents('.form-field').show();
            jQuery('.beatheaven_categories_select_categ,.beatheaven_home_cat_title').next().hide();
            //use page options
            if($('#beatheaven_use_page_options').is(':checked')) jQuery('#beatheaven_header_element,#beatheaven_home_cat_title').closest('.postbox').hide();
            $('#beatheaven_use_page_options').live('change',function () {
            if(jQuery(this).is(':checked'))
                    jQuery('#beatheaven_header_element,#beatheaven_home_cat_title').closest('.postbox').hide();
            else
                    jQuery('#beatheaven_header_element,#beatheaven_home_cat_title').closest('.postbox').show();
            });
        } 
        
        /*header element*/
        
        if (options['beatheaven_header_element'] == 'slider')
        { 
            jQuery('#beatheaven_select_slider').parents('.option-inner').show();
            jQuery('#beatheaven_select_slider').parents('.form-field').show();
        }
        
        if (options['beatheaven_header_element_search'] == 'slider')
        { 
            jQuery('#beatheaven_select_slider_search').parents('.option-inner').show();
            jQuery('#beatheaven_select_slider_search').parents('.form-field').show();
        }
        
        if (options['beatheaven_header_element_404'] == 'slider')
        { 
            jQuery('#beatheaven_select_slider_404').parents('.option-inner').show();
            jQuery('#beatheaven_select_slider_404').parents('.form-field').show();
        }
        
        //header elements for blog page
        if (options['beatheaven_header_element_blog'] == 'slider')
        { 
            jQuery('#beatheaven_select_slider_blog').parents('.option-inner').show();
            jQuery('#beatheaven_select_slider_blog').parents('.form-field').show();
        }
        
        //blog page
        if(options['beatheaven_blogpage_category']=='all' || options['beatheaven_blogpage_category']=='all_promos'){
            jQuery('.beatheaven_categories_select_categ_blog,.beatheaven_categories_select_promos_blog').hide();
        }
        else if(options['beatheaven_blogpage_category']=='specific'){
            jQuery('.beatheaven_categories_select_categ_blog').show();
             jQuery('.beatheaven_categories_select_promos_blog').hide();
        } 
        else if(options['beatheaven_blogpage_category']=='specific_promos'){
            jQuery('.beatheaven_categories_select_promos_blog').show();
            jQuery('.beatheaven_categories_select_categ_blog').hide();
        } 
        
        
       //header 
        var homepage = true;
        if (jQuery('.homepage_category_header_element').length == 1) homepage = false;
        if ( options['beatheaven_homepage_category'] == 'tfuse_blog_posts' || options['beatheaven_homepage_category'] == 'tfuse_blog_cases')
        {
            homepage = true;
            jQuery('.homepage_category_header_element').parents('.option-inner').show();
            jQuery('.homepage_category_header_element').parents('.form-field').show();
        }
        
        //hide page title
        if(options['beatheaven_page_title'] == 'custom_title')
        { 
            jQuery('#beatheaven_custom_title').parents('.option-inner').show();
            jQuery('#beatheaven_custom_title').parents('.form-field').show();
        }
		else
        { 
            jQuery('#beatheaven_custom_title').parents('.option-inner').hide();
            jQuery('#beatheaven_custom_title').parents('.form-field').hide();
        }
        //slider
        if (options['slider_hoverPause'])
        {
            jQuery('.slider_pause').show();
            jQuery('.slider_pause').next('.tfclear').show();
        }
        else
        {
            jQuery('.slider_pause').hide();
            jQuery('.slider_pause').next('.tfclear').hide();
        }
    }
});