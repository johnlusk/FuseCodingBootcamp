<?php $player = tfuse_player_enabled();?>
<?php if($player):?>
    <?php $songs = tfuse_options('site_player', array());?>
    <!--- top player -->
    <div class="top_player clearfix">
        <div id="jplayer_top" class="jp-jplayer"></div>
        <div id="jp_container_top" class="jp-audio">
            <div class="jp-type-playlist">
                <div class="jp-playlist">
                    <ul class="jp-playlist-inner">
                        <li></li>
                    </ul>
                </div>
                <div class="jp-gui jp-interface clearfix">
                    <div class="song_title_wrap">
                        <?php _e('Current Song','tfuse');?>:
                        <div class="song_title"></div>
                    </div>
                    <div class="next_song_title_wrap">
                        <?php _e('Next Song','tfuse');?>:
                        <div class="next_song_title"></div>
                    </div>
                    <div class="jp-controls-wrap">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-previous disabled" tabindex="1"><?php _e('previous','tfuse');?></a></li>
                            <li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play','tfuse');?></a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause','tfuse');?></a></li>
                            <li><a href="javascript:;" class="jp-next" tabindex="1"><?php _e('next','tfuse');?></a></li>
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"><span class="jp-play-bar-knob"></span></div>
                            </div>
                        </div>
                        <div class="jp-current-time"></div>
                        <div class="jp-duration"></div>
                    </div>
                    <div class="jp-knob-volume">
                        <input type="text" value="65" autocomplete="off" id="knob_volume">
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
            // Top Player
            var myPlaylist = new jPlayerPlaylist({
                jPlayer: "#jplayer_top",
                cssSelectorAncestor: "#jp_container_top"
            }, [
                <?php foreach($songs as $song): ?>
                {
                    title:"<span class='item-artist'><?php echo $song['title'];?></span>",
                    mp3:"<?php echo $song['url'];?>"
                },
                <?php endforeach;?>
            ], {
                loop: true,
                swfPath: "<?php echo get_template_directory_uri() ?>/js",
                supplied: "mp3",
                wmode: "window",
                smoothPlayBar: false,
                keyEnabled: false
            });
            // Volume Control
            function roundNumber(number, digits) {
                var multiple = Math.pow(10, digits);
                var rndedNum = Math.round(number * multiple) / multiple;
                return rndedNum;
            }
            var realVolume = roundNumber(jQuery("#knob_volume").val() / 100, 2);
            jQuery("#jplayer_top").jPlayer("volume", realVolume);

            jQuery("#knob_volume").knobRot({
                'classes': ['knob-volume'],
                'dragVertical': false,
                'frameCount': 49,
                'frameWidth': 56,
                'frameHeight': 56,
                'detent': true,
                'detentThreshold': 5,
                'minimumValue': 0,
                'maximumValue': 100,
                'hideInput': true,
                'callback': function(){
                    var realVolume = roundNumber(jQuery('#knob_volume').val() / 100, 2);
                    jQuery("#jplayer_top").jPlayer("volume", realVolume);
                }
            });
        });
        //]]>
    </script>
    </div>
    <!--/ top player -->
<?php endif;?>