<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Beatheaven 1.0
 */
global $post; $count = 0;
$attachments = tfuse_get_gallery_images($post->ID,TF_THEME_PREFIX . '_track_songs');  //tf_print($attachments);
$songs = array();
    if ($attachments) {
        foreach ($attachments as $attachment){
            $songs[] = array(
                'order'        =>$attachment->menu_order,
                'mp3'    => $attachment->guid,
                'title'       => $attachment->post_title
            );
        }
    }
?>
<?php $songs = tfuse_aasort($songs,'order');?>
<div class="post-image"><?php echo tfuse_media($return=false,$type = '');?></div>
    <h1><?php tfuse_custom_title();?></h1>
    <p><?php echo tfuse_page_options('track_desc');?></p>
    <div class="title_box title_box_small">
        <span class="icon <?php echo tfuse_page_options('track_icon');?>"></span>
        <h2><?php echo tfuse_page_options('track_title');?></h2>
    </div>
<?php if(!empty($attachments)):?>
    <div class="clear"></div>
    <div class="track_list">
        <div id="album_<?php echo $post->ID;?>" class="jp-jplayer"></div>
        <div id="jp_container_<?php echo $post->ID;?>" class="jp-audio">
            <div class="jp-type-playlist">
                <div class="jp-gui jp-interface clearfix">
                    <div class="jp-controls-wrap ">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-previous disabled" tabindex="1"><span class="icon-backward"></span></a></li>
                            <li><a href="javascript:;" class="jp-play" tabindex="1"><span class="icon-play"></span></a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1"><span class="icon-pause"></span></a></li>
                            <li><a href="javascript:;" class="jp-next" tabindex="1"><span class="icon-forward"></span></a></li>
                        </ul>
                    </div>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"><span class="jp-play-bar-knob"></span></div>
                        </div>
                    </div>
                    <div class="jp-time-holder">
                        <div class="jp-current-time"></div> / <div class="jp-duration"></div>
                    </div>
                </div>
                <div class="jp-playlist">
                    <ul class="jp-playlist-inner">
                        <li></li>
                    </ul>
                </div>
                <div class="jp-no-solution">
                    <span><?php _e('Update Required','tfuse'); ?></span>
                    <?php _e('To play the media you will need to either update your browser to a recent version or update your ','tfuse'); ?><a href="http://get.adobe.com/flashplayer/" target="_blank" rel="nofollow"><?php _e('Flash plugin','tfuse'); ?></a>.
                </div>
            </div>
        </div>
        <?php $rating_info = get_post_meta($post->ID, TF_THEME_PREFIX . '_rating', true); ?>
        <script>
            //<![CDATA[
            jQuery(document).ready(function($) {
                new jPlayerPlaylist({
                    jPlayer: "#album_<?php echo $post->ID;?>",
                    cssSelectorAncestor: "#jp_container_<?php echo $post->ID;?>"
                }, [
                        <?php foreach ($songs as $song) { $count++;
                            $current_rating = round($rating_info['rating_'.$post->ID.'_track_'.$count.'']['val'] / $rating_info['rating_'.$post->ID.'_track_'.$count.'']['count'], 0); ?>
                            {
                            title:"<span class='item-song'><?php echo $song['title'];?></span> \n\
                                    <span class='rating' id='rating_<?php echo $post->ID;?>_track_<?php echo $count;?>'>\n\
                                        <?php
                                            for($i=1; $i<=5; $i++){
                                                if($current_rating>=$i)
                                                    echo "<span class='star voted' rel='".$i."'></span>";
                                                else
                                                    echo "<span class='star' rel='".$i."'></span>";
                                            }
                                        ?>
                                    </span>",
                            mp3:"<?php echo $song['mp3'];?>"
                            },
                    <?php }?>
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
    </div>
<?php endif;?>
<?php the_content(); ?>
 <?php wp_link_pages(); ?>
<a href="<?php echo tfuse_page_options('itunes_link');?>" class="btn btn-primary btn-lg"><span class="icon icon-shopping-cart"></span><?php _e(' PURCHASE IN iTUNES STORE','tfuse'); ?></a> 