<?php 
    global $header_sh; 
    if ( !empty($header_sh['title']) || !empty($header_sh['shortcode'])) :
?>   
<div class="middle_top clearfix">
    <?php if ( !empty($header_sh['title'])) :?>
        <div class="title_box_big">
            <span class="title_icon"><i class="icon <?php echo $header_sh['icon'];?>"></i></span>
            <h1><?php echo $header_sh['title'];?></h1>
            <div class="subtitle"><?php echo $header_sh['desc'];?></div>
        </div>
    <?php endif;?>
    <?php     if ( !empty($header_sh['shortcode'])) :?>
        <div class="middle_top_media dark_bg">
            <?php echo do_shortcode($header_sh['shortcode']);?>
        </div>
    <?php endif;?>
</div>
<?php endif;?>

