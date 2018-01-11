<?php
/*
Template Name: WOW checkout
*/
?>

<?php WOW_Cart_Session::cart_update(); ?>	


<?php get_header(); ?>


<?php $po_arr = array_keys($_POST); ?>

        
<div class="page checkout no_column blog">

    
	 <div id="checkout_page" class="content<?php if(in_array('popupp', $po_arr)) { ?> ajax_replace2_content<?php } ?>"> 
     
     <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
 

   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>   
   
    <div class="page_title title_content"> <h1><?php the_title(); ?></h1> </div>
    
    <div class="entry-content maine"> <?php the_content(); ?> </div>
    
	<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	
        
    
    <div class="checkout_content maine">    
    
    <?php 	
	$options_5 = get_option('wow_settings_arr');
	
	$cart_error = array('subtotal' => 0, 'qty'  => 0); // 
	$cart_array = WOW_Cart_Session::cart_array();
	$products_parts = WOW_Cart_Session::cart_parts_array(); ///
	$products = array();
	if(count($cart_array)) { $products = $cart_array; }
	
	if($options_5['wow_quick_order_mode']) : 
	if($_POST['quick_order_prod_id'] or $_POST['product_form']) : // 'quick_order_products'
	if($_POST['quick_order_prod_id']) {
	$q_id = $_POST['quick_order_prod_id']; $q_qty = 1; if($_POST['qty']) { $q_qty = $_POST['qty']; }
	$products = array($q_id => $q_qty);
	} else { $products = $_POST['product_form']; }	
	endif; 
	endif; // ($options_5['wow_quick_order_mode']) 
	 
	?>
    <?php if(count($products)) : ?>  
    <?php 
	$subtotal_base = WOW_Cart_Session::cart_subtotal_base(); 
	
	if($options_5['wow_quick_order_mode']) : 
	if($_POST['quick_order_prod_id'] or $_POST['product_form']) { 
	$r_total_arr = array();
	foreach ($products as $prod_id => $p_qty) { 
		$prod_parts_arr = array(); 
		if(count($products_parts)) { if($products_parts[$prod_id]) { 
		$prod_parts_arr = $products_parts[$prod_id]; 
		} }
	$r_total_2 = WOW_Attributes_Front::cart_row_subtotal($prod_id, $p_qty, $prod_parts_arr);  $r_total = $r_total_2['row_total'];
	$r_total_arr[] = $r_total;
	}
	$subtotal_base = array_sum($r_total_arr);
	}
	endif; // ($options_5['wow_quick_order_mode']) 
	
	// $cart_subtotal = WOW_Cart_Session::cart_get_subtotal();		
	$act_currency_arr = WOW_Product_List_Func::get_act_currency();
	$act_currency = $act_currency_arr['code'];
	$symb = $act_currency_arr['symbol'];
	$kurs = $act_currency_arr['rate']; 
$round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }
if(preg_match("/[^0-9]/", $round_to)) { $round_to = 0; }
	
	$cart_subtotal = round($subtotal_base * $kurs, $round_to) . '<span>'.$symb.'</span>';

	$min_subtotal_base = $options_5['wow_min_cart_subtotal'];
	$min_subtotal = round($min_subtotal_base * $kurs, 0) . '<span>'.$symb.'</span>';
	if($min_subtotal_base and $subtotal_base < $min_subtotal_base) { $cart_error['subtotal'] = 1; }
	
	/* !!!! disc */
	$disc_arr = WOW_Attributes_Front::get_cart_discount();  $disc_keys = array_keys($disc_arr);
	$disc_per_dw = $disc_arr['disc_per']; // 3 %
	$disc_price_dw_base = $subtotal_base * $disc_per_dw / 100;
	$disc_price_dw = round($disc_price_dw_base * $kurs, $round_to) . '<span>'.$symb.'</span>';
	
	$shipp_price_1 = 0;
		
	$payment_comment_1 = $options_5['wow_payment_comment_1'];
	$shipping_comment_1 = $options_5['wow_shipping_comment_1'];
	?>
 
