<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since  Beatheaven 1.0
 */
?>

<?php
    /**
     * tfuse_user_profile() function is located in theme_config/theme_includes/THEME_FUNCTIONS.php
     * Create your own tfuse_user_profile() to override in a child theme or use filter tfuse_user_profile.
     * 
     * Specific wich fileds form user profile to retrive: first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
     * 
     * @since  Beatheaven 1.0
     */
    $author_meta = tfuse_user_profile(array('facebook','twitter','in','mojo'));
?>

<?php
    $author_description = get_the_author_meta('description');
    if (  tfuse_page_options('disable_author_info',tfuse_options('disable_author_info'))  ) :
?>
<!-- author description -->
<div class="author-description well clearfix">
    <div class="author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '76' ); ?></div>
    <div class="author-text">
        <h4 class="author-name"><?php echo get_the_author(); ?></h4>
        <p>
            <strong><?php _e('About the author','tfuse'); ?>:</strong> 
             <?php if ( !empty($author_description) ) echo $author_description; ?>
        </p>
        <div class="author-contact"><strong><?php _e('CONTACT THE AUTHOR','tfuse'); ?>:</strong>
            <?php if ( !empty($author_meta) ) : ?>
                <?php foreach($author_meta as $key => $item) :?>
                        <?php if($key == 'facebook'):?>
                            <a href="<?php echo $item;?>" class="icon-facebook-sign"></a>
                        <?php elseif($key == 'twitter'):?>
                            <a href="<?php echo $item;?>" class="icon-twitter-sign"></a>
                        <?php elseif($key == 'in'):?>
                            <a href="<?php echo $item;?>" class="icon-linkedin-sign"></a>
                        <?php endif; ?>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
    </div>
</div>
<?php endif; ?>