<?php /* Сайт. Фільтри - сторінка категорії (index.php). */ ?>
<?php // if(is_archive()) : ?> 
<?php if(is_archive()) { $filt = ''; } 
elseif(is_page() or is_front_page()) { $filt = 'advanced'; }
$attributes_filter = WOW_Attributes_Front::attributes_filter($filt);
?> 

<?php /* attributes_filter() - фільтр, що показує усі атрибути і опції, доступні для фільтрації у даній категорії; */ ?>

<?php if(count($attributes_filter)) : ?>
<div class="block sidebar_filter open">
<?php if($filt != 'advanced') { ?>
<div class="block-title">
<span><?php _e('Products filter') ?></span>
<a class="toogle-b"></a>
</div>
<?php } ?>
<div class="block-content" style="display:block;">
<form name="filter_form" id="filter_form_co" method="GET" action="">

<?php if($_GET) { ///////////// active filters ?>
<div class="state">
<?php $active_filters = WOW_Attributes_Front::attributes_active_filters(); ?>
<?php foreach ($active_filters as $attribute) : 
$show_colors = 0; 
if(strpos($attribute['code'], 'color') !== false) { $show_colors = 1; }
?>
<div class="atrib"> 
<div class="a_title"><?php echo $attribute['frontend_label'] ?><span>: </span></div> 
<div class="a_value">
<?php if($attribute['backend_input'] != 'text') { /// 
foreach ($attribute['atr_options'] as $option) : 
$label_class_2 = '';  $label_style = ''; 
if($show_colors == 1) {
$color_code = 'EEE';  if($option['color_code']) { $color_code = $option['color_code']; }
$label_class_2 = ' show_colors';  $label_style = 'style=" background: #'.$color_code.';"';
}
?> 
<div class="opt<?php echo $label_class_2 ?>"><a onclick="filter_remove('<?php echo 'filt-'.$attribute['code'].'-'.$option['id'] ?>')" title="<?php _e('Clear') ?>"><span class="lab" <?php echo $label_style ?>><?php echo $option['label'] ?><?php if($attribute['frontend_unit']) { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } ?></span> <span class="btn-remove"><i class="ha ha-close"></i></span></a></div> <?php endforeach; 
} else { /// $attribute['backend_input'] == 'text' ?> 
<a onclick="filter_remove('<?php echo 'input_filt_value-'.$attribute['code'] ?>')" title="<?php _e('Clear') ?>"><span class="val"><?php echo $attribute['value']; ?></span> <span class="btn-remove"><i class="ha ha-close"></i></span></a>
<?php } ?>
</div>
</div>
<?php endforeach; ?>
<div class="button_line"> <a class="button small clear_all" onclick="posts_filter('clear_all')" title="<?php _e('Clear all') ?>"><?php _e('Clear all') ?></a> </div>
<script type="text/javascript">
function filter_remove(option_id){
	var input_el = document.getElementById(option_id);
	input_el.value = '';  if (input_el.type == 'checkbox') { input_el.checked = false; } ///
	posts_filter();
}
</script>
</div>
<?php } ////////// __ active filters ?>

<div class="attributes_filt">
<?php foreach ($attributes_filter as $attribute) : 
$atr_code = $attribute['code'];
$show_colors = 0;  $check_class = 'fine_checkbox';  
if(strpos($atr_code, 'color') !== false) { $show_colors = 1;  $check_class = 'gut_checkbox'; }
?>
<div class="attrib_blok<?php if($show_colors == 1) { ?> attrib_colors<?php } ?>" id="filt-<?php echo $atr_code ?>">
<div class="atr_title"><?php echo $attribute['frontend_label'] ?></div>

<?php if($attribute['backend_input'] != 'text') :  // $attribute['backend_input'] == 'select' ?>

<?php $atr_tit = '<b>'.$attribute['frontend_label'].'</b>';  $act_values = array(); 
if($_GET) { $req_arr = array_keys($_GET);  if (in_array($atr_code, $req_arr)) {
$atr_tit = $active_filters[$atr_code]['atr_options'][0]['label']; 
$act_values = explode("-", $_GET[$atr_code]); 
} } ?>

