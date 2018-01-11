<?php // $product_type = get_post_meta($post->ID, 'product_type', true); ?>

<?php /* 
Config product in product list. You need to add some elements inside product (as in single.php) :
<a onclick="sel_config_prod_note('<?php echo $post_id ?>')" class="please_select notifi"></a>
<div class="form_notice"></div> 
 */ ?>

     <?php if($product_type == 'configurable') : ?>
     
     <div class="configurable">
     
     <?php $post_id = $post->ID; 
	 if( is_single() ) { $groupp_config_options = array(); } 
// To use config product in product list add the code in start of product list: " $groupp_config_options = array(); "
	$config_options = WOW_Attributes_Front::configurable_prod_options(); 
	 $groupp_config_options[$post_id] = $config_options;
	 
	 $options_5 = get_option('wow_settings_arr');
	 
	 if(count($config_options['attributes'])) : 
	 
$attributes_arr_7 = array();	

$conf_prod_desc = __('Please select product options');
if($options_5['wow_prod_configur_desc_1']) { $conf_prod_desc = $options_5['wow_prod_configur_desc_1']; }
$conf_prod_notice = __('Product options are not selected!');
if($options_5['wow_prod_configur_note_1']) { $conf_prod_notice = $options_5['wow_prod_configur_note_1']; }
	 ?>
<?php // print_r($config_options['table_2_atrs']); ?>



<?php $config_arr = array_keys($config_options);
if(!in_array('table_2_atrs-9', $config_arr)) : // /////////// // standart mode 
/* Якщо використовується таблиця з опціями (цінами), замінити код на 'table_2_atrs' */ ?>

<div class="configurable_desc"><?php echo $conf_prod_desc ?></div>

<form name="configurable_form_<?php echo $post_id ?>" class="c_form<?php if(count($config_options['attributes']) == 1) { ?> simple_conf<?php } ?>" > 
<?php foreach($config_options['attributes'] as $key4 => $config_atr) : 
$atr_code = $config_atr['code'];
$atr_label = $config_atr['frontend_label'];
if($config_atr['frontend_label_2']) { $atr_label = $config_atr['frontend_label_2']; }

$show_colors = 0;  if(strpos($atr_code, 'color') !== false and count($config_options['attributes']) > 1) { $show_colors = 1; }
$attributes_arr_7[] = $atr_code;  ?>
<div class="con_attribute atr-<?php echo $atr_code ?> <?php if(count($config_atr['atr_options']) == 1) { ?> options-1<?php } ?>">
<div class="tit"> <h4><?php echo $atr_label ?></h4> </div>
<ul>
<li style="display: none;"> <?php /* need for attributes_configur_filter */ ?>
    <input type="radio" name="<?php echo $atr_code ?>" id="<?php echo 'opt-'.$post_id.'-'.$atr_code.'-val-0' ?>" value="0" onchange="do_config_product('<?php echo $post_id ?>', '<?php echo $atr_code ?>')"  />
</li>
<?php foreach($config_atr['atr_options'] as $opt) { 
$opt_item_id = 'opt-'.$post_id.'-'.$atr_code.'-'.$opt['id'];

$label_style = '';  $label_class = 'con_item';
if($show_colors == 1) {
$color_code = 'EEE';  if($opt['color_code']) { $color_code = $opt['color_code']; }
$label_style = 'style=" background: #'.$color_code.';"';
$label_class = 'con_item show_colors';
}
?>
<li>
    <input type="radio" name="<?php echo $atr_code ?>" id="<?php echo $opt_item_id ?>" value="<?php echo $opt['id'] ?>" onchange="do_config_product('<?php echo $post_id ?>', '<?php echo $atr_code ?>')" class="gut_radio"<?php if(($key4 != 0) or ($opt['stock'] == 'out_of_stock')) { ?> disabled="disabled"<?php } ?> />
    <label for="<?php echo $opt_item_id ?>" class="<?php echo $label_class ?>" title="<?php if($show_colors == 1) { echo $opt['label']; } ?>" <?php echo $label_style ?>>
    <?php if(count($config_options['attributes']) == 1) { ?><div class="p_image"><?php if(has_post_thumbnail($opt['product_id'])) { echo get_the_post_thumbnail($opt['product_id'], 'thumbnail'); } else { echo '<div class="inn"> <img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" /> </div>'; } ?></div><?php } ?>
    <span><?php echo $opt['label'] ?></span>
    </label>
</li>
<?php } // foreach($config_atr['atr_options'] as $opt) ?>
</ul>
</div>
<?php endforeach; 
$groupp_config_options[$post_id]['attributes_7'] = $attributes_arr_7; 
?>
</form>







