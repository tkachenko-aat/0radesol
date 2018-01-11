<?php 

class WOW_Checkout_my_item {
	
function save_my_item_order() {
	if($_POST['prod_vip_status']) : 

$products = $_POST['prod_vip_status'];
$prod_arr = array();
foreach ($products as $id => $vip_status) { 
$prod_arr[$id]['prod_id'] = $id;
$prod_arr[$id]['vip_status'] = $vip_status;
}

$prod_arr = array_values($prod_arr);


$options_5 = get_option('wow_settings_arr');
$adv_vip_arr = $options_5['wow_advertisement_vip'];
	$subtotal_base = 2;
	$adv_price = $adv_vip_arr['price'][$vip_status];	
	if($adv_price) { $subtotal_base = $adv_price; }

	// $adv_period = 30;
	$adv_period = $options_5['wow_advertisement_period'];
	$adv_period_2 = $adv_vip_arr['period'][$vip_status];
	if($adv_period_2) { $adv_period = $adv_period_2; }
	
	$act_currency_arr = WOW_Product_List_Func::get_act_currency();
	$currency = $act_currency_arr['code'];	
	$kurs = $act_currency_arr['rate']; 
	$symb = $act_currency_arr['symbol']; 
	
		$pay_method = $_POST['payment_method'];	
		$comme = $_POST['comment'];		
		$prod_id = $prod_arr[0]['prod_id'];
		$vip_status = $prod_arr[0]['vip_status'];
$vip_status_labels = WOW_Profile::vip_status_array(); $vip_status_lab = $vip_status_labels[$vip_status];
				
		$post_arr_2 = array();		
		$post_arr_2['prod_id'] = $prod_id;
		$post_arr_2['vip_status'] = $vip_status;
		$post_arr_2['period'] = $adv_period;
		$post_arr_2['payment_method'] = $pay_method;
		$post_arr_2['subtotal_base'] = $subtotal_base;
		$post_arr_2['shipp_price_base'] = 0;
		$post_arr_2['currency'] = $currency;
		$post_arr_2['kurs'] = $kurs;

$post_arr_s = serialize($post_arr_2);

// $products_txt = '<span class="tit">'.get_the_title($prod_id).'</span>';
$post_title = $vip_status_lab.' - ('.$prod_id.') '.get_the_title($prod_id);

$author = 1; 
if($_POST['p_author']) { $author = $_POST['p_author']; }
$new_post = array(
  'post_title'    => $post_title,
  // 'post_name'   => $post_name,
  'post_content'  => $comme,
  'post_excerpt'  => $post_arr_s,
  'post_author'   => $author,
  'pinged'   => 'pending',
  'post_type'   => 'wow_my_item_order', ///
  'post_status'   => 'private',
  // 'comment_status'  => 'closed',
  'ping_status'   => 'closed',
);
	
	
	if($prod_id) { 
	/// create order					
	$post_id_last = wp_insert_post( $new_post, $wp_error );

$post_arr_25 = array_merge(array('order_id' => $post_id_last), $post_arr_2); //


/* ******* Зачистка session в БД (таблиця wp_options)  ******* */
$min_counte = 200; // мін. к-сть рядків _wp_session_ у таблиці для виконання зачистки
$recent_counte = 10; // к-сть останніх рядків, які слід залишити 
global $wpdb;
$options_arr5 = $wpdb->get_results( "SELECT option_id FROM $wpdb->options WHERE $wpdb->options.option_name LIKE ('_wp_session_%') ORDER BY $wpdb->options.option_id DESC" , ARRAY_A );
if(count($options_arr5) > $min_counte) {
	$arr5_4 = array_slice($options_arr5, 0, $recent_counte);
	$opt_ids_arr7 = array();
	foreach ($arr5_4 as $key_2 => $value) { $opt_ids_arr7[] = $value['option_id']; }
	$recent_opt_ids = "(".implode(", ", $opt_ids_arr7).")";
	$query7 = "DELETE FROM $wpdb->options WHERE $wpdb->options.option_name LIKE ('_wp_session_%') AND $wpdb->options.option_id NOT IN $recent_opt_ids";
	$wpdb->query($query7);
	$query8 = "DELETE FROM $wpdb->options WHERE $wpdb->options.option_name LIKE ('%transient_%')";
	$wpdb->query($query8);

}   else {  }
/* *******  ******* */


	/// вивести масив з інф-ю про зроблене замовлення		
	return $post_arr_25;
	}
	
	else { return false; }	// if(!count($products))
	
	
	else : return false;	
	endif;  // ($_POST['prod_vip_status'])

}



}




function wow_custom_types_in_6() { 
 
register_post_type( 'wow_my_item_order',
		array(
			'labels' => array(
				'name' => __( 'Оплата за VIP' ), // __('Payment') 
				'singular_name' => __( 'Payment' ),
				'add_new' => __( 'Add New Payment' ),
				'add_new_item' => __( 'Add New Payment' ),
				'edit' => __( 'Edit Payment' ),
				'edit_item' => __( 'Edit Payment' ),
			),			
			'supports' => array( 'title', 'editor' ),
			'public' => true,
			'show_in_menu' 			=> true,
			'menu_position' 	=> 53,	
			'show_in_nav_menus' 	=> false,
			'capabilities' => array( 'create_posts' => false ),
			'map_meta_cap' => true,
			// 'taxonomies' 			=> array(),
			// 'rewrite' 			=> true,
			'rewrite' => array('slug' => 'my-order', 'with_front' => false),
			// 'has_archive'			=> true,
			// 'exclude_from_search' 	=> true,	// !!!!	може викликати проблеми з показом категорій				
			// 'hierarchical' 			=> false,	
			'menu_icon' 	=> get_template_directory_uri() . '/lib/wow_e_shop/files/icon_orders.png',
			// 'show_in_menu' 			=> 'edit.php?post_type=' . $post_type_7,
			// 'publicly_queryable' 	=> false, // НЕ показувати на сайті (тільки в адмінці)			
		)
);

}

