</div>
<?php
    $home = tfuse_is_homepage();
    $cat_ids = tfuse_get_categories_ids();
    $allhome = tfuse_select_all_home();
    $allblog = tfuse_select_all_blog();
?>
<input type="hidden" value="<?php echo $home; ?>" name="homepage"  />
<input type="hidden" value="<?php echo $allhome; ?>" name="allhome"  />
<input type="hidden" value="<?php echo $allblog; ?>" name="allblog"  />
<input type="hidden" value="<?php echo $cat_ids; ?>" name="categories_ids"  />
<!--- footer -->
    <?php tfuse_footer();?>
    <div class="footer">
        <div class="container clearfix">
            <?php $footer_shortcodes = tfuse_options('footer_shortcodes');
            echo $page_shortcodes = apply_filters('themefuse_shortcodes', $footer_shortcodes);  ?>
            <div class="copyright">
                <p><?php echo tfuse_options('footer_left_copyright');?></p>
                <p><?php echo tfuse_options('footer_right_copyright');?></p>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>