<?php else : // ($config_options['table_2_atrs']) // ///////// // table with products options ?>
<?php $prod_table_arr = $config_options['table_2_atrs']; 
$t_head_arr = $prod_table_arr[0];
unset($prod_table_arr[0]);
// $width_4 = (count($t_head_arr) * 65) + 140 - 5; 
?>
<div class="box-content produht_table">
<div class="title"> <?php dynamic_sidebar( 'prod_table_title' ); ?> </div>
<div id="configurable_prod_table" class="prod_table" <?php /* style="max-width: <?php echo $width_4 ?>px;"  */ ?> >
<div class="row row-0">
<?php $num_1 = 0;
foreach($t_head_arr as $key1 => $t_head_item) { 
$num_1++; ?>
<div class="colu colu-<?php echo $num_1 ?> option-<?php echo $key1 ?>"><div class="inn">
<?php if($num_1 == 1) { ?> <div class="lab_1"><?php echo $t_head_item[0] ?></div> <div class="lab_2"><?php echo $t_head_item[1] ?></div> <?php } else { echo $t_head_item; } ?>
</div></div>
<?php } ?>
</div>
<?php $num = 0;
foreach($prod_table_arr as $key8 => $table_roww) : 
$num++; ?>
<div class="row row-<?php echo $num ?> atr-option-<?php echo $key8 ?>">
<?php $num_2 = 0;
foreach($table_roww as $key9 => $table_item) { 
$num_2++; ?>
<div class="colu colu-<?php echo $num_2 ?> option-<?php echo $key9 ?>"><div class="inn">
<?php if($num_2 == 1) { ?><?php echo $table_item['text'] ?><?php } ?>
<?php if($table_item['prod_id']) { ?> <div class="salas" onmouseover="p_table_hover_4('colu-<?php echo $num_2 ?>', 'row-<?php echo $num ?>')" onmouseout="p_table_hover_4('')"><?php if($table_item['in_stock']) { ?><a onclick="show_addtocart_form_4('<?php echo $table_item['prod_id'] ?>', '<?php echo $table_item['label'] ?>')" title="<?php // echo $table_item['label'] ?>"><?php } ?> <?php echo $table_item['price'] ?> <?php if($table_item['in_stock']) { ?></a><?php } ?></div> <?php } ?> 
</div></div>
<?php } ?>
</div>
<?php endforeach; ?>
</div>
</div> <?php /* javascript - function p_table_hover_4(col_clas, row_clas) */ ?>

<?php endif; // ?>






<script type="text/javascript">
<?php /* 
*** Config product in single product or in product list *** 
To use config product in product list move this javascript to the end of product list  
*/ 
?>
	groupp_config_options = <?php echo json_encode($groupp_config_options) ?>;	
</script>

<script type="text/javascript">
<?php /* 
*** Config product in single product or in product list *** 
To use config product in product list move this javascript to footer 
*/ ?>
	/// groupp_config_options;
	
