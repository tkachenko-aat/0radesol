<?php

class WOW_Cart_Session {
	
function cart_array() {
	global $wp_session;
	$cart_ex_arr = array();
	if ($wp_session['cart']) {
		$cart_full_arr = explode('|||', $wp_session['cart']); ////
		$cart_base = $cart_full_arr[0]; ////
		$cart_ex = explode('|', $cart_base);
		unset($cart_ex[0]); // 1-й елемент - cart_subtotal
		foreach ($cart_ex as $item) { 
		$item_arr = explode('-', $item); 
		$cart_ex_arr[$item_arr[0]] = $item_arr[1]; 
		}
	} // if ($wp_session['cart'])	
	return $cart_ex_arr;
}

function cart_parts_array() {
	global $wp_session;
	$cart_parts_arr = array();
	if ($wp_session['cart']) {
	$cart_full_arr = explode('|||', $wp_session['cart']); ////
	if (count($cart_full_arr) > 1) {
		$cart_parts = $cart_full_arr[1]; ////
		$cart_parts_arr_2 = explode('||', $cart_parts);
		// unset($cart_ex[0]); // 1-й елемент - cart_subtotal
		foreach ($cart_parts_arr_2 as $prod) {
			$prod_arr = explode('|', $prod);
			$prod_id = $prod_arr[0];  unset($prod_arr[0]); // 1-й елемент - id складного товару
			foreach ($prod_arr as $item) { 
			$item_arr = explode('-', $item); 
			$cart_parts_arr[$prod_id][$item_arr[0]] = $item_arr[1]; 
			}
		}
	}
	} // if ($wp_session['cart'])	
	return $cart_parts_arr;
}

function cart_save_data($cart_full_arr) {
	global $wp_session;
	$cart_arr = $cart_full_arr[0];  if(!is_array($cart_arr)) { $cart_arr = array(); } /// 
	$cart_parts_arr = $cart_full_arr[1];  if(!is_array($cart_parts_arr)) { $cart_parts_arr = array(); } 
		$cart_new_2 = array();
		$cart_new_txt = '';
		foreach ($cart_arr as $id_2 => $qty_2) { 
			if($qty_2 > 0) { $cart_new_2[] = $id_2.'-'.$qty_2; }
		} // foreach ($cart_arr as $id_2 => $qty_2)
		
		$cart_parts_4 = array(); /// cart parts
		foreach ($cart_parts_arr as $id_4 => $part_arr_4) { 
		if($cart_arr[$id_4]) {
			$cart_parts_5 = array($id_4);
			foreach ($part_arr_4 as $id_5 => $qty_5) { 
				if($qty_5 > 0) { $cart_parts_5[] = $id_5.'-'.$qty_5; }
			}
			$cart_parts_5_txt = implode('|', $cart_parts_5);
			$cart_parts_4[] = $cart_parts_5_txt;
		}
		} // foreach ($cart_parts_arr as $id_4 => $part_arr_4)
		$cart_parts_4_txt = implode('||', $cart_parts_4);  /// __ cart parts
		
		if(count($cart_new_2) > 0) {
		$cart_subtotal = WOW_Cart_Session::cart_write_subtotal($cart_arr, $cart_parts_arr); /// 
		// $cart_subtotal = 1978; /// 
		$cart_new_4 = array_merge(array($cart_subtotal), $cart_new_2);		
		$cart_new_txt_1 = implode('|', $cart_new_4);
		$cart_new_txt_2 = $cart_parts_4_txt; 
		
		$cart_txt_arr = array($cart_new_txt_1);
		if($cart_new_txt_2) { $cart_txt_arr[] = $cart_new_txt_2; }
		$cart_new_txt = implode('|||', $cart_txt_arr);
		}		
	$wp_session['cart'] = $cart_new_txt;
	$wp_session->write_data();
	
	// wp_cache_set( 'cart', $cart_new_txt );
}


function cart_add_product() {
	if($_POST['prod_id'] or $_POST['product_form']) :
		global $wp_session;
		if($_POST['prod_id']) {
		$prod_id = $_POST['prod_id'];
		$qty = 1; if($_POST['qty']) { $qty = $_POST['qty']; }
		$prod_added = array($prod_id => $qty);
		}
		else { $prod_added = $_POST['product_form']; }
		
		$prod_parts = array();  if($_POST['product_parts']) { $prod_parts = $_POST['product_parts']; } ///
	
		$prod_types = WOW_Attributes_Front::get_attrSet_posttypes();
		$cart_ex_arr = WOW_Cart_Session::cart_array();  $cart_ex_ids = array_keys($cart_ex_arr);
		$cart_parts_ex_arr = WOW_Cart_Session::cart_parts_array(); /// 		
		$cart_new_arr_2 = $cart_ex_arr;
		$prod_added_2 = $prod_added;
		$cart_erro = 0;
		
			 //// grouped product 
			$cart_parts_4 = array(); 		
		foreach ($cart_ex_arr as $id_4 => $qty_4) { 			
			$id_4_2 = explode('__', $id_4);  $id_2 = $id_4_2[0];
		if($cart_parts_ex_arr[$id_4]) {
			$part_arr_4 = $cart_parts_ex_arr[$id_4];
			$cart_parts_5 = array($id_2);
			foreach ($part_arr_4 as $id_5 => $qty_5) { 
				if($qty_5 > 0) { $cart_parts_5[] = $id_5.'-'.$qty_5; }
			}
			$cart_parts_5_txt = implode('|', $cart_parts_5);
			$cart_parts_4[] = $cart_parts_5_txt; 	
		} else { // product without parts 
			$product_type = get_post_meta($id_2, 'product_type', true);
			if($product_type == 'grouped') { 			 
			$cart_parts_4[] = $id_2; 
			}			
		}
		} // foreach 
		$cart_parts_4 = array_unique($cart_parts_4);
		 //// ___ grouped product 
		
		foreach ($prod_added as $prod_id => $qty) { //// //// //// //// //// 
			$p_type = get_post_type($prod_id);			
			$product_type = get_post_meta($prod_id, 'product_type', true);
			
			if($_POST['prod_id']) { if($product_type == 'grouped') { // //// grouped product in list 
			$product_parts_base = get_post_meta($prod_id, 'grouped_product_parts_base', true);
			$product_parts_base_arr = explode(',', $product_parts_base);
				if($product_parts_base and count($product_parts_base_arr)) {
			$parts_arr_5 = array();
			foreach($product_parts_base_arr as $part_id) { $parts_arr_5[$part_id] = 1; }
			$prod_parts[$prod_id] = $parts_arr_5; 
				}
			} } // //// __ grouped product in list 
			
				$part_1 = $prod_id; // $prod_id //// grouped product   22|19-1  22|19__2-1 /* !!!! */
				if(count($prod_parts)) { if($prod_parts[$prod_id]) {  
			$prod_parts_5 = array($prod_id);
			foreach ($prod_parts[$prod_id] as $id_5 => $qty_5) { 
				if($qty_5 > 0) { $prod_parts_5[] = $id_5.'-'.$qty_5; }
			}
			$part_1 = implode('|', $prod_parts_5);
				} } //// ___ grouped product  		
			if(in_array($product_type, array('configurable')) or !in_array($p_type, $prod_types) or preg_match("/[^0-9]/", $prod_id) or preg_match("/[^0-9.]/", $qty) or preg_match("/[^0-9]/", $qty[0])) { 
				unset($prod_added_2[$prod_id]);  $cart_erro = 1;
			} 
			elseif($cart_ex_arr[$prod_id] and $product_type == 'grouped' ) { 				
				if(!in_array($part_1, $cart_parts_4)) { 
				$keys_25 = array(1);  foreach ($cart_ex_ids as $prod_id_2) { $prod_id_26 = explode('__', $prod_id_2); $prod_id_25 = $prod_id_26[0]; if($prod_id_25 == $prod_id) { $keys_25[] = $prod_id_26[1]; } } /// 
				$key_2 = max($keys_25) + 1;
				$prod_added_2[$prod_id.'__'.$key_2] = $qty;  				
				$prod_parts[$prod_id.'__'.$key_2] = $prod_parts[$prod_id]; 
				}
				unset($prod_added_2[$prod_id]);  unset($prod_parts[$prod_id]);
			}
			elseif($cart_ex_arr[$prod_id]) {
				$cart_new_arr_2[$prod_id] = $cart_ex_arr[$prod_id] + $qty;
				unset($prod_added_2[$prod_id]);
			}
		} // //// //// //// //// //// foreach ($prod_added as $prod_id => $qty) 
		
		$cart_new_arr = $prod_added_2 + $cart_new_arr_2;
		
		$cart_parts_new_arr = $prod_parts + $cart_parts_ex_arr; /// 		
	
		if(!$cart_erro) { WOW_Cart_Session::cart_save_data(array($cart_new_arr, $cart_parts_new_arr)); } /// 
		
	endif;  // ($_POST['prod_id'] or $_POST['product_form'])
}


function cart_update() {
	if($_POST['cart_qty']) :
		$cart_new_arr = $_POST['cart_qty'];	
		$cart_parts_ex_arr = WOW_Cart_Session::cart_parts_array(); /// 	
		global $wp_session;			
		WOW_Cart_Session::cart_save_data(array($cart_new_arr, $cart_parts_ex_arr)); /// 		
	endif;  // ($_POST['cart_qty'])
}


function cart_write_subtotal($cart_arr, $cart_parts_arr) {
	$subtotal_arr_2 = array();
	foreach ($cart_arr as $id_2 => $qty_2) { 
		$prod_parts_arr = array();
		if(count($cart_parts_arr)) { if($cart_parts_arr[$id_2]) {
			$prod_parts_arr = $cart_parts_arr[$id_2];
		} }
	$row_subtotal_arr = WOW_Attributes_Front::cart_row_subtotal($id_2, $qty_2, $prod_parts_arr);
	$subtotal_arr_2[] = $row_subtotal_arr['row_total'];
	}	
	$cart_subtotal = array_sum($subtotal_arr_2);
	
	return $cart_subtotal;
}



function cart_subtotal_base() {  // get subtotal from Session
	global $wp_session;
	$cart_subtotal_base = 0;
	if ($wp_session['cart']) { ////
		$cart_ex = explode('|', $wp_session['cart']);
		$cart_subtotal_base = $cart_ex[0];		
	} // if ($wp_session['cart'])	
	return $cart_subtotal_base;
}

function cart_get_subtotal() {  // get subtotal from Session
	$cart_subtotal_base = WOW_Cart_Session::cart_subtotal_base();
	$act_currency_arr = WOW_Product_List_Func::get_act_currency();
	$act_currency = $act_currency_arr['code'];
	$options_5 = get_option('wow_settings_arr');
	$symb = $act_currency_arr['symbol'];
	$kurs = $act_currency_arr['rate']; 
	$round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }
		$cart_subtotal = $cart_subtotal_base * $kurs; $cart_subtotal = round($cart_subtotal, $round_to);
		$cart_subtotal_txt = $cart_subtotal.'<span>'.$symb.'</span>';
	return $cart_subtotal_txt;
}
	
