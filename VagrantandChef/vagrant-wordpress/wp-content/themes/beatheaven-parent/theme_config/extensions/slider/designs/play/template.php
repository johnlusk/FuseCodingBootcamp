<!--- top slider -->
<div class="top_slider">
    <!-- playSlider -->
    <div class="playSlider">
        <ul class="slide-content">
            <?php foreach ($slider['slides'] as $slide):?>
                <li>
                    <div class="textHolder">
                        <h3><?php echo $slide['slide_title'];?></h3>
                        <p><span><?php echo $slide['slide_post_desc'];?></span> 
                            <a href="<?php echo $slide['slide_url'];?>" class="btn btn-primary btn-sm"><i class="icon icon-plus-sign"></i> <?php _e('FIND OUT MORE','tfuse');?></a></p>
                    </div>
                    <img src="<?php echo $slide['slide_src'];?>" alt="" />
                </li>
            <?php endforeach;?>
        </ul>
        <div class="progressBar"><div class="progressIndicator"></div></div>
    </div>
    <script>
    jQuery(document).ready(function(){
        var playslider = jQuery(".playSlider").html();

        jQuery('.playSlider').playSlider({
            animationSpeed: 1000,
            easing: '',
            autoplay: true,
            autoplaySpeed: 4000,
            keyBrowse: false
        });

        jQuery(window).resize(function() {
            jQuery('.playSlider').empty()
                .html(playslider)
                .playSlider({
                    animationSpeed: 1000,
                    easing: '',
                    autoplay: true,
                    autoplaySpeed: 4000,
                    keyBrowse: false
                });
        });
    });
    </script>
    <!--/ playSlider -->
</div>
<!--/ top slider -->