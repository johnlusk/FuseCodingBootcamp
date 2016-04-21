<!--- top slider -->
<div class="top_slider" style="">
    <div class="carousel_slider">
        <ul class="carousel_content" id="slider1">
            <?php foreach ($slider['slides'] as $slide):?>
                <li class="slider_item">
                    <a href="<?php echo $slide['slide_url'];?>"><img src="<?php echo $slide['slide_src'];?>" alt="">
                        <span class="slider_caption">
                            <strong><?php echo $slide['slide_title'];?></strong> 
                            <em><?php echo $slide['slide_post_desc'];?></em>
                        </span>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>
        <a class="prev" id="slider1_prev" href="#"></a>
        <a class="next" id="slider1_next" href="#"></a>
    </div>

    <script>
		jQuery('document').ready(function(){
			jQuery('#slider1').carouFredSel({
				next : "#slider1_next",
				prev : "#slider1_prev",
				auto: false,
				width: "100%",
				height: "auto",
				infinite: true,
				circular: false,
				scroll: {
					items : 1
				}
			});
		});

    </script>
</div>
<!--/ top slider -->