
function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=value + ((exdays==null) ? "" : "; expires="+exdate.toUTCString()+"; path=/;");
    document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
    var i,x,y,ARRcookies=document.cookie.split(";");
    var result = false;
    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name)
        {
            result = y;
        }
    }
    return result;
}

var $ = jQuery;

function ajax_pagination(screenRes)
{
    if(parseInt(display.number) <= parseInt(display.items)) {
           jQuery('#ajax_load_posts').hide();
	}
    
var pageNum = parseInt(display.startPage);
var max = parseInt(display.maxPages);
var max_specific = parseInt(display.max_specific);// alert(max_specific);
if(max_specific != 0){ max = max_specific;}

    jQuery('#ajax_load_posts').on('click',function(){
    jQuery(this).text('LOADING POSTS...');
        pageNum++;
        
        var search_cat = jQuery('input[name="search_cat"]').attr("value");
        var search_tax = jQuery('input[name="search_tax"]').attr("value");
        
        var post_type = jQuery('input[name="post_type"]').attr("value"); 
        var filter_date = jQuery('input[name="events_date"]').attr("value");
        var search_param = jQuery('input[name="search_param"]').attr("value");
        var events = jQuery('input[name="events_exist"]').attr("value");
        
        var search_date = jQuery('input[name="search_date"]').attr("value"); 
        var search_key = jQuery('input[name="search_key"]').attr("value"); 
        var homepage = jQuery('input[name="homepage"]').attr("value");
        var allhome = jQuery('input[name="allhome"]').attr("value"); 
        var allblog = jQuery('input[name="allblog"]').attr("value");
        var cat_ids = jQuery('input[name="categories_ids"]').attr("value"); 
        var is_tax = jQuery('input[name="is_this_tax"]').attr("value");
        var id = jQuery('input[name="current_cat"]').attr("value");
        var x_data = "action=tfuse_ajax_get_posts&id="+id+"&search_tax="+search_tax+"&search_cat="+search_cat+"&search_param="+search_param+"&events="+events+"&filter_date="+filter_date+"&post_type="+post_type+"&is_tax="+is_tax+"&homepage="+homepage+"&allhome="+allhome+"&allblog="+allblog+"&cat_ids="+cat_ids+'&search_key='+search_key+'&pageNum='+pageNum+'&max='+max+'&search_date='+search_date;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            success: function(rsp){
        
        var obj = jQuery.parseJSON(rsp); 
        //var obj = rsp; 
        //console.log(obj);
        
                for(i = 0 ;i < parseInt(obj.items); i++)
                {
                    var boxes = jQuery(obj.html[i]);
                    jQuery("#content_load").append( boxes ); 
                }

                if(pageNum >= max)
                {  
                    jQuery('#ajax_load_posts').hide();
                }
                else
                {
                     jQuery('#ajax_load_posts').text('READ MORE');
                }

                jQuery('a[data-rel]').each(function() {
                jQuery(this).attr('rel', jQuery(this).data('rel'));
                });
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
                
                jQuery(".event_list .event_item:even").addClass("even");
                jQuery(".event_list .event_item:odd").addClass("odd");
                
                if (screenRes > 600) {
                    jQuery(".gridlist .post-item:nth-child(3n)").addClass("omega");
                }
            }
        });
        return false;
    });
}