add_action( 'init', 'wow_custom_types_in_6', 2 );



 add_filter('manage_wow_my_item_order_posts_columns', 'wow_my_item_order_columns_head', 0);  
 add_action('manage_wow_my_item_order_posts_custom_column', 'wow_my_item_order_columns_content', 10, 2);

function wow_my_item_order_columns_head($columns) { 
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'products' => __( 'Products' ),
		'grandtotal' => __( 'Grand total' ),
		'date' => __( 'Date' ),
		'order_status' => __( 'Status' )
	);    
	return $columns;  
}

function wow_my_item_order_columns_content($column_name, $post_ID) {
    if ($column_name == 'grandtotal') {
		$billing_arr = WOW_Checkout::order_billing_info($post_ID);
		echo $billing_arr['grand_total'];	
	}
	elseif ($column_name == 'products') {	
		$excerpt = get_the_excerpt($post_ID);
		if ( !empty($excerpt) ) { $excerpt_arr = unserialize($excerpt); }
		$prod_id = $excerpt_arr['prod_id'];
		$products_txt = '<span class="tit">'.get_the_title($prod_id).'</span>';	
		echo $products_txt;
	}
	elseif ($column_name == 'order_status') {
		$post2 = get_post($post_ID);  $order_status = $post2->pinged;		
		$status_arr = WOW_Checkout::order_status_array();
		echo '<div class="order_stat '.$order_status.'">'.$status_arr[$order_status].'</div>';		
	}
}  


add_action('add_meta_boxes', 'add_wow_my_item_order_meta_boxes'); // 'admin_init'
 
function add_wow_my_item_order_meta_boxes() {
add_meta_box('wow_my_item_order_status', __('Status'), 'wow_my_item_order_status_box', 'wow_my_item_order', 'side', 'high');
add_meta_box('wow_my_item_order_client', __('Customer'), 'wow_my_item_order_client_box', 'wow_my_item_order', 'side', 'high');
add_meta_box('wow_my_item_order_billing', __('Payment and Shipping'), 'wow_my_item_order_billing_box', 'wow_my_item_order', 'side', 'high');
}


 
function wow_my_item_order_status_box() {
		global $post;
		$status_arr = WOW_Checkout::order_status_array();
		if($post->pinged == '' or $post->pinged == 'pending') {
		wp_update_post( array('ID' => $post->ID, 'pinged' => 'processing') );
		}
		global $post;
		$order_status = $post->pinged;
		echo '<div class="order_stat '.$order_status.'">'.$status_arr[$order_status].'</div>';
		
		echo '<span>'.__('Change status').'</span> ';
		echo '<select name="pinged" id="pinged">';	
		foreach ($status_arr as $opt_key => $label) {
        	echo '<option value="'.$opt_key.'"'; if($opt_key == $order_status) { echo 'selected="selected"'; } echo '>'.$label.'</option>';
		} 
		echo '</select>';
}

function wow_my_item_order_client_box() {
		global $post;
		$output = '';
			$post2 = get_post($post->ID);  $user_id = $post2->post_author;			
		if($user_id) { 
			$user_login = get_the_author_meta('user_login', $user_id);
			$user_meta = get_user_meta($user_id);
			$user_name = $user_meta['first_name'][0].' '.$user_meta['last_name'][0];
	
	$output .= '<span class="authore">'.__('User id').':  <span class="bolde">'.$user_id.'</span></span>';
	$output .= '<span class="authore">  '.__('Login Name').':  <span class="bolde">'.$user_login.'</span></span></br>';
	$output .= '<span class="authore">'.__('Name').':  <span class="bolde">'.$user_name.'</span></span></br></br>'; 
		}			
		$excerpt = get_the_excerpt($post->ID);
		if ( !empty($excerpt) ) {			
			$excerpt_arr = unserialize($excerpt);
			$vip_status = $excerpt_arr['vip_status'];
			$period = $excerpt_arr['period'];
	$output .= '<span class="vip_2">'.__('VIP Status').':  <span class="bolde">'.$vip_status.'</span></span></br>';
	$output .= '<span class="vip_2">'.__('Period, days').':  <span class="bolde">'.$period.'</span></span>';
		}
		
		echo $output;
}

function wow_my_item_order_billing_box() {
		global $post;
		$output = '';
		$billing_arr = WOW_Checkout::order_billing_info($post->ID);				
$output .= __('Payment method').':  <span class="bolde">'.$billing_arr['pay_label'].'</span></br>';				
$output .= '<span class="u_total">'.__('Subtotal').':  '.$billing_arr['cart_subtotal'].'</span></br>';
			
		echo $output;
}



 
?>