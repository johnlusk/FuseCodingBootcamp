<?php 
    global $header_img; 
    if ( !empty($header_img['title']) || !empty($header_img['img'])) :
?>   
<div class="middle_top clearfix">
    <?php if ( !empty($header_img['title'])):?>
        <div class="title_box_big">
            <span class="title_icon"><i class="icon <?php echo $header_img['icon'];?>"></i></span>
            <h1><?php echo $header_img['title'];?></h1>
            <div class="subtitle"><?php echo $header_img['desc'];?></div>
        </div>
    <?php endif;?>
    <?php if ( !empty($header_img['img'])):?>
        <div class="middle_top_media dark_bg">
            <img src="<?php echo TF_GET_IMAGE::get_src_link($header_img['img'], 550, 320); ?>" alt="">
        </div>
    <?php endif;?>
</div>
<?php endif;?>