function shortcode_pagination(screenRes)
{
    var type = paginationId = appendBox = '';
    var shortcode_info = {};
    if(jQuery('.shortcode.postlist.gridlist').hasClass('shortcode_location'))
    {  
        type = 'location';  
        shortcode_info = shortcode_location;
        paginationId = '#load_shortcode_location';
        appendBox = '.shortcode_location';
    }
    else if(jQuery('.shortcode.postlist.gridlist').hasClass('shortcode_artist'))
    {
        type = 'artist';  
        shortcode_info = shortcode_artist;
        paginationId = '#load_shortcode_artist';
        appendBox = '.shortcode_artist';
    }
    else if(jQuery('.shortcode.postlist.gridlist').hasClass('shortcode_events'))
    {
        type = 'events';  
        shortcode_info = shortcode_events;
        paginationId = '#load_shortcode_events';
        appendBox = '.shortcode_events';
    }
    
    if(parseInt(shortcode_info.child_numb) <= parseInt(shortcode_info.max_specific)) {
           jQuery(paginationId).parent().hide();
	}
    var max = parseInt(shortcode_info.maxPages);
    var max_specific = parseInt(shortcode_info.maxPages);
    if(max_specific != 0){ max = max_specific;} 
    var pageNum = 1;
    var count = 0;
//when click on load button
    jQuery(paginationId).on('click',function(){
    jQuery(this).text('Loading ...');
        pageNum++;  
        var x_data = "action=tfuse_ajax_get_shortcode_posts&max="+max+'&type='+type+'&pageNum='+pageNum;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            success: function(rsp){
        
       var obj = jQuery.parseJSON(rsp); 
        //var obj = rsp; 
       // console.log(obj);
        
                for(var i = 0 , j = count;j <= parseInt(obj.items); i++,j++)
                {
                    if(i >= parseInt(obj.per_page)) break;
                    var boxes = jQuery(obj.html[j]);
                    jQuery(appendBox).append( boxes ); 
                    count ++;
                }
                
                
                if(pageNum >= max)
                {  
                    jQuery(paginationId).parent().hide();
                }
                else
                {
                     jQuery(paginationId).text('READ MORE');
                } 
                
                if (screenRes > 600) {
                    $(".gridlist .post-item:nth-child(3n)").addClass("omega");
                }	
	
            }
            
        });
         
        return false;
    });
}