<script type="text/javascript">
<?php if(!in_array('popupp', $po_arr)) { ?> window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded. <?php } ?> 
jQuery(document).ready(function($) {
	$("#customer-phone").mask('(380) 99-9999999', {placeholder:'_'}); // '(999) 99-9999999'
});
<?php if(!in_array('popupp', $po_arr)) { ?> }, false); // __ after jQuery is loaded <?php } ?>    	
</script>

    
    <form name="form_checkout" id="form_checkout_order" method="post" action="<?php bloginfo('url'); echo '/checkout-success'; ?>" >
    <div class="customer-sect columns-2 shad_conte">
    <div class="col col-1"><div class="inn">
    
    <div class="secto customer">
    <div class="title"><h3><?php _e('Customer information') ?></h3></div>    
    <?php 
	$first_name = ''; $last_name = ''; $email = ''; $phone = ''; $city = ''; $address = '';
	if (is_user_logged_in()) {
	$current_user = wp_get_current_user();  $user_id = get_current_user_id();
	$email = $current_user->user_email;
	$user_meta = get_user_meta($user_id);
	$first_name = $user_meta['first_name'][0]; $last_name = $user_meta['last_name'][0];
	$phone = $user_meta['phone'][0];
	$country = $user_meta['country'][0];
	$city = $user_meta['city'][0];
	$address = $user_meta['address'][0];
	}
	
	$options_cities = get_option('wow_cities_list'); ///
	$city_comment = ''; // $city_comment = $options_5['wow_city_comment']; 
	$city_comment_2 = ''; // $city_comment_2 = $options_5['wow_city_comment_2'];
	
	$checkout_fields = $options_5['wow_checkout_fields'];	
	$customer_info_arr = array( 
		'first_name' => array('label' => ($checkout_fields['first_name']['label']) ? $checkout_fields['first_name']['label'] : __('Name'), 'value' => $first_name, 'clas' => 'required', 'type' => ''),
		'last_name' => array('label' => ($checkout_fields['last_name']['label']) ? $checkout_fields['last_name']['label'] : __('Last Name'), 'value' => $last_name, 'clas' => $checkout_fields['last_name']['status'], 'type' => ''),		
		'phone' => array('label' => ($checkout_fields['phone']['label']) ? $checkout_fields['phone']['label'] : __('Phone'), 'value' => $phone, 'clas' => $checkout_fields['phone']['status'], 'type' => ''),
		'email' => array('label' => ($checkout_fields['email']['label']) ? $checkout_fields['email']['label'] : __('Email'), 'value' => $email, 'clas' => $checkout_fields['email']['status'], 'type' => ''),
		'city' => array('label' => ($checkout_fields['city']['label']) ? $checkout_fields['city']['label'] : __('City'), 'value' => $city, 'clas' => $checkout_fields['city']['status'], 'type' => 'select', 'options' => $options_cities, 'comment' => array($city_comment, $city_comment_2)),
		'address' => array('label' => ($checkout_fields['address']['label']) ? $checkout_fields['address']['label'] : __('Address'), 'value' => $address, 'clas' => $checkout_fields['address']['status'], 'type' => ''),		
	); // 