<?php $front_type_select = 0; // 0 - checkbox,  1 - select
if($front_type_select == 1) { // front_type select ?>

<div class="op_select">
 <a class="select_title" title="<?php echo $attribute['frontend_label'] ?>" onclick="select_open(this)"> <div class="inn"> <?php echo $atr_tit ?> </div> <i class="ja ja-caret-down"></i> </a> 
<div class="drop">
<div class="op_option all_options" <?php if(!$_GET[$atr_code]) { ?>style="display:none;"<?php } ?>>
<?php $item_id_1 = 'filt-'.$atr_code.'-all'; ?>
<input type="radio" id="<?php echo $item_id_1 ?>" name="<?php echo $atr_code ?>" value="" onchange="posts_filter()" /> 
<label for="<?php echo $item_id_1 ?>" onclick="select_change(this)" class="inn"><span style="display:none;"><b><?php echo $attribute['frontend_label'] ?></b></span> <span><?php _e('View all') ?><?php // _e('All options') ?></span></label>
</div>
<?php $num = 0; ?>
<?php foreach ($attribute['atr_options'] as $option) { 
$num++;
$item_id = 'filt-'.$atr_code.'-'.$option['id']; // $item_id = $attribute['code'].'-'.$num; 
?>
<div class="op_option <?php if(in_array($option['id'], $act_values)) { ?>selected<?php } ?>">
<input type="radio" id="<?php echo $item_id ?>" name="<?php echo $atr_code ?>" value="<?php echo $option['id'] ?>" onchange="posts_filter()" <?php if(in_array($option['id'], $act_values)) { ?>checked="checked" <?php } ?>/> 
<label for="<?php echo $item_id ?>" onclick="select_change(this)" class="inn"><span><?php echo $option['label'] ?><?php if($attribute['frontend_unit']) { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } ?></span></label>
</div>
<?php } ?>
</div>
</div>

<?php } else { // front_type checkbox ?>

<ul>
<?php $num = 0; ?>
<?php foreach ($attribute['atr_options'] as $option) { 
$num++; 
$item_id = 'filt-'.$atr_code.'-'.$option['id']; // $item_id = $attribute['code'].'-'.$num; 

$label_style = '';  $label_class = 'filt_item';
if($show_colors == 1) {
$color_code = 'EEE';  if($option['color_code']) { $color_code = $option['color_code']; }
$label_style = 'style=" background: #'.$color_code.';"';
$label_class = 'filt_item show_colors';
}
?>
<li>
<input type="checkbox" class="<?php echo $check_class ?>" id="<?php echo $item_id ?>" name="<?php echo $atr_code ?>" value="<?php echo $option['id'] ?>"<?php if($filt != 'advanced') { ?> onchange="posts_filter()"<?php } ?> <?php if(in_array($option['id'], $act_values)) { ?>checked="checked" <?php } ?>/> 

<label for="<?php echo $item_id ?>" class="<?php echo $label_class ?>" title="<?php echo $option['label'] ?>" <?php echo $label_style ?>><span><?php echo $option['label'] ?><?php if($attribute['frontend_unit']) { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } ?></span></label>
</li>
<?php } ?>
</ul>
<?php } // ____ front_type checkbox ?>

<?php else : /// $attribute['backend_input'] == 'text' ?>
<?php $value_min = $attribute['atr_text_val'][0]; $value_max = $attribute['atr_text_val'][1];
$atr_val_step = 1; $atr_val_step = $attribute['atr_text_val_step'];
$value_1 = $value_min;  $value_2 = $value_max;
$cur_input_value = '';
$act_values = array();
$symb = $attribute['frontend_unit'];
$kurs = 1; if($attribute['atr_text_currency_kurs']) { $kurs = $attribute['atr_text_currency_kurs']; }
$round_to = 0; if($attribute['atr_text_round_to']) { $round_to = $attribute['atr_text_round_to']; }

if($_GET) { $req_arr = array_keys($_GET); if (in_array($atr_code, $req_arr)) { 
$cur_input_value = $_GET[$atr_code];
$act_values = explode("--", $_GET[$atr_code]);
$value_1 = $act_values[0];  $value_2 = $act_values[1];
} } 

$filter_slider_text_inp = 0; ////  // 0, 1 
$filt_slider_change_f = 'filter_slider_change_'.$atr_code;
$f_min_val_id = 'filt_min_value-'.$atr_code;  $f_max_val_id = 'filt_max_value-'.$atr_code;
?> 
<script type="text/javascript">
function <?php echo $filt_slider_change_f ?>() {	
    var kurs = <?php echo $kurs ?>; // alert(kurs); 
	var round_to = <?php echo $round_to ?>;
	var filt_slider_input = document.getElementById("input_filt_value-<?php echo $atr_code ?>");
	var filt_min = document.getElementById("<?php echo $f_min_val_id ?>");
	var filt_max = document.getElementById("<?php echo $f_max_val_id ?>");
	var filt_min_val = (filt_min.value / kurs).toFixed(0); 
	var filt_max_val = (filt_max.value / kurs).toFixed(0);
	filt_slider_input.setAttribute('value', (filt_min_val + '--' + filt_max_val));  
	posts_filter();
}

<?php /* need jquery-ui  - wp_enqueue_script('jquery-ui-slider'); */ ?>
	window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