// Topmenu <ul> replace to <select>
function responsive(mainNavigation) {
	var $ = jQuery;
	var screenRes = $('.body_wrap').width();
	
	if ($('.topmenu select').length == 0) {			  
		/* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
		$('.topmenu').append('<select class="select_styled" id="topm-select" style="display:none;"></select>');
		var selectMenu = $('#topm-select');

		/* Navigate our nav clone for information needed to populate options */
		$(mainNavigation).children('div').children('ul').children('li').each(function () {

			/* Get top-level link and text */
			var href = $(this).children('a').attr('href');
			var text = $(this).children('a').text();

			/* Append this option to our "select" */
			if ($(this).is(".current-menu-item") && href != '#') {
				$(selectMenu).append('<option value="' + href + '" selected>' + text + '</option>');
			} else if (href == '#') {
				$(selectMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
			} else {
				$(selectMenu).append('<option value="' + href + '">' + text + '</option>');
			}

			/* Check for "children" and navigate for more options if they exist */
			if ($(this).children('ul').length > 0) {
				$(this).children('ul').children('li').not(".mega-nav-widget").each(function () {

					/* Get child-level link and text */
					var href2 = $(this).children('a').attr('href');
					var text2 = $(this).children('a').text();

					/* Append this option to our "select" */
					if ($(this).is(".current-menu-item") && href2 != '#') {
						$(selectMenu).append('<option value="'+href2+'" selected> - '+text2+'</option>');
					} else if (href2 == '#') {
						$(selectMenu).append('<option value="'+href2+'" disabled="disabled"> - '+text2+'</option>');
					} else {
						$(selectMenu).append('<option value="'+href2+'"> - '+text2+'</option>');
					}

					/* Check for "children" and navigate for more options if they exist */
					if ($(this).children('ul').length > 0) {
						$(this).children('ul').children('li').each(function () {

							/* Get child-level link and text */
							var href3 = $(this).children('a').attr('href');
							var text3 = $(this).children('a').text();

							/* Append this option to our "select" */
							if ($(this).is(".current-menu-item")) {
								$(selectMenu).append('<option value="' + href3 + '" class="select-current" selected> -- ' + text3 + '</option>');
							} else {
								$(selectMenu).append('<option value="' + href3 + '"> -- ' + text3 + '</option>');
							}

						});
					}
				});
			}
		});
	}
	if(screenRes >= 750){
        $('.topmenu select:first').hide();
        $('.topmenu ul:first').show();      
    }else{
        $('.topmenu ul:first').hide();
        $('.topmenu select:first').show();             
    }

	/* When our select menu is changed, change the window location to match the value of the selected option. */
	$(selectMenu).change(function () {
		location = this.options[this.selectedIndex].value;
	});
}
	
jQuery(document).ready(function($) {
    jQuery('.albums_carousel .song_title_wrap a').click(function(){
        var link = jQuery(this);
        var target = link.attr("target");
        window.open(link.attr("href"), target ? target : "_self")
    });
	
	var screenRes = $(window).width(); 
        
        ajax_pagination(screenRes);
        
        shortcode_pagination(screenRes);
	
// Remove links outline in IE 7
	$("a").attr("hideFocus", "true").css("outline", "none");

// Top Search with animation
    var searchElem = $("#searchForm");
    var searchTextField = $("#stext");
	var searchWidthMain = "235px";
	var searchWidth2 = "150px";
	var searchWidthSmall = "80px";
	if (screenRes < 750) {
		searchWidthMain = "185px";
		searchWidthSmall = "35px";
	}
    searchElem.hover(
        function () {
            $(this).stop().animate({width: searchWidthMain}, 600, 'easeOutCubic');
            searchTextField.stop().show().animate({width: searchWidth2}, 700, 'easeOutCubic');
        }
    );
    $('body').click(function() {
        searchTextField.stop().animate({width: '0px'},500,'easeInCubic',function() {$(this).hide();});
        searchElem.stop().animate({width: searchWidthSmall}, 600, 'easeInCubic');
    });
    searchElem.click(function(event){
        event.stopPropagation();
    });
    
    jQuery(document).ready(function($) {
        jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
        });
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
        });

// Audio Player
	var $players_on_page = $('.jp-audio').length;
	var $song_title = '';
	var $next_song_title = '';

	if($players_on_page > 0){
		for(var i = 1; i <= $players_on_page; i++){
			$('.jp-audio').eq(i-1).addClass('jp-audio'+i);
		};

		setTimeout(function () {
			for(var i = 1; i <= $players_on_page; i++){
				$song_title = $('.jp-audio'+i+' .jp-playlist ul li.jp-playlist-current .jp-playlist-item').html();			
				$('.jp-audio'+i+' .song_title').html($song_title);
				$next_song_title = $('.jp-audio'+i+' .jp-playlist ul li.jp-playlist-current').next().find(".jp-playlist-item").html();
				$('.jp-audio'+i+' .next_song_title').html($next_song_title);			
			};
		}, 500);

		function switchSong() {
			setTimeout(function () {
				for(var i = 1; i <= $players_on_page; i++){
					$('.jp-audio'+i+' .jp-previous, .jp-audio'+i+' .jp-next').removeClass('disabled');

					if ($('.jp-audio'+i+' .jp-playlist ul li:last-child').hasClass('jp-playlist-current')) {
						$('.jp-audio'+i+' .jp-next').addClass('disabled');
					}
					if ($('.jp-audio'+i+' .jp-playlist ul li:first-child').hasClass('jp-playlist-current')) {
						$('.jp-audio'+i+' .jp-previous').addClass('disabled');
					}
					$song_title = $('.jp-audio'+i+' .jp-playlist ul li.jp-playlist-current .jp-playlist-item').html();
					$('.jp-audio'+i+' .song_title').html($song_title);
					
					$next_song_title = $('.jp-audio'+i+' .jp-playlist ul li.jp-playlist-current').next().find(".jp-playlist-item").html();
					if($next_song_title) {
						$('.jp-audio'+i+' .next_song_title').parent().show();
						$('.jp-audio'+i+' .next_song_title').html($next_song_title);
					} else {					
						$('.jp-audio'+i+' .next_song_title').parent().hide();;
					}				
				}
			}, 0)
		};

		$('.jp-previous, .jp-next, .jp-playlist ul').click(function() {
			switchSong();
            $(".c_item").removeClass("current_play");
            $(this).closest(".c_item").addClass("current_play");
		});
        $('.jp-play').click(function() {
            $(".c_item").removeClass("current_play");
            $(this).closest(".c_item").addClass("current_play");
        });
		$(".jp-jplayer").on($.jPlayer.event.ended, function(event) {
			switchSong()
		});
	};

// style Select, Radio, Checkbox
	if ($("select").hasClass("select_styled")) {
		var deviceAgent = navigator.userAgent.toLowerCase();
		var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
		if (agentID) {
			cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: true});	 // Add arrows Up/Down for iPad/iPhone
		} else {
			cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: false});
		}		
	}
	if ($("div,p").hasClass("input_styled")) {
		$(".input_styled input").customInput();
	}

// centering dropdown submenu (not mega-nav)
	$(".dropdown > li:not(.mega-nav)").hover(function(){
		var dropDown = $(this).children("ul");
		var dropDownLi = $(this).children().children("li").innerWidth();		
		var posLeft = ((dropDownLi - $(this).innerWidth())/2);
		dropDown.css("left",-posLeft);		
	});	
	
