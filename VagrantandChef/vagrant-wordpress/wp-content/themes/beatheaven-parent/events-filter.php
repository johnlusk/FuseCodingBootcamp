<?php $date_calendar = tfuse_get_events_calendar();?>
<script>
jQuery(document).ready(function($) {
    <?php if(!empty($date_calendar)):?>
        var SelectedDates = {};
        <?php foreach ($date_calendar as $one_date) { ?>
             SelectedDates[new Date('<?php echo $one_date;?>')] = new Date('<?php echo $one_date;?>');
        <?php }?>
            
        jQuery("#filter_date").datepicker({
            dateFormat: 'yy/m/dd',
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            minDate: 0,
            showOtherMonths: true,
            firstDay: 1,
            beforeShowDay: function(date) {

                var Highlight = SelectedDates[date]; 

                if (Highlight) { 
                    return [true, "Highlighted", ''];
                }
                else {
                    return [true, '', ''];
                }
            }
        });
    <?php else:?>
        jQuery("#filter_date").datepicker({
            dateFormat: 'yy/m/dd',
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            minDate: 0,
            showOtherMonths: true,
            firstDay: 1
        });
    <?php endif;?>
});
</script>
<?php global $TFUSE; $term_id = tfuse_get_current_term_id();?>
<?php if(tfuse_options('category_search','',$term_id) || is_search()):?>
<!-- filters -->
<div class="white_row filters clearfix">
    <?php $terms = tfuse_get_search_event_categories();?>
    <?php $search_key = tfuse_get_sarch_id();?>
    <?php $slug = tfuse_get_current_term_slug();?>
    <form action="<?php echo home_url( '/' ) ?>" method="get" id="searchform" class="">
        
        <div class="filter_col filter_cat">
            <?php if(!empty($terms)):?>
                <label for="filter_category" class="label_title"><?php _e('Category','tfuse');?>:</label>
                <select class="select_styled events_filter" name="<?php echo $search_key;?>" id="<?php echo $search_key;?>" onchange="getval(this);">
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
                <input type="text" name="s" id="s" value="" class="s_filter" placeholder="<?php _e('Search for an event','tfuse');?>">
                <button type="submit" class="btn-search"><span class="icon icon-search"></span></button>
            </div>
        </div>
    </form>
    <div class="filter_col filter_date">
        <label for="filter_date"><?php _e('Calendar','tfuse');?>:</label>
        <input type="text" name="filter_date" class="fieldGradient" onchange="getdateval(this);" value="" placeholder="<?php _e('Choose date','tfuse');?>" id="filter_date">
        <span class="icon icon-calendar"></span>
    </div>
</div> 
<script type="text/javascript">
    function getval(sel) {
        <?php if($TFUSE->request->GET('post_type')  == 'events'):?> 
            window.location.href = '?s=a&post_type=events&events='+sel.value;
        <?php else:?>
            window.location.href = '?events='+sel.value;
        <?php endif;?>
    }
    function getdateval(sel) {
        window.location.href = '?s=a&post_type=events&filter_date='+sel.value;
    }
</script>
<!--/ filters -->
<?php endif;?>