function do_config_product(post_id, atr_code) { 
	var products_atrs_arr = groupp_config_options[post_id]['products_atrs'];
	var prod_arr = groupp_config_options[post_id]['prod_arr'];
	var attributes_arr = groupp_config_options[post_id]['attributes_7'];
	
	var con_form_name = 'configurable_form_' + post_id;
    var con_form = document.forms[con_form_name];
	var elem_act = con_form.elements[atr_code]; 	
	var item_id = "post-item-" + post_id;
	var btn_cart = document.getElementById(item_id).getElementsByClassName("btn-cart")[0];
	var please_select5 = document.getElementById(item_id).getElementsByClassName("please_select")[0];	
		
	if(products_atrs_arr[atr_code] && (typeof products_atrs_arr[atr_code] != 'function')) { //////// \\\\\
	
	please_select5.style.display = "block";
	
	var next_atr = products_atrs_arr[atr_code]['next']; // alert(next_atr);
	var elem_act_key_2 = elem_act.value; // String(elem_act.value)
	if(products_atrs_arr[atr_code]['prev']) {  
	var prev_atrs = products_atrs_arr[atr_code]['prev'].split(','); // alert(prev_atrs); 
	var act_key_25 = '';
	for (var i6 = 0; i6 < prev_atrs.length; i6++) { act_key_25 = act_key_25 + con_form.elements[prev_atrs[i6]].value + '-'; } 
	elem_act_key_2 = act_key_25 + elem_act_key_2; 
	} // __ if(products_atrs_arr[atr_code]['prev'])	
	var next_av_values = '';
	if(products_atrs_arr[atr_code]['options'][elem_act_key_2]) { 
	next_av_values = products_atrs_arr[atr_code]['options'][elem_act_key_2]; // alert(next_av_values);
	}
	
	var el_next_2 = con_form.elements[next_atr];  el_next_2_arr = el_next_2; 
	/// if(el_next_2.length > 1) { el_next_2_arr = el_next_2; } else { el_next_2_arr = [el_next_2]; }
	for (var i = 0; i < el_next_2_arr.length; i++) {	 		
 		el_next_2_arr[i].checked = false; 
		if(next_av_values.indexOf(el_next_2_arr[i].value) != -1) { el_next_2_arr[i].disabled = false; }
		else { el_next_2_arr[i].disabled = true; }
	}

	if(products_atrs_arr[atr_code]['next-5']) {  
	var next_5_atrs = products_atrs_arr[atr_code]['next-5'].split(','); 
	for (var i6 = 0; i6 < next_5_atrs.length; i6++) { 
	var el_next_5 = con_form.elements[next_5_atrs[i6]];
		for (var i7 = 0; i7 < el_next_5.length; i7++) {			
 			el_next_5[i7].checked = false;  el_next_5[i7].disabled = true;
		}
	} 
	} // __ if([atr_code]['next-5'])

	jQuery(document).ready(function($) { //// show/hide attribute 
	var atrib_blok_1 = 'form[name="'+con_form_name+'"] .atr-' + next_atr;
	if(next_av_values.length > 1) { $(atrib_blok_1).addClass("show-attrib"); }
	else { $(atrib_blok_1).removeClass("show-attrib"); }
	});	
		
	<?php /* залишити 1 з 2-х наступних рядків; інший закоментувати */ ?>
	if(next_av_values.length == 1) { //// 1 option only is available - select this option 
	// if(next_av_values.length > 0) { //// always select 1-st available option by default
	jQuery(document).ready(function($) {
	var input_1 = 'form[name="'+con_form_name+'"] input[name="'+next_atr+'"][value="'+next_av_values[0]+'"]';
	$(input_1).prop('checked', true).trigger('change');
	});	
	} //// __ 1 option only is available 
	
	} else { // ////////// \\\\\ \\\\\ Last attribute 
	
	var prod_ids = Object.keys(prod_arr);
	var prod_id_activ = prod_ids[0];
	// alert(attributes_arr);
	for (var i2 = 0; i2 < prod_ids.length; i2++) {
		non_prod_id = 0;
		for (var i = 0; i < attributes_arr.length; i++) {
			var atr_val_54 = con_form.elements[attributes_arr[i]].value;
			if(prod_arr[prod_ids[i2]]['options'][attributes_arr[i]] != atr_val_54) { non_prod_id = 1; }
			// alert(prod_arr[prod_ids[i2]][attributes_arr[i]]);
		}
		if(non_prod_id == 0) { prod_id_activ = prod_ids[i2]; }
	} // for prod_ids 
<?php /* заміна id товару у формі або в кнопці */ ?>	
<?php if( is_single() ) { ?>
	var input_qty = document.getElementById(item_id).getElementsByClassName("product-qty")[0]; 
	input_qty.setAttribute("name", "product_form[" + prod_id_activ + "]");
<?php } else { ?>
	btn_cart.setAttribute("onclick", "addtocart('" + prod_id_activ + "', '1')"); 
<?php } ?> 
	 update_page_config_prod(post_id, prod_id_activ); 
	 	 please_select5.style.display = "none";
		 sel_config_prod_note(post_id, 'hide');
		 	 
	} // ////////// \\\\\ Last attribute 
}