// reload topmenu on Resize
	var mainNavigation = $('.topmenu').clone();
	responsive(mainNavigation);
	
    $(window).resize(function() {		
        var screenRes = $('.body_wrap').width();
        responsive(mainNavigation);
    });	
	
// responsive megamenu			
	  
	if (screenRes > 750) {
		mega_show();		
    } 		
	
	function mega_show(){		
		$('.dropdown li').hoverIntent({
			sensitivity: 5,
			interval: 50, 
			over: subm_show, 
			timeout: 0, 
			out: subm_hide
		});
	}
	function subm_show(){	
		if ($(this).hasClass("parent")) {
			$(this).addClass("parentHover");
		};		
		$(this).children("ul.submenu-1").fadeIn(50);		
	}
	function subm_hide(){ 
		$(this).removeClass("parentHover");
		$(this).children("ul.submenu-1").fadeOut(50);		
	}
		
	$(".dropdown ul").parent("li").addClass("parent");
	$(".dropdown li:first-child, .pricing_box li:first-child, .sidebar .widget-container:first-child, .f_col .widget-container:first-child").addClass("first");
	$(".dropdown li:last-child, .pricing_box li:last-child, .widget_twitter .tweet_item:last-child, .sidebar .widget-container:last-child, .f_col .widget-container li:last-child, .event_list .event_item:last-child").addClass("last");
	$(".dropdown li:only-child").removeClass("last").addClass("only");	
	$(".sidebar .current-menu-item, .sidebar .current-menu-ancestor").prev().addClass("current-prev");				
	
// tabs		
	var $tabs_on_page = $('.tabs').length;
	var $bookmarks = 0;

	for(var i = 1; i <= $tabs_on_page; i++){
		$('.tabs').eq(i-1).addClass('tab_id'+i);
		$bookmarks = $('.tab_id'+i+' li').length;
		$('.tab_id'+i).addClass('bookmarks'+$bookmarks);
	};
	$('.tabs li').click(function() {
    setTimeout(function () {
        for(var i = 1; i <= $tabs_on_page; i++){
            $bookmarks = $('.tab_id'+i+' li').length;
            for(var j = 1; j <= $bookmarks; j++){
                $('.tab_id'+i).removeClass('active_bookmark'+j);

                if($('.tab_id'+i+' li').eq(j-1).hasClass('active')){
                    $('.tab_id'+i).addClass('active_bookmark'+j);
                }
            }
        }
    }, 0)
});
	
// odd/even
	$("ul.recent_posts > li:odd, ul.popular_posts > li:odd, .table-striped table>tbody>tr:odd, .boxed_list > .boxed_item:odd, .grid_layout .post-item:odd").addClass("odd");
	$(".widget_recent_comments ul > li:even, .widget_recent_entries li:even, .widget_twitter .tweet_item:even, .widget_archive ul > li:even, .widget_categories ul > li:even, .widget_nav_menu ul > li:even, .widget_links ul > li:even, .widget_meta ul > li:even, .widget_pages ul > li:even, .event_list .event_item:even").addClass("even");
	 $(".event_list .event_item:odd").addClass("odd");
// cols
	$(".row .col:first-child").addClass("alpha");
	$(".row .col:last-child").addClass("omega"); 	

// toggle content
	$(".toggle_content").hide(); 	
	$(".toggle").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});
	
	$(".toggle").click(function(){
		$(this).next(".toggle_content").slideToggle(300,'easeInQuad');
	});
	
	
	$(".opened").find(".panel-collapse").addClass("in");
	$(".panel-toggle").click (function() {
		$(this).closest(".toggleitem").toggleClass("opened");;
	});
	
	$("[data-toggle='tooltip']").tooltip();

// pricing
	if (screenRes > 750) {
		// style 2
		$(".pricing_box ul").each(function () {
			$(".pricing_box .price_col").css('width',$(".pricing_box ul").width() / $(".pricing_box .price_col").size() - 10);			
		});
		
		var table_maxHeight = -1;
		$('.price_item .price_col_body ul').each(function() {
			table_maxHeight = table_maxHeight > $(this).height() ? table_maxHeight : $(this).height();
		});
		$('.price_item .price_col_body ul').each(function() {
			$(this).height(table_maxHeight);
		});	
	} 

