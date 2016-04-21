<?php 
    global $header_img2; 
    if ( !empty($header_img2['title']) || !empty($header_img2['img'])) :
?>   
<div class="middle_top clearfix">
    <?php if ( !empty($header_img2['title'])):?>
        <div class="title_box_big">
            <span class="title_icon"><i class="icon <?php echo $header_img2['icon'];?>"></i></span>
            <h1><?php echo $header_img2['title'];?></h1>
            <div class="subtitle"><?php echo $header_img2['desc'];?></div>
        </div>
    <?php endif;?>
    <?php if ( !empty($header_img2['img'])):?>
        <div class="middle_top_media">
            <img src="<?php echo TF_GET_IMAGE::get_src_link($header_img2['img'], 550, 320); ?>" alt="">
        </div>
    <?php endif;?>
</div>
<?php endif;?>