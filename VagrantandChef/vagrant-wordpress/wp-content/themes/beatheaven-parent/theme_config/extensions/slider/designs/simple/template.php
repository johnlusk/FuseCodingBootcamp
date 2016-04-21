<div class="middle_top clearfix">
    <?php if(!empty($slider['general']['slider_title'])):?>
        <div class="title_box_big">
            <span class="title_icon"><i class="icon <?php echo $slider['general']['slider_icon'];?>"></i></span>
            <h1><?php echo $slider['general']['slider_title'];?></h1>
            <div class="subtitle"><?php echo $slider['general']['slider_description'];?></div>
        </div>
    <?php endif; ?>

    <div class="middle_top_media dark_bg">
        <!-- media slider -->
        <div class="top_media_slider">
            <ul class="slider_content" id="slider_media">
                <?php foreach ($slider['slides'] as $slide):?>
                    <li class="slider_item">
                        <a href="<?php echo $slide['slide_url'];?>">
                            <img src="<?php echo $slide['slide_src'];?>" alt="">
                            <?php if($slide['slide_featured'] != 'none'):?>
                                <span class="ribbon ribbon-teal">
                                    <span class="ribbon-text"><?php echo strtoupper($slide['slide_featured']);?></span>
                                </span>
                            <?php endif;?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
            <a class="prev" id="slider_media_prev" href="#"></a>
            <a class="next" id="slider_media_next" href="#"></a>
        </div>

        <script>
            jQuery(document).ready(function($) {
                jQuery('#slider_media').carouFredSel({
                    next : "#slider_media_next",
                    prev : "#slider_media_prev",
                    auto: false,
                    width: "100%",
                    height: "auto",
                    infinite: true,
                    circular: true,
                    scroll: {
                        items : 1
                    }
                });
            });
        </script>
        <!--/ media slider -->
    </div>
</div>