// grid list	
	if (screenRes > 600) {
		$(".gridlist .post-item:nth-child(3n)").addClass("omega");
	}	
	
// buttons	
		$(".btn, .post-share a,.form-submit #submit").hover(function(){
			$(this).stop().animate({"opacity": 0.80});
		},function(){
			$(this).stop().animate({"opacity": 1});
		});	

// Smooth Scroling of ID anchors	
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');
 
  $('a[href*=#].anchor').each(function() {
    $(this).click(function(event) {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      if (target && $target.length != 0) {
        var targetOffset = $target.offset().top;
          event.preventDefault();
          $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
      }
    }
   });	
  });
 
  // use the first element that is "scrollable"
  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }
  
	// prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
	if($('a').is('[data-rel]') && screenRes > 600) {
        $('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});		
		$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});	
    }
	  
});

$(window).load(function() {
    var $=jQuery;
// mega dropdown menu	
	$('.dropdown .mega-nav > ul.submenu-1').each(function(){  
		var liItems = $(this);
		var Sum = 0;
		var liHeight = 0;
		if (liItems.children('li').length > 1){
			$(this).children('li').each(function(i, e){
				Sum += $(e).outerWidth(true);
			});
			$(this).width(Sum);
			liHeight = $(this).innerHeight();	
			$(this).children('li').css({"height":liHeight-30});					
		}
		var posLeft = 0;
		var halfSum = Sum/2;
		var screenRes = $(window).width();	
		if (screenRes > 960) {
			var mainWidth = 940; // width of main container to fit in.
		} else {
			var mainWidth = 744; // for iPad.
		}
		var parentWidth = $(this).parent().width();			
		var margLeft = $(this).parent().position();		
		margLeft = margLeft.left;		
		var margRight = mainWidth - margLeft - parentWidth;		
		var subCenter = halfSum - parentWidth/2;						
		if (margLeft >= halfSum && margRight >= halfSum) {			
			liItems.css("left",-subCenter);
		} else if (margLeft<halfSum) {
			liItems.css("left",-margLeft-1);
		} else if (margRight<halfSum) {
			posLeft = Sum - margRight - parentWidth - 10;
			liItems.css("left",-posLeft);					
		}
	});

        jQuery('body').on('hover', 'span.star', function() {
            jQuery(".rating span.star").removeClass("on");
            jQuery(this).prevAll().addClass("over");
            jQuery(this).removeClass("over");
        });

        jQuery('body').on('mouseleave', '.rating',function(){
            jQuery(this).parent().find('.over').removeClass('over');
        });
 
         ajax_rating();
});

function ajax_rating()
{
            jQuery('body').on('click', '.rating span.star', function(){
                var id = rating.id;
                var rating_array = JSON.stringify(rating.rating_info);                        
                var current = jQuery(this).attr('rel');
                var parent = jQuery(this).parent().attr('id');

                jQuery(this).parent().children(".star").removeClass("voted");
                jQuery(this).prevAll().addClass("voted");
                jQuery(this).addClass("voted");

                var cookies = getCookie('rating');

                if(cookies)cookies = cookies.split(',');

                var is_in = jQuery.inArray(parent,cookies);
                if(is_in != -1)
                {
                    jQuery.ajax({
                        type: "POST",
                        url: tf_script.ajaxurl,
                        data:{"action" : "tfuse_ajax_get_rating", id : id, current:current, parent:parent, rating_array:rating_array},
                        success: function(rsp){
                            //var obj = jQuery.parseJSON(rsp); 
                            var obj = rsp; 
                            //console.log(obj);
                        },
                        error: function(rsp){
                            console.log('error');
                        }
                    });
                }


                var saved_prop = getCookie('rating');

                if(saved_prop)saved_prop = saved_prop.split(',');
                else  saved_prop = new Array();

                var pos = jQuery.inArray(parent,saved_prop);  

                if(pos != -1)
                {
                    saved_prop = jQuery.grep(saved_prop, function(value) {
                        return value;
                    });
                }
                else
                    saved_prop.push(parent);

                saved_prop = saved_prop.join();

                setCookie('rating', saved_prop , 366);
            });
}

function isInArray(value, array) {
  return array.indexOf(value) > -1 ? true : false;
}