function cart_get_row_price($id, $qty, $prod_parts_arr) {	
	$act_currency_arr = WOW_Product_List_Func::get_act_currency();
	$act_currency = $act_currency_arr['code'];
	$options_5 = get_option('wow_settings_arr');
	$symb = $act_currency_arr['symbol'];
	$kurs = $act_currency_arr['rate']; 
	$round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }
	if (function_exists('qtrans_getSortedLanguages')) { global $q_config;  // Переклад
	$symb = qtrans_use($q_config['language'], $symb, true);
	} // -- Переклад	

	$row_subtotal_arr = WOW_Attributes_Front::cart_row_subtotal($id, $qty, $prod_parts_arr);
	$item_price = $row_subtotal_arr['item_price'] * $kurs;  $item_price = round($item_price, $round_to);
	$row_total = $row_subtotal_arr['row_total'] * $kurs;  $row_total = round($row_total, $round_to);
	$row_price_arr = array('item_price' => $item_price.'<span> '.$symb.'</span>', 'row_total' => $row_total.'<span> '.$symb.'</span>');
	
	return $row_price_arr;
}

}




class WOW_Viewed_Session {
	
function viewed_array($par) {
	global $wp_session;
	global $post;
	$viewed_arr = array();
	if ($wp_session['viewed']) : ////
		$viewed_arr = explode('|', $wp_session['viewed']);
		if($par == 'side') {
		if ( is_single() ) { if($viewed_arr[0] == $post->ID) { unset($viewed_arr[0]); } }	
		}
	endif; // if ($wp_session['viewed'])
		if($par == 'side') { $v_count = 4; } else { $v_count = 20; }
		$viewed_arr = array_slice(array_values($viewed_arr), 0, $v_count);
		
	return $viewed_arr;
	/* у разі необхідності створити 2 різні масиви 'viewed': 1) для сайдбару - включає лише товари; 2) для роботи ф-ї "к-сть переглядів" - включає всі матеріали (товари, статті блогу ...) */
}

function viewed_save_data($view_arr) {
	global $wp_session;
		$view_new_txt = implode('|', $view_arr);		
	$wp_session['viewed'] = $view_new_txt;
	$wp_session->write_data();
}

function viewed_add_product() {
		global $post;
		$post_type = get_post_type($post);	
		$types = WOW_Attributes_Front::get_attrSet_posttypes();
		
		if(in_array($post_type, $types)) :
		global $wp_session;
		$prod_added = array($post->ID);
		$v_ex_arr = WOW_Viewed_Session::viewed_array(''); // 'add'	
		$v_new_arr_2 = array_merge($prod_added, $v_ex_arr); // $prod_added + $v_ex_arr;
		$v_new_arr = array_unique($v_new_arr_2);		
		$v_new_arr = array_values($v_new_arr);
	
		WOW_Viewed_Session::viewed_save_data($v_new_arr);
		endif; // if(in_array($post_type, $types))
}

}