jQuery(document).ready(function($) { 
    var kurs = <?php echo $kurs ?>; 
	var round_to = <?php echo $round_to ?>;
	var filt_slider_id = '#filter_slider_<?php echo $atr_code ?>';
	var filt_min_value = document.getElementById("<?php echo $f_min_val_id ?>");
	var filt_max_value = document.getElementById("<?php echo $f_max_val_id ?>");
	$(filt_slider_id).slider({
        range: true,
        min: <?php echo $value_min ?>,
        max: <?php echo $value_max ?>,
        step: <?php echo $atr_val_step ?>,
        values: [<?php echo $value_1 ?>, <?php echo $value_2 ?>],
        slide: function (event, ui) {
            $("#input_filt_value-<?php echo $atr_code ?>").val(ui.values[0] + '--' + ui.values[1]);
			filt_min_value.value = (ui.values[0] * kurs).toFixed(round_to);
			filt_max_value.value = (ui.values[1] * kurs).toFixed(round_to);
        },
        stop: function (event, ui) {           
			 <?php if($filt != 'advanced') { ?>
			 posts_filter();
			 <?php } ?>	
        }
    });   
	$("#input_filt_value-<?php echo $atr_code ?>").val('<?php echo $cur_input_value ?>');
	// filt_min_value.value = ($(filt_slider_id).slider("values", 0) * kurs).toFixed(round_to);
	filt_min_value.value = (<?php echo $value_1 ?> * kurs).toFixed(round_to);
	filt_max_value.value = (<?php echo $value_2 ?> * kurs).toFixed(round_to);
});
    }, false); // __ after jQuery is loaded 
</script>
                <div class="filter_slider">
      <span class="values"> 
      <span class="min_value">
      <input type="text" id="<?php echo $f_min_val_id ?>" size="5" <?php if($filter_slider_text_inp == 1) { ?>onchange="<?php echo $filt_slider_change_f ?>()"<?php } else { ?>class="inp_hid" readonly="readonly"<?php } ?> /> <span class="symb"><?php echo $symb ?></span>
      </span> 
      <span class="max_value">
      <input type="text" id="<?php echo $f_max_val_id ?>" size="5" <?php if($filter_slider_text_inp == 1) { ?>onchange="<?php echo $filt_slider_change_f ?>()"<?php } else { ?>class="inp_hid" readonly="readonly"<?php } ?> /> <span class="symb"><?php echo $symb ?></span>
      </span>
      </span>                    
      <div class="f_slider_track"> <div id="filter_slider_<?php echo $atr_code ?>"></div> </div>
          <input type="hidden" name="<?php echo $atr_code ?>" id="input_filt_value-<?php echo $atr_code ?>" value="" />
                </div>
<?php endif; ?>

</div>
<?php endforeach; ?>
</div>

<?php if($filt == 'advanced') { ?>
<div class="button_line"> <a class="button a_search" onclick="posts_filter()" title="<?php _e('Search') ?>"><?php _e('Search') ?></a> </div>
<?php /* 
// Головна стор. Розширений пошук 
<div class="button_line"> <a class="button a_search" id="prod_search_button" onclick="posts_filter('prod_search')" href="<?php bloginfo('url'); echo '/objects/' ?>" title="<?php echo $search_label ?>"><?php echo $search_label ?></a> </div>
 */ ?>
<?php } ?>

<?php 
// $sort_code = 'title'; $sort_dir = 'asc'; // $sort_code = 'date'; $sort_dir = 'desc';
$sort_code = ''; $sort_dir = ''; $per_page = '';
	if($_GET) { 
		$req_arr = array_keys($_GET);
		if (in_array('per_page', $req_arr)) { $per_page = $_GET['per_page']; }
		if (in_array('order', $req_arr)) { $sort_dir = $_GET['order']; }
		if (in_array('orderby', $req_arr)) { $sort_code = $_GET['orderby']; }
	} if($_GET) 
/* 
$view_mode = WOW_Product_List_Func::get_view_mode();
  */
?>

<?php if($_GET) { $req_arr = array_keys($_GET); if (in_array('par', $req_arr)) { ?>
<input type="hidden" name="par" value="<?php echo $_REQUEST['par'] ?>" />
<?php } } ?>
<input type="hidden" name="orderby" value="<?php echo $sort_code ?>" />
<input type="hidden" name="order" value="<?php echo $sort_dir ?>" />
<input type="hidden" name="per_page" value="<?php echo $per_page ?>" />
<?php /* <input type="hidden" name="view_mode" value="<?php echo $view_mode ?>" /> */ ?>
</form>
</div>
<?php /* script 'posts_filter()' - підключено в head (/lib/wow_attributes/js/posts_filter.js) */ ?>
</div> <!--  -->
<?php endif; ?>
<?php // endif; // (is_archive()) ?>