foreach ($customer_info_arr as $inf_key => $info) { if(!in_array($inf_key, array('first_name'))) { if($checkout_fields[$inf_key]['status'] == 'hide') { unset($customer_info_arr[$inf_key]); } } }
	?> 
    <?php if($user_id) { ?><input type="hidden" name="p_author" value="<?php echo $user_id ?>" /><?php } ?>
    <ul class="customer fields">
    <?php foreach ($customer_info_arr as $key => $info) : ?>
    <?php $field_id = 'customer-'.$key; ?>
    <li>
    <label for="<?php echo $field_id ?>"><?php echo $info['label'] ?><?php if($info['clas'] == 'required') { ?><span class="req">*<?php // _e('Is required') ?></span><?php } ?></label>
    <div class="box">
    <?php if($info['type'] == 'select') { ?>
    	<?php if( count($info['options']) ) : ?>
    <div class="select_box">
    <i class="ja ja-caret-down"></i> 
    <select name="customer[<?php echo $key ?>]" id="<?php echo $field_id ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>" onchange="set_customer_city_f(this.value)" >
    <option value=""><?php echo $info['label'] ?><?php // _e('Select a city') ?></option>
	<?php foreach ($info['options'] as $option_1) { ?>
    <option value="<?php echo $option_1['label'].'---'.$option_1['price'] ?>"><?php echo $option_1['label'] ?></option>
    <?php } ?>
    </select>
    </div>	
		<?php endif; ?>
	<?php } else { ?>
    <input type="text" name="customer[<?php echo $key ?>]" id="<?php echo $field_id ?>" value="<?php echo $info['value'] ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>" maxlength="50" placeholder="<?php echo $info['label'] ?>" />
	<?php } ?>
    </div>
    <?php /*  if($info['comment']) { ?>
    <div id="comme-<?php echo $field_id ?>" class="comment" style="display: none;"><?php echo $info['comment'][0] ?></div>
    <div id="comme_2-<?php echo $field_id ?>" class="comment" style="display: none;"><?php echo $info['comment'][1] ?></div>
	<?php }  */ ?>
    </li>
    <?php endforeach;  ?>
    </ul>
    </div>
    
    <?php // Comments ?>
	<?php if($checkout_fields['comment']['status'] != 'hide') { ?>
    <div class="secto comme">
    <?php $comment_lab = ($checkout_fields['comment']['label']) ? $checkout_fields['comment']['label'] : __('Comment'); // Comments 
	$comment_clas = $checkout_fields['comment']['status'];
	?>
    <div class="title"><h3><?php echo $comment_lab; ?></h3></div>
    <div class="box wide">
    <?php if($comment_clas == 'required') { ?><span class="req">*</span><?php } ?>
    <textarea name="comment" class="order_comment <?php echo $comment_clas; ?>" placeholder="<?php echo $comment_lab; ?>"></textarea>
    </div>
    </div>
    <?php } ?> 

    
    <div class="form_notice" id="order_notice_text_5"><?php /* notice text */ ?></div>
    
    </div></div>
    
    <div class="col col-right"><div class="inn">
    <?php $options_pay = get_option('wow_payment_methods');
	if($options_pay) : ?>
    <div class="secto payment">
    <div class="title">
    <h3><?php _e('Payment method') ?></h3>
    <div class="comment"><?php echo $payment_comment_1 ?></div>
    </div>
    <ul class="bil radio-fields">
    <?php 
		$pay_method_act = 0;    
		if(in_array('payment_method', $po_arr)) { $pay_method_act = $_POST['payment_method']; }
	$num = 0;
	foreach ($options_pay as $key_2 => $method) : if($method['status'] == 1) : ?>
    <?php $num++;
	$field_id = 'payment-'.$key_2; 
	if($method['code']) { $m_value = $method['code']; } else { $m_value = $key_2; }	
	?>
    <li id="p_method_<?php echo $m_value ?>"> 
  <input type="radio" name="payment_method" id="<?php echo $field_id ?>" value="<?php echo $m_value ?>" class="fine_radio" title="<?php echo $method['label'] ?>" onchange="set_shipp_metod_list('<?php echo $m_value ?>')" <?php if($num == 1 and !$pay_method_act) { ?>checked="checked" <?php } ?>/>
    <label for="<?php echo $field_id ?>">
    <div class="label-in"> <div class="icon"></div>
    <div class="name"><?php echo $method['label'] ?></div>
    <div class="descr"><?php echo $method['descr'] ?></div>
    </div>
    </label>
    
    </li>
    <?php endif; endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>
    
    <?php $options_shipp = get_option('wow_shipping_methods');
	if($options_shipp) : ?>
    <div class="secto shipping">
    <div class="title">
    <h3><?php _e('Shipping method') ?></h3>  
    <div class="comment"><?php echo $shipping_comment_1 ?></div> 
    </div>
    <ul class="bil radio-fields">
    <?php 
	$shipp_method_act = 0;
	if(in_array('shipping_method', $po_arr)) { $shipp_method_act = $_POST['shipping_method']; } 
	$num = 0;
	foreach ($options_shipp as $key_2 => $method) : if($method['status'] == 1) : ?>
    <?php $num++;
	$field_id = 'shipping-'.$key_2; 
	if($method['code']) { $m_value = $method['code']; } else { $m_value = $key_2; }	
	$m_price = 0;
	if($method['price']) { $m_price = $method['price']; }
	if($method['subtotal_free']) { if($subtotal_base >= $method['subtotal_free']) { $m_price = 0; } }	
	if($num == 1) { $shipp_price_1 = $m_price; }
	if($shipp_method_act and $m_value == $shipp_method_act) { $shipp_price_1 = $m_price; } /// 
	$m_price_2 = $m_price * $kurs;  $m_price_2 = round($m_price_2, $round_to);
	?>
    <li id="s_method_<?php echo $m_value ?>"> 
    <input type="radio" name="shipping_method" id="<?php echo $field_id ?>" value="<?php echo $m_value ?>" class="fine_radio" title="<?php echo $method['label'] ?>" onchange="show_total_check_cost('<?php echo $m_price ?>')" <?php if($num == 1 and !$shipp_method_act) { ?>checked="checked" <?php } ?>/>    
    <label for="<?php echo $field_id ?>">
    <div class="label-in"> <div class="icon"></div>
    <div class="name"><?php echo $method['label'] ?> <span class="lab_r">-<span class="price"><?php echo $m_price_2 ?><span><?php echo $symb ?></span></span></span></div>
    <div class="descr"><?php echo $method['descr'] ?></div>
    </div>
    </label>    
    </li>
    <?php endif; endforeach; ?>   
    </ul>
    </div>
    <?php endif; ?>    
    
    </div></div>
    </div> <!-- customer-sect -->
    
    
    <div class="products-sect<?php if(!in_array('popupp', $po_arr)) { ?> ajax_replace2_content<?php } ?>">
<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'thumbnail' ); 
}
?>     
    <div class="products">
    <div class="tab_head">
    <div class="colu prod_img"></div> <div class="colu prod_name"><?php _e('Products') ?></div> <div class="colu prod_price"><?php _e('Price') ?></div> <div class="colu prod_qty"><?php _e('Qty') ?></div> <div class="colu prod_price tot"><?php _e('Subtotal') ?></div>
    </div>
    <?php if($options_5['wow_quick_order_mode']) : ?> 
	<?php if($_POST['quick_order_prod_id'] or $_POST['product_form']) { ?>
    <?php foreach ($products as $prod_id => $p_qty) : ?>
    <input type="hidden" name="quick_order_products[<?php echo $prod_id ?>]" value="<?php echo $p_qty ?>" />
	<?php endforeach; ?>
	<?php } ?>
    <?php endif; // ($options_5['wow_quick_order_mode']) ?>
    <ul class="prod-list">
	<?php foreach ($products as $prod_id => $p_qty) : //////////// foreach ///////////// ?>
	<li>
	<div class="colu prod_img"> <a href="<?php echo get_permalink($prod_id); ?>" title="<?php echo get_the_title($prod_id); ?>">
	<?php $thumb_prod_id = $prod_id;  if(!has_post_thumbnail($prod_id) and wp_get_post_parent_id($prod_id)) { $thumb_prod_id = wp_get_post_parent_id($prod_id); } ?>
	<?php if ( has_post_thumbnail($thumb_prod_id) ) { echo get_the_post_thumbnail( $thumb_prod_id, 'thumbnail' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?>
    </a> </div>
  	<div class="colu prod_name"> 
    <h3><a href="<?php echo get_permalink($prod_id); ?>"><?php echo get_the_title($prod_id); ?></a></h3> 
	<?php $prod_parts_arr = array(); 
	if(count($products_parts)) { if($products_parts[$prod_id]) { 
	$prod_parts_arr = $products_parts[$prod_id]; ?>
    <div class="parts">
    	<?php foreach ($prod_parts_arr as $part_id => $part_qty) {  ?>
    <span><?php echo get_the_title($part_id); ?> <em>(<?php echo $part_qty; ?>)</em></span>
    	<?php } ?>
    </div>
    <?php } } ?>
    </div>  
    
	<?php $row_price_arr = WOW_Cart_Session::cart_get_row_price($prod_id, $p_qty, $prod_parts_arr); ?>
    <div class="colu prod_price"><span class="price"><?php echo $row_price_arr['item_price'] ?></span></div>
    
    <div class="colu prod_qty"> <span><?php echo $p_qty ?></span> 
	  <?php /* <div class="qty_change_co">
	<?php $qty_id = 'qty_change_2_'.$prod_id; ?>
     <span class="qty_change minus" onclick="qty_chan('minus', '<?php echo $qty_id ?>', 'checkout')"> <i class="fa fa-minus"></i> </span>
        <input type="text" name="cart_qty[<?php echo $prod_id ?>]" id="<?php echo $qty_id ?>" value="<?php echo $p_qty ?>" size="4" title="<?php _e('Qty') ?>" class="input-text qty" maxlength="5" onchange="qty_chan('', '<?php echo $qty_id ?>', 'checkout')" onkeypress="qty_validate(event, 'int')" />
      <span class="qty_change plus" onclick="qty_chan('plus', '<?php echo $qty_id ?>', 'checkout')"> <i class="fa fa-plus"></i> </span>
      </div> */ ?> 
    </div>
    
   <div class="colu prod_price tot"><span class="price"><?php echo $row_price_arr['row_total'] ?></span></div>

		<?php $stock_2 = get_post_meta ($prod_id, 'stock', true); ?>
		<?php if($stock_2 != '' and $stock_2 < $p_qty) { $cart_error['qty'] = 1; } ?>        
    </li>
	<?php endforeach;  //////////// foreach ///////////// ?>
    </ul>

<?php if($cart_error['qty']) { ?> <div class="message p_qty_alert error"> <?php _e('The selected quantity of products is not available.') ?> </div> <?php } else { unset($cart_error['qty']); } ?>
    </div>
    
    <div class="checkout_totals">

    <?php // Coupons ?>
	<?php // $options_coupons = get_option('wow_coupons_list');
	if(in_array('coupon', $disc_keys)) : //// 
	$coupon_code = $disc_arr['coupon'];
	$coupon_code_val = '';  if($coupon_code and $coupon_code != -1) { $coupon_code_val = $coupon_code; }
	?>
    <div class="secto coupons"> 
    <div class="title"><h4><?php _e('Discount coupon'); ?></h4></div>
    <div class="box kido">    
    <input type="text" name="coupon" id="" value="<?php echo $coupon_code_val ?>" title="<?php _e('Please, enter coupon code'); ?>" placeholder="<?php _e('Please, enter coupon code'); ?>"<?php if($coupon_code and $coupon_code != -1) { ?> readonly="readonly"<?php } ?> />
    <?php if($coupon_code and $coupon_code != -1) { ?> <span><i class="fa fa-check" aria-hidden="true"></i> <em><?php echo $disc_arr['coupon_label'] ?></em></span> <?php } else { ?> <a onclick="update_checkout_products('coupon')" class="button small"><?php _e('Submit') ?></a> <?php } ?>
    <?php if($coupon_code == -1) { ?> <div class="form_notice error"><?php _e('Your coupon code is not correct!'); ?></div> <?php } ?>
    </div>
    </div>
    <?php endif; ?>
    
    <div class="totals"<?php if($options_5['wow_quick_order_mode']) { ?> style="display: none;"<?php } ?>>
    <?php 
	$shipp_price_1_fin = $shipp_price_1 * $kurs; $shipp_price_1_fin = round($shipp_price_1_fin, $round_to);
	$grand_total = $subtotal_base - $disc_price_dw_base + $shipp_price_1; /* !!!! $disc_price_dw_base */
	$grand_total_fin = $grand_total * $kurs; $grand_total_fin = round($grand_total_fin, $round_to);
	?>   
    <div class="row subtotal"><span class="lab"><?php _e('Subtotal') ?>:</span><span class="price"><?php echo $cart_subtotal ?></span></div>
    <?php if($disc_per_dw > 0) { /* !!!! disc */ ?>
    <div class="row discount">
  <span class="lab"><?php _e('Discount') ?> <span class="per"><?php echo $disc_per_dw ?>%</span> :</span>
  <span class="price">- <?php echo $disc_price_dw ?></span>
    </div>
    <?php } ?>    
    <div class="row shipping"><span class="lab"><?php _e('Shipping') ?>:</span>
    <span class="price"><strong id="total_shipp_price_dw"><?php echo $shipp_price_1_fin ?></strong><span><?php echo $symb ?></span></span>
    </div>
    <div class="row grandtotal"><span class="lab"><?php _e('Grand total') ?>:</span>
    <span class="price"><strong id="total_grand_price_dw"><?php echo $grand_total_fin ?></strong><span><?php echo $symb ?></span></span>
    </div>
    </div> <!-- totals -->
    
<?php if($cart_error['subtotal']) { ?> <div class="message subtotal_alert error"><?php echo __('Minimum order:').'<span class="price"> '.$min_subtotal.'</span>'; ?></div> <?php } else { unset($cart_error['subtotal']); } ?>
    
    <div class="tot_btn">     
    <div id="button_update_checkout" class="but" style=" display: none;"><a onclick="update_checkout_products()" class="button btn-checkout"><?php _e('Update cart') ?></a></div> 
    <div id="button_checkout" class="but"><a<?php if(!$cart_error) { ?> onclick="save_order()"<?php } ?> class="button btn-checkout<?php if($cart_error) { ?> non_act<?php } ?>"><?php _e('Checkout') ?></a></div>
    </div>
    </div> <!-- checkout_totals -->
    
    </div> <!-- products-sect -->    
    
    </form>
   
  
	<?php else : ?>
    <p class="no_items"><?php _e('You have no items to checkout.') ?></p>
    <?php endif; // (count($products)) ?>
    
    </div>    
	



<script type="text/javascript">

window.show_total_check_cost = function(shipp_price) {
<?php 
	// $subtotal_base = WOW_Cart_Session::cart_subtotal_base();
	// $act_currency_arr = WOW_Product_List_Func::get_act_currency();
	// $kurs = $act_currency_arr['rate'];
// $round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }
	// if(preg_match("/[^0-9]/", $round_to)) { $round_to = 0; }
	/// 
	// $disc_arr = WOW_Attributes_Front::get_cart_discount();
	// $disc_per_dw = $disc_arr['disc_per']; // 3 %
	// $disc_price_dw_base = $subtotal_base * $disc_per_dw / 100;
?>
	var subtotal_base = parseFloat(<?php echo $subtotal_base ?>);
	var shipp_price = parseFloat(shipp_price);
	/* 
	var disc_per = parseFloat(<?php echo $disc_per_dw ?>);
	var disc_base = 0; ////// 
	if(disc_per) { disc_base = subtotal_base * disc_per * 0.01; } //////
	 */
	var disc_base = parseFloat(<?php echo $disc_price_dw_base ?>); 
	var kurs = parseFloat(<?php echo $kurs ?>);
	var round_to = parseFloat(<?php echo $round_to ?>);
	var grand_total = subtotal_base - disc_base + shipp_price; /////// 
	var shipp_price_2 = shipp_price * kurs;  shipp_price_2 = shipp_price_2.toFixed(round_to);
	var grand_total_2 = grand_total * kurs;  grand_total_2 = grand_total_2.toFixed(round_to);
	
	var shipp_price_div = document.getElementById("total_shipp_price_dw");
	var grand_price_div = document.getElementById("total_grand_price_dw");
	shipp_price_div.innerHTML = shipp_price_2;
	grand_price_div.innerHTML = grand_total_2;
}


window.save_order = function() {
order_check_fields(); /*  */ // errore 
if ( errore == 0 )  {  
	var check_page = document.getElementById("checkout_page");
	ajax_prepare_html(check_page); 
	/// 
	var top_4 = check_page.parentNode.parentNode.offsetTop - 20 + 'px';
	jQuery(document).ready(function($) { $('html, body').animate({ scrollTop: top_4 }, 800); }); /// 
	
  new Ajax.Updater( page_temp.id, '<?php bloginfo('url'); echo '/checkout-success/'; ?>', { 
  	method: 'post',
    parameters: $('form_checkout_order').serialize(),
	onComplete: 
		function() {
			sidebar_replace_new('.sidebar_cart');  
			page_replace_new(check_page); 
			success_scroll_2();
		}
	} );
}
}

window.success_scroll_2 = function() {
	var lightb_cart = document.getElementById("lightb_cart");	
var scroll_y = document.body.scrollTop || document.documentElement.scrollTop;
lightb_cart.style.top = scroll_y + 100 + "px";
}


window.order_check_fields = function() {
	var notice_text = "<?php _e('Fill the field!') ?>";
	var notice = document.getElementById("order_notice_text_5");	
	var forma_check = document.forms.form_checkout;		
	errore = 0;	
	
	var check_arr5 = ['customer[first_name]', 'customer[last_name]', 'customer[phone]', 'customer[city]', 'customer[address]', 'comment']; // 'payment_method', 'shipping_method'
	var check_arr4 = [];
		i2 = 0;
		for (var i = 0; i < check_arr5.length; i++) { /////// ////
		inp_field_name = check_arr5[i]; 
		if(forma_check.elements[inp_field_name]) { check_arr4[i2] = check_arr5[i];  i2++; }
		} // //////// for 
			
		for (var i = 0; i < check_arr4.length; i++) {  /////// ////
		inp_field_name = check_arr4[i];
		inp_field4 = forma_check.elements[inp_field_name];
 var value_24 = inp_field4.value.replace(/{/g, '').replace(/}/g, '').replace(/"/g, '').replace(/'/g, '').replace(/:/g, '').replace(/;/g, '');
 inp_field4.setAttribute('value', value_24);   inp_field4.value = value_24;
  if ( inp_field4.className.indexOf("required") != -1 ) { 
   if ( inp_field4.value.length < 3 ) {
    inp_field4.focus();
	inp_field4.className += ' error'; 	errore = 1;	
  } else { inp_field4.className = inp_field4.className.replace(/error/g, ''); }
 if(inp_field4.parentNode.className.indexOf("select_box") != -1) {  if(inp_field4.className.indexOf("error") != -1) { inp_field4.parentNode.className += ' error'; } else { inp_field4.parentNode.className = inp_field4.parentNode.className.replace(/error/g, ''); }  }
  }		
		} // //////// for 

var input_email = forma_check.elements['customer[email]'];
  if ( input_email.className.indexOf("required") != -1 ) { 
   var reg_email = /^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;
   if ( !input_email.value.match(reg_email) ) {
    input_email.focus();
	input_email.className += ' error'; 	errore = 1;	
  } else { input_email.className = input_email.className.replace(/error/g, ''); }
  }   
    
  if ( errore == 1 )  {
	notice.className += ' error';
	notice.innerHTML = notice_text;
    return false;
	}
}



window.update_checkout_products = function(par) { // Оновлення к-сті товарів на стор. checkout 
	if(par == 'coupon') {
	var coupon_field = document.forms.form_checkout.coupon; 
	var coupon_code_1 = coupon_field.value;
	if ( coupon_code_1.length < 3 ) { coupon_field.className += ' error';  return false; }
	}
	var prod_sect = document.getElementById("checkout_page").getElementsByClassName("products-sect")[0];
	ajax_prepare_html(prod_sect); 
	
	var prod_parameters = $('form_checkout_order').serialize(true);
	
  new Ajax.Updater( page_temp.id, '<?php bloginfo('url'); echo '/checkout/'; ?>', { 
  	method: 'post',
    parameters: prod_parameters,
	evalScripts: true, //
	onComplete: 
		function() {
			sidebar_replace_new('.sidebar_cart');
			page_replace_new(prod_sect); 
		}
	} );
}


<?php /* 
window.check_coupon_code = function() { // 
	var prod_sect = document.getElementById("checkout_page").getElementsByClassName("products-sect")[0];
	// var coupon_code_1 = document.forms.form_checkout.coupon.value;  
	ajax_prepare_html(prod_sect); 
	
	var prod_parameters = $('form_checkout_order').serialize(true);
	
  new Ajax.Updater( page_temp.id, '<?php bloginfo('url'); echo '/checkout/'; ?>', { 
  	method: 'post',
    parameters: prod_parameters, // {coupon: coupon_code_1}
	evalScripts: true, //
	onComplete: 
		function() {
			sidebar_replace_new('.sidebar_cart');
			page_replace_new(prod_sect); 
		}
	} );
}
 */ ?>

window.set_customer_city_f = function(city_value) {
/* 	
	var value_51 = city_value.split('---');  var value_5 = value_51[1];
	var comment47 = document.getElementById("comme-customer-city");
	var comment48 = document.getElementById("comme_2-customer-city");

	if(value_5 == 1) { comment47.style.display = "block"; } 
	else { comment47.style.display = "none"; }	
	if(value_5 == 10) { comment48.style.display = "block"; } else { comment48.style.display = "none"; }
 */
}

window.set_shipp_metod_list = function(p_metod) {
/* 
	var met_nova_post = document.getElementById("s_method_nova_post");
	var met_courier = document.getElementById("s_method_courier");
	var met_pickup = document.getElementById("s_method_pickup");
	if(p_metod == "cash") { met_pickup.style.display = "none"; met_nova_post.style.display = "none"; } 
	else { met_pickup.style.display = "block"; met_nova_post.style.display = "block"; }	
 */
}
// setTimeout( "set_shipp_metod_list('cash')", 0 );
</script>

	           
    </div> <!-- content -->     
	


     
  
</div> <!-- class="page blog" -->




<?php /* *** Checkout_ship_methods - select *** */ ?>
<?php /* 
    <?php $options_pay = get_option('wow_payment_methods');
	if($options_pay) : ?>
    <div class="secto payment">
    <div class="title">
    <h3><?php _e('Payment method') ?></h3>
    <div class="comment"><?php echo $payment_comment_1 ?></div>
    </div>
    <div class="select_box wide">
    <select name="payment_method" onchange="set_shipp_metod_list(this.value)">
    <?php $num = 0;
	foreach ($options_pay as $key_2 => $method) : if($method['status'] == 1) : ?>
    <?php $num = $num + 1;
	$field_id = 'payment-'.$key_2; 
	if($method['code']) { $m_value = $method['code']; } else { $m_value = $key_2; }	
	?>
    <option value="<?php echo $m_value ?>"><?php echo $method['label']; if($method['descr']) { echo ' ('.$method['descr'].')'; } ?></option>
    <?php endif; endforeach; ?>
    </select>
    </div>
    </div>
    <?php endif; ?>
    
    <?php $options_shipp = get_option('wow_shipping_methods');
	if($options_shipp) : ?>
    <div class="secto shipping">
    <div class="title">
    <h3><?php _e('Shipping method') ?></h3>  
    <div class="comment"><?php echo $shipping_comment_1 ?></div> 
    </div>
    <div class="select_box wide">
    <select name="shipping_method" onchange="show_total_check_cost(this)">
    <?php $num = 0;
	foreach ($options_shipp as $key_2 => $method) : if($method['status'] == 1) : ?>
    <?php $num = $num + 1;
	$field_id = 'shipping-'.$key_2; 
	if($method['code']) { $m_value = $method['code']; } else { $m_value = $key_2; }	
	$m_price = 0;
	if($method['price']) { $m_price = $method['price']; }
	if($method['subtotal_free']) { if($subtotal_base >= $method['subtotal_free']) { $m_price = 0; } }	
	if($num == 1) { $shipp_price_1 = $m_price; }
	$m_price_2 = $m_price * $kurs;  $m_price_2 = round($m_price_2, $round_to);
	?>
    <option value="<?php echo $m_value ?>" data-price="<?php echo $m_price ?>"><?php echo $method['label']; if($method['descr']) { echo ' ('.$method['descr'].')'; } ?></option>
    <?php endif; endforeach; ?>
    </select>
    </div>
    </div>
    <?php endif; ?>   
    
    
<script>
function show_total_check_cost(elem) { // shipp_price 
	var shipp_price = elem.options[elem.selectedIndex].getAttribute('data-price'); 
	/////
}
</script>    
 */ ?>




<?php get_footer(); ?>