class WOW_Compare_Session {
	
function compare_array() {
	global $wp_session;
	$comp_arr = array();
	if ($wp_session['compare']) { ////
		$comp_arr = explode('|', $wp_session['compare']);	
		$v_count = 20;		
		$comp_arr = array_slice(array_values($comp_arr), 0, $v_count);
	} // if ($wp_session['compare'])	
	return $comp_arr;
}

function compare_save_data($comp_arr) {
	global $wp_session;
		if(count($comp_arr) > 0) {	
			$comp_new_txt = implode('|', $comp_arr);
		} else { $comp_new_txt = ''; }
	$wp_session['compare'] = $comp_new_txt;
	$wp_session->write_data();
}

function compare_add_product() {
	$po_arr = array_keys($_POST); 
	if (in_array('comp_prod_id', $po_arr)) : 
		// global $wp_session;
		$prod_added = array($_POST['comp_prod_id']);
		$comp_ex_arr = WOW_Compare_Session::compare_array();		
		$comp_new_arr_2 = array_merge($prod_added, $comp_ex_arr); //
		$comp_new_arr = array_unique($comp_new_arr_2);
		// $comp_new_arr = array_values($comp_new_arr);	
		WOW_Compare_Session::compare_save_data($comp_new_arr);
	endif;  // ($_POST['comp_prod_id'])
}

function compare_remove() {
	$po_arr = array_keys($_POST); 
	if (in_array('comp_remove', $po_arr)) : 
		// global $wp_session;
		if($_POST['comp_remove'] == 'all') { $comp_new_arr = array(); }
		else { // ($_POST['comp_remove'] != 'all')
		$rem_id = $_POST['comp_remove'];
		$comp_ex_arr = WOW_Compare_Session::compare_array();
		$comp_new_arr = $comp_ex_arr;
		$comp_keyse = array_flip($comp_ex_arr); $rem_key_1 = $comp_keyse[$rem_id];
		unset($comp_new_arr[$rem_key_1]);	
		} // 
		WOW_Compare_Session::compare_save_data($comp_new_arr);
	endif;  // ($_POST['comp_remove'])	
}

}


