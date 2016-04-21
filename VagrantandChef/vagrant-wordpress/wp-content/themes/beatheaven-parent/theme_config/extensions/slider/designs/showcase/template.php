<!--- top slider -->
<div class="top_slider">
    <!-- showcase slider -->
    <div id="showcase" class="showcase">
        <?php foreach ($slider['slides'] as $slide):?>
            <div class="showcase-slide">
                <div class="showcase-content">
                    <a href="<?php echo $slide['slide_url'];?>"><img src="<?php echo $slide['slide_src'];?>" alt=""></a>
                </div>
                <div class="showcase-thumbnail">
                    <div class="showcase-thumbnail-content">
                        <p><?php echo $slide['slide_desc'];?></p>
                        <span class="showcase-cat"><i class="icon <?php echo $slide['slide_category_icon'];?>"></i> <?php echo $slide['slide_category_title'];?></span>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <!--/ showcase slider -->
</div>
<!--/ top slider -->