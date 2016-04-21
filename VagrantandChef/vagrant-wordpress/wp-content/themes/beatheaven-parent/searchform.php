<div class="widget-container widget_search">
    <h3 class="widget-title"><?php _e('SEARCH WIDGET:','tfuse');?></h3>
    <label class="screen-reader-text" for="s"><?php _e('Search for','tfuse');?>:</label>
    <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
        <input type="text" value="" placeholder="<?php _e('Search this blog','tfuse');?>" name="s" id="s" class="inputField" />
        <button type="submit" id="searchsubmit"  class="btn btn-primary btn-sm"><span class="icon icon-search"></span></button>
    </form>
</div>
