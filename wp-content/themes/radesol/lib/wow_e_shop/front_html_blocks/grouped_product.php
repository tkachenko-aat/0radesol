<?php // $product_type = get_post_meta($post->ID, 'product_type', true); ?>

    <?php if($product_type == 'grouped') : ?>
<?php 
	$options_5 = get_option('wow_settings_arr');
	$act_currency_arr = WOW_Product_List_Func::get_act_currency();
	$kurs = $act_currency_arr['rate']; 
	$round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }  if(preg_match("/[^0-9]/", $round_to)) { $round_to = 0; }

	// $post_id = $post->ID; 
	$price_base = 0;
	if(get_post_meta($post_id, 'price', true)) { $price_base = get_post_meta($post_id, 'price', true); }
	if(get_post_meta($post_id, 'special_price', true)) { $price_base = get_post_meta($post_id, 'special_price', true); }
	$disc = WOW_Attributes_Front::product_get_discount($post_id); // $disc = 0;
	
$product_parts = get_post_meta($post->ID, 'grouped_product_parts', true);
$product_parts_arr = explode(',', $product_parts);
$product_parts_base = get_post_meta($post->ID, 'grouped_product_parts_base', true);
$product_parts_base_arr = explode(',', $product_parts_base);
$prod_parts_5_arr = array();
$product_parts_arr_2 = array_diff($product_parts_arr, $product_parts_base_arr);

$product_parts_groups = array(
	'parts_all' => array('title' => __('Components'), 'items' => $product_parts_arr),
);
/* 
$product_parts_groups = array(
	'parts_base' => array('title' => __('Main components'), 'items' => $product_parts_base_arr),
	'parts_other' => array('title' => __('Additional components'), 'items' => $product_parts_arr_2),
);
 */
$grouped_prod_desc = __('Please select product components');
if($options_5['wow_prod_grouped_desc_1']) { $grouped_prod_desc = $options_5['wow_prod_grouped_desc_1']; }

if( $product_parts and count($product_parts_arr) ) :  

foreach($product_parts_groups as $key6 => $part_group) : 

$parts_arr = $part_group['items'];
if(count($parts_arr)) : 

$parts_args_5 = array (       
    'post_type'  => 'any',
	'post__in' => $parts_arr,
    'posts_per_page' => -1,
    'order' => 'ASC', 
    'orderby' => 'menu_order',
    'post_status' => array('publish', 'draft')
    );

$prod_parts_query = new WP_Query($parts_args_5);
    if( $prod_parts_query->have_posts() ) : ?> 
<div class="configurable prod_parts <?php echo $key6 ?>">
<h4><?php echo $part_group['title'] ?></h4>
<div class="configurable_desc"><?php echo $grouped_prod_desc ?></div>
<ul class="">
<?php while ($prod_parts_query->have_posts()) : 
  $prod_parts_query->the_post(); ////// 
  $part_id = $post->ID;
  $part_inp_id = 'grouped-part-'.$part_id;
  $price_5 = get_post_meta($part_id, 'price', true);  if(!$price_5 or preg_match("/[^0-9.]/", $price_5)) { $price_5 = 0; }
  $prod_parts_5_arr[$part_id]['price'] = $price_5;
  $check_class_1 = 'check_product_parts';
  ?>
<li> 
<input type="checkbox" class="gut_checkbox <?php echo $check_class_1 ?>" name="product_parts[<?php echo $post_id ?>][<?php echo $part_id ?>]" id="<?php echo $part_inp_id ?>" value="1" onchange="grouped_change_price_9('<?php echo $check_class_1 ?>')"<?php if(in_array($part_id, $product_parts_base_arr)) { ?> checked="checked"<?php } ?> />
<label class="con_item" for="<?php echo $part_inp_id ?>" title="<?php the_title(); ?>"> 
<div class="p_image"><?php if(has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } else { echo '<div class="inn"> <img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" /> </div>'; } ?></div>
<span><?php the_title(); ?></span>
<?php $part_price = WOW_Attributes_Front::product_get_price(); ?> 
<div class="price-box-2"><?php  echo $part_price ?></div>
</label>
</li>
<?php endwhile; ?>
</ul>
</div>
<?php endif;  wp_reset_query(); // if( $regi_query->have_posts() ) 

endif;
endforeach; // foreach($product_parts_groups as $key6 => $part_group) 
?>
 
<script type="text/javascript">
<?php $price_4_id = 'total_grouped_price_dw'; ?>
function grouped_mod_price_box() {
	var price_box_4 = document.getElementsByClassName("main_price_box")[0].getElementsByClassName("price")[0];
	var text_4 = price_box_4.innerHTML;
	var text_4_new = '<b id="<?php echo $price_4_id ?>">' + text_4.replace('<span', '</b><span');
	price_box_4.innerHTML = text_4_new;
}
setTimeout( 'grouped_mod_price_box()', 0 ); 

	prod_parts_5_arr = <?php echo json_encode($prod_parts_5_arr) ?>;
	kurs = parseFloat(<?php echo $kurs ?>);
	round_to = parseFloat(<?php echo $round_to ?>); /////

function grouped_change_price_9(check_class) { 
	var price_base = parseFloat(<?php echo $price_base; ?>); 
	var price_2 = price_base;
	var disc = parseFloat(<?php echo $disc ?>); 
	var input_checks = document.getElementsByClassName(check_class); 
	 var rez_text = ''; //
		for (var i = 0; i < input_checks.length; i++) {			
 			if(input_checks[i].checked == true) { //				
	name_2 = input_checks[i].name;  name_2 = name_2.replace(/]/g, '');  var name_25 = name_2.split('['); 
			var part_id = name_25[name_25.length - 1]; // alert(part_id);
			var price_4 = parseFloat(prod_parts_5_arr[part_id]['price']);
			price_2 += price_4;
			}
		}
	price_2 = price_2 - (disc/100)*price_2;
	var price_rez = price_2 * kurs;  price_rez = price_rez.toFixed(round_to);
	document.getElementById("<?php echo $price_4_id ?>").innerHTML = price_rez;
}
</script>
<?php endif; // if count($product_parts_arr) ///// ?>  
	<?php endif; // __ if($product_type == 'grouped') ?>
    