function update_page_config_prod(post_id, prod_id_activ) {
<?php /* ajax_prepare_html(), sidebar_replace_new(), page_replace_new() - розміщені в e_shop_scripts.php (footer) */ ?>
	var item_id = "post-item-" + post_id;
	var prod_info_sect = document.getElementById(item_id).getElementsByClassName("product_info")[0];
	var prod_url = groupp_config_options[post_id]['prod_arr'][prod_id_activ]['url']; 

	ajax_prepare_html(prod_info_sect); 
	
  new Ajax.Updater( page_temp.id, prod_url, { 
  	method: 'post',
	parameters: { popupp: 1 }, // ajax_loadd  popupp 
	evalScripts: true, //
	onComplete: 
		function() { 
			// sidebar_replace_new('.images-box');
			sidebar_replace_new_2(post_id, '.images-box');
			sidebar_replace_new_2(post_id, '.prod-avail-sku');
			sidebar_replace_new_2(post_id, '.main_price_box');
			// .short-descr / .main-descr  
			page_replace_new(prod_info_sect); 
		}
	} );
}


function sidebar_replace_new_2(post_id, sidebar_class) {  // ??
	sidebar_new_info = $('ajax_page2_temp').down(sidebar_class).innerHTML;
	var item_id = "post-item-" + post_id;	
	var class_1 = "#"+item_id + " "+sidebar_class; 
	$$(class_1).each( function(el) { el.innerHTML = sidebar_new_info; } );
}


function sel_config_prod_note(post_id, par) {
	var item_id = "post-item-" + post_id;  
	var con_notice = document.getElementById(item_id).getElementsByClassName("form_notice")[0];
	var notice_text = "<?php echo $conf_prod_notice ?>";
		if(par != 'hide') {   
	con_notice.className += ' error';
	con_notice.innerHTML = notice_text;
		}
		else { con_notice.className = 'form_notice'; con_notice.innerHTML = ''; }
}


function filter_config_prod(atr_code, atr_value) {
jQuery(document).ready(function($) {
	// $('input[type="radio"][name="location"][value="4"]').attr('checked',true).trigger('change');
	var input_0 = 'input[name="'+atr_code+'"][value="0"]';
	var input_2 = 'input[name="'+atr_code+'"][value="'+atr_value+'"]';
	$(input_0).prop('checked', true).trigger('change');
	$(input_2).prop('checked', true).trigger('change');
});	
}

<?php /*  if( !is_single() ) : ?>
window.onload = function() {
	filter_config_prod('location', '4');
}
<?php endif; */ ?>

</script>


