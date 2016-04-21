<!--- after content -->
<div class="after_content clearfix">
    <div class="title_box">
        <span class="icon <?php echo $slider['general']['slider_icon'];?>"></span>
        <h2><?php echo $slider['general']['slider_title'];?></h2>
    </div>
    <div class="albums_carousel">
        <ul class="carousel_content" id="albums_carousel">
            <?php $count = ''; foreach ($slider['slides'] as $slide): $count++;?>
                <li class="c_item">
                    <div id="jplayer_<?php echo $count;?>" class="jp-jplayer"></div>
                    <div id="jp_container_<?php echo $count;?>" class="jp-audio">
                        <div class="jp-type-playlist">
                            <div class="jp-playlist">
                                <ul class="jp-playlist-inner">
                                    <li></li>
                                </ul>
                            </div>
                            <div class="jp-gui jp-interface clearfix">
                                <div class="song_title_wrap">
                                    <a href="<?php echo $slide['slide_url'];?>"><img src='<?php echo TF_GET_IMAGE::get_src_link($slide['slide_img_src'], 158, 158); ?>'  alt=''/></a>
                                    <div class="song_title"></div>
                                </div>
                                <div class="jp-controls-wrap">
                                    <div class="jp-progress">
                                        <div class="jp-seek-bar">
                                            <div class="jp-play-bar"><span class="jp-play-bar-knob"></span></div>
                                        </div>
                                    </div>
                                    <ul class="jp-controls">
                                        <li><a href="javascript:;" class="jp-previous disabled" tabindex="1"><?php _e('previous','tfuse');?></a></li>
                                        <li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play','tfuse');?></a></li>
                                        <li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause','tfuse');?></a></li>
                                        <li><a href="javascript:;" class="jp-next" tabindex="1"><?php _e('next','tfuse');?></a></li>
                                    </ul>
                                    <div class="jp-current-time"></div>
                                    <div class="jp-duration"></div>
                                </div>
                                <div class="album_title_wrap">
                                    <div class="album_artist"><strong><?php echo $slide['slide_artist'];?></strong></div>
                                    <div class="album_title"><?php echo $slide['slide_title'];?></div>
                                    <div class="album_rating <?php echo $slide['slide_rating']?>">
                                        <span class="star1"></span><span class="star2"></span><span class="star3"></span><span class="star4"></span><span class="star5"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-no-solution">
                                <span><?php _e('Update Required','tfuse');?></span>
                                <?php _e('To play the media you will need to either update your browser to a recent version or update your ','tfuse');?><a href="http://get.adobe.com/flashplayer/" target="_blank" rel="nofollow"><?php _e('Flash plugin','tfuse');?></a>.
                            </div>
                        </div>
                    </div>


                    <script>
                    //<![CDATA[
                    jQuery(document).ready(function($) {
                        new jPlayerPlaylist({
                            jPlayer: "#jplayer_<?php echo $count;?>",
                            cssSelectorAncestor: "#jp_container_<?php echo $count;?>"
                        }, [
                            <?php foreach($slide['slide_songs'] as $song):?>
                                {
                                    title:"<span class='item-song'><?php echo $song['title'];?></span>",
                                    mp3:"<?php echo $song['mp3'];?>"
                                },
                            <?php endforeach;?>
                        ], {
                            loop: false,
                            swfPath: "<?php echo get_template_directory_uri() ?>/js",
                            supplied: "mp3",
                            wmode: "window",
                            smoothPlayBar: false,
                            keyEnabled: false
                        });

                    });
                    //]]>
                    </script>
                </li>
            <?php endforeach;?>
        </ul>
        <a class="prev" id="albums_carousel_prev" href="#"></a>
        <a class="next" id="albums_carousel_next" href="#"></a>
    </div>
    <script>
        jQuery(document).ready(function($) {
            jQuery('#albums_carousel').carouFredSel({
                next : "#albums_carousel_next",
                prev : "#albums_carousel_prev",
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
<!--/ after content -->