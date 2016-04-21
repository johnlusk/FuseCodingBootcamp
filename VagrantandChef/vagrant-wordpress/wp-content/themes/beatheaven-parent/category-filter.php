<?php tfuse_archive_header();?>
<?php $term_id = tfuse_get_current_term_id();?>
<?php if(tfuse_options('category_search','',$term_id)):?>
<?php
$cat = (get_query_var('cat')) ? get_query_var('cat') : '';
$term = (get_query_var('term')) ? get_query_var('term') : '';
?>
<!-- filters -->
<div class="white_row filters filter_short clearfix">
    <?php $terms = tfuse_get_search_categories();?>
    <?php $search_key = tfuse_get_sarch_id();?>
    <?php $slug = tfuse_get_current_term_slug();?>
    <form action="<?php echo home_url( '/' ) ?>" method="get" id="searchform" class="">
        <div class="filter_col filter_cat field_select">
            <?php if(!empty($terms)):?>
                <label for="filter_category" class="label_title">Category:</label>
                <select class="select_styled" name="<?php echo $search_key;?>" id="<?php echo $search_key;?>" onchange="getval(this);">
                    <?php if(!empty($slug)) $term_id = $slug;?>
                    <?php foreach ($terms as $key => $value):?>
                        <?php if($term_id == $key) $select = 'selected="selected"'; else $select = '';?>
                    <option <?php echo $select;?> value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif;?>
        </div>
        <div class="filter_col filter_search">
            <div class="inner">
                <input type="text" name="s" id="s" value="" class="s_filter" placeholder="<?php _e('Search selected category','tfuse');?>">
                <button type="submit" class="btn-search"><span class="icon icon-search"></span></button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function getval(sel) {
        <?php if(!empty($cat)):?>
                window.location.href = '?cat='+sel.value;
        <?php else:?>
            window.location.href = '?promos='+sel.value;
        <?php endif;?>
    }
</script>
<!--/ filters -->
<?php endif;?>