class WOW_Rating_Session {
	
function rating_array() {
	global $wp_session;
	global $post;
	$rating_arr = array();
	if ($wp_session['rating']) : ////
		$rating_arr = explode('|', $wp_session['rating']);
	endif; //
		$rating_arr = array_values($rating_arr);	
	return $rating_arr;
}

function rating_save_data($rating_arr) {
	global $wp_session;
		$rating_new_txt = implode('|', $rating_arr);		
	$wp_session['rating'] = $rating_new_txt;
	$wp_session->write_data();
}

function rating_add_product($prod_id) {		
		global $wp_session;
		$prod_added = array($prod_id);
		$v_ex_arr = WOW_Rating_Session::rating_array(); // 'add'	
		$v_new_arr_2 = array_merge($prod_added, $v_ex_arr); // $prod_added + $v_ex_arr;
		$v_new_arr = array_unique($v_new_arr_2);		
		$v_new_arr = array_values($v_new_arr);	
		WOW_Rating_Session::rating_save_data($v_new_arr);		
}

}


class WOW_Product_List_Session {

function product_list_save_data($data) {
	global $wp_session;	
	$wp_session[$data['data_key']] = $data['value'];
	$wp_session->write_data();
}

function view_mode_change() {
	if($_POST) : if($_POST['view_mode']) :
		$data = array('data_key' => 'view_mode', 'value' => $_POST['view_mode']);
		WOW_Product_List_Session::product_list_save_data($data);
	endif; endif;  // ($_POST['view_mode'])
}

function currency_change() {
	if($_POST) : if($_POST['act_currency']) : 
		$data = array('data_key' => 'currency', 'value' => $_POST['act_currency']);
		WOW_Product_List_Session::product_list_save_data($data);
	endif; endif;  // ($_POST['act_currency'])
}

}



?>