<script type="text/javascript">
function show_addtocart_form_4(prod_id, prod_label){
		   var item_qty = document.getElementById("lig_qty");
		   var prod_form_name = 'product_form[' + prod_id + ']';
		   item_qty.setAttribute('name', prod_form_name);
		   item_qty.setAttribute('value', 1);  item_qty.value = 1;
		   // item_qty.name = qtyy;
		   var prod_name_div = document.getElementById("lightb_addtocart_prod_name");
		   prod_name_div.innerHTML = prod_label;
document.getElementById("overlay_2").style.display = "block";
var addtocart_form = document.getElementById("lightb_addtocart_form");
var scroll_y = document.body.scrollTop || document.documentElement.scrollTop;
addtocart_form.style.top = scroll_y + 150 + "px";
addtocart_form.style.display = "block";
} 

function p_table_hover_4(col_clas, row_clas) {
	var prod_table = document.getElementById("configurable_prod_table");
	var tabl_cols = prod_table.getElementsByClassName("colu");
 for (var i = 0; i < tabl_cols.length; i++) { 
 var colu_l = tabl_cols[i];  colu_l.className = colu_l.className.replace(/act/g, '');
 }
 	if(col_clas && row_clas) {
	var row_0_my_col = prod_table.getElementsByClassName("row-0")[0].getElementsByClassName(col_clas)[0];
	row_0_my_col.className += " act";
	var col_0_my_row = prod_table.getElementsByClassName(row_clas)[0].getElementsByClassName("colu-1")[0];
	col_0_my_row.className += " act";
	}
}	
</script>


<?php endif; // count($config_options['attributes']) ?>

     </div>
 
	 <?php endif; // ($product_type == 'configurable') ?>



<?php /* 
<?php // Фільтр для конф. товарів (по опціях одного чи декількох конф. атрибутів)
$prod_s_query = new WP_Query($prod_args);
// ... ... 
$post_1st_id = $prod_s_query->posts[0]->ID;
$atrs_conf_filter = WOW_Attributes_Front::attributes_configur_filter($post_1st_id);
?>
<?php if(count($atrs_conf_filter)) : ////// config product filter 2 ///// ?>
<div class="atrs_conf_filter">
<?php foreach($atrs_conf_filter as $key4 => $config_filt_atr) : 
$atr_code = $config_filt_atr['code'];
$show_colors = 0;  if(strpos($atr_code, 'color') !== false) { $show_colors = 1; } ?>
<div class="con_filt_attribute atr-<?php echo $atr_code ?>">
<div class="tit"> <h5><?php echo $config_filt_atr['frontend_label'] ?></h5> </div>
<ul>
<?php foreach($config_filt_atr['atr_options'] as $opt) { 
$opt_item_id = 'filt-opt-'.$atr_code.'-'.$opt['id'];
$opt_label = $opt['label'];
if($config_filt_atr['frontend_unit']) { $opt_label = $opt_label.' <em>'.$config_filt_atr['frontend_unit'].'</em>'; }
$label_style = '';  $label_class = 'con_item';
if($show_colors == 1) {
$color_code = 'EEE';  if($opt['color_code']) { $color_code = $opt['color_code']; }
$label_style = 'style=" background: #'.$color_code.';"';
$label_class = 'con_item show_colors';
}
?>
<li>
    <input type="radio" name="filt-<?php echo $atr_code ?>" id="<?php echo $opt_item_id ?>" value="<?php echo $opt['id'] ?>" onchange="filter_config_prod('<?php echo $atr_code ?>', '<?php echo $opt['id'] ?>')" class="gut_radio gut_radio-2" />
    <label for="<?php echo $opt_item_id ?>" class="<?php echo $label_class ?>" <?php echo $label_style ?>><span><?php echo $opt_label ?></span></label>
</li>
<?php } // foreach($config_atr['atr_options'] as $opt) ?>
</ul>
</div>
<?php endforeach; ?>
</div>
<?php endif; ////// ___ config product filter 2 ///// ?>
 */ ?>
