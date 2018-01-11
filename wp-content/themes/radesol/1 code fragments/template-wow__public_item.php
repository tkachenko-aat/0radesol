<?php
/*
Template Name: WOW public_item
*/
?>
<?php 
	
	$post_url = $post->post_name; 
	// $post_url = 'add-review';
	$current_user = wp_get_current_user(); 
	$user_type = $current_user->user_url;  $user_type = str_replace('http://', '', $user_type);

// if (!is_user_logged_in() or ($post_url == 'public-company' and $user_type != 'company')) { wp_safe_redirect( get_bloginfo('url') ); } 

/* ***** *****  */
$action = 'add';
	if($_GET['id']) { $my_post = get_post($_GET['id']); }
if($my_post) { $action = 'edit'; $my_id = $my_post->ID; }
/* ***** ______ *****  */

// not logged-in users 
if($action == 'edit') { if($my_post->post_status != 'pending') { wp_safe_redirect(get_bloginfo('url')); } }


 $save_item = WOW_Profile::public_edit_item(); 

WOW_Profile::change_item_status(); 
 
$url_4 = get_permalink(get_page_by_path($post_url)); 
// if($_GET['tax']) { }
if($save_item) { 
if($save_item['new_id']) { $url_5 = $url_4.'?action=OK&id='.$save_item['new_id']; }
else { $url_5 = $url_4.'?id='.$save_item['ID']; }
if($_GET['tax']) { $url_5 = $url_5.'&tax='.$_GET['tax']; }
/* 
echo '<script type="text/javascript">window.location.href = "'.$url_5.'";</script>';
 */
wp_safe_redirect( $url_5 );
} 

$url_new_item = $url_4;  if($_GET['tax']) { $url_new_item = $url_new_item.'?tax='.$_GET['tax']; }


?>
<?php get_header(); ?>

        
<div class="page no_column blog <?php echo $post_url ?>">
  


	 <div id="public_page" class="content">	

     
     <?php // breadcrumbs
   // if (function_exists('breadcrumbs')) breadcrumbs(); 
   $message_succes = __('Your advertisement has been successfully published.'); // __('Your product has been successfully added.')
if($post_url == 'public-company') {
	$message_succes = __('Your company has been successfully added.');
}   
   ?>
 

<?php if($_GET['action'] == 'OK') { // ($save_item['post_id']) ?>
<div class="message succes"><?php echo $message_succes ?></div>
<?php } ?>


    <?php 

$p_type = '';
// $p_type = 'response';

$title = '';
$description = '';
$item_term_id = '';
$item_taxonomy = '';

$taxonomy_active = '';
	if($_GET['tax']) {  
	$tax_1 = get_term_by('term_taxonomy_id', $_GET['tax']);
	if(term_exists($tax_1->term_id, $tax_1->taxonomy)) {  
$taxonomy_active = $tax_1->taxonomy;  
$item_taxonomy = $taxonomy_active;
	} 
	}

$meta_arr = array();

$prod_info_arr = array();
$prod_info_arr['show_phone'] = '';
// $prod_info_arr['price'] = '';
// ...
	$prod_info_arr['first_name'] = ''; $prod_info_arr['last_name'] = ''; $prod_info_arr['email'] = ''; $prod_info_arr['phone'] = ''; $prod_info_arr['country'] = ''; $prod_info_arr['city'] = ''; $prod_info_arr['address'] = '';	
if (is_user_logged_in()) {
	$current_user = wp_get_current_user();  $user_id = $current_user->id;
	$prod_info_arr['email'] = $current_user->user_email;
	$user_meta = get_user_meta($user_id);
	$prod_info_arr['first_name'] = $user_meta['first_name'][0]; $prod_info_arr['last_name'] = $user_meta['last_name'][0];
	$prod_info_arr['phone'] = $user_meta['phone'][0];
	$prod_info_arr['country'] = $user_meta['country'][0];
	$prod_info_arr['city'] = $user_meta['city'][0];
	$prod_info_arr['address'] = $user_meta['address'][0];
}


if($action == 'edit') {
	$title = $my_post->post_title;
	$description = $my_post->post_content;
		$taxonomy_names = get_object_taxonomies( $my_post );  $item_taxonomy = $taxonomy_names[0];
		$terms = wp_get_post_terms($my_id, $item_taxonomy);
		$item_term_id = $terms[0]->term_id;
		
	$meta_arr = get_post_custom($my_id); // $price_2 = $meta_arr['price'][0];
	
foreach ($prod_info_arr as $i_key => $i_val) : 
	if($meta_arr[$i_key][0]) { $prod_info_arr[$i_key] = $meta_arr[$i_key][0]; }
endforeach;		
	// $prod_info_arr['show_phone'] = $meta_arr['show_phone'][0]; 
	// $prod_price = $meta_arr['price'][0];

}
// echo $item_taxonomy; echo '</br>';
// print_r ( $item_term_id ); echo '</br>';
// $text8 = apply_filters('the_excerpt', get_post_field('post_excerpt', $post_id));
$new_lab = __('Add new advertisement'); // __('Add new product') 
$save_new_lab = __('Add advertisement');
if($post_url == 'public-company') {
	$new_lab = __('Add new company');
	$save_new_lab = __('Add company');
}
	?>    

 
	<?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>  

<div class="page_title tit_button">
<?php if($action == 'edit') { ?> <a class="button" href="<?php echo $url_new_item ?>"><?php echo $new_lab ?></a> <?php } ?>
<h2><?php if($action == 'edit') { the_excerpt(); } else { the_title(); } ?></h2>
</div>
    
    <div class="entry-content"> <?php the_content(); ?> </div>
       
	<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	  
 
 
 
    
    <div class="public_content shad_conte">   
  
  
  
    <?php 
$options_5 = get_option('wow_settings_arr');  $opt_currency = $options_5['wow_currency'];
$base_currency = $opt_currency['base'];
$b_symb = $base_currency;  if($opt_currency['symbols'][$base_currency]) { $b_symb = $opt_currency['symbols'][$base_currency]; }

// $options_cities = get_option('wow_cities_list');

	

	$act_currency_arr = WOW_Product_List_Func::get_act_currency(); // ??
	$act_currency = $act_currency_arr['code'];
	$symb = $act_currency_arr['symbol'];
	$kurs = $act_currency_arr['rate'];	
 $round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }

$advertisement_upd_period = 7;
if($options_5['wow_advertisement_upd_period']) {
$advertisement_upd_period = $options_5['wow_advertisement_upd_period'];
}
?>

 
 
    
<form name="form_public_item" id="form_public_item" method="post" action="<?php // bloginfo('url'); echo '/public-item'; ?>" enctype="multipart/form-data" onsubmit="return public_forma_check()" >

 
<?php if($action == 'edit') : ?>
<input type="hidden" name="ID" value="<?php echo $my_id ?>" />

<div class="secto status"> 
<?php /* /1 code fragments/z_wow_checkout_my_item_order.php /// Підключити цей файл, щоб увімкнути функції платної зміни статусу оголошення */ ?>
<?php $statuses_arr = WOW_Profile::post_statuses_list(); 
$p_status = $my_post->post_status;  $status_lab = $statuses_arr[$p_status];
if(in_array($p_status, array('publish', 'future', 'pending'))) {  
$stat_actions = array('draft' => __('Make not active'), 'trash' => __('Delete'));
}
elseif(in_array($p_status, array('draft'))) { $stat_actions = array('pending' => __('Publish')); }
else { $stat_actions = array('draft' => __('Restore')); }

$vip_status = $my_post->pinged;
if(in_array($p_status, array('publish', 'future', 'pending'))) {  
// $vip_stat_actions = array('highlight' => __('Highlight'), 'top' => __('Raise the top'));
$vip_status_labels = WOW_Profile::vip_status_array();
$vip_status_desc_arr = $options_5['wow_advertisement_vip']['desc'];
// $vip_status_labels = array_merge($vip_status_labels, array('publish' => __('Publish')));
$vip_status_arr = $options_5['wow_advertisement_vip']['avail'];
$vip_stat_actions = $vip_status_arr;
if($post_url == 'public-company') {  // /// 'public-company'
$vip_stat_actions = array('publish' => 'publish');
 if($p_status == 'publish') { $vip_stat_actions = array(); }
} /// __ 'public-company'
// unset($vip_stat_actions['simple']);
if($vip_status) { unset($vip_stat_actions[$vip_status]); }
}
?>
    <div class="title">
    <h3><?php _e('Status') ?>:</h3> 
    <span class="stat <?php echo $p_status ?>"><?php echo $status_lab ?></span> 
<?php if($post_url != 'public-company') : ?>
<div class="time_2"> <span><?php // _e('Published') ?> </span> <time><?php echo get_the_time('j.m.Y', $my_id); ?> <?php // the_time('H:i'); ?></time> </div>
<?php endif; ?>
<div class="actions change_status post-<?php echo $p_status ?>">
<ul>
<?php foreach ($stat_actions as $stat_key => $stat_lab) { ?>
<li><a class="<?php echo $stat_key ?>" onclick="item_change_status('<?php echo $my_id ?>', '<?php echo $stat_key ?>')"><?php echo $stat_lab ?></a></li>
<?php } ?>
</ul>
</div>
<?php if($post_url != 'public-company') : ?>
<?php // //// Update 
if(in_array($p_status, array('publish', 'future', 'pending'))) { 
$publ_date = get_the_time( 'Y-m-d', $my_id ); // 'Y-m-d H:i:s' // 2001-03-10 17:16:18 
$date_now = date_create(date('Y-m-d')); // date_create('2009-10-11') 
$date_1 = date_create($publ_date); 
$interval_2 = date_diff($date_1, $date_now);
$interval = $interval_2->format('%R%a'); // echo $interval;
// echo $advertisement_upd_period;
?>
<div class="actions update">
<?php if($interval >= $advertisement_upd_period) { // 7 ?>
<ul>
<li><a class="update" onclick="item_change_status('<?php echo $my_id ?>', 'update_publish')"><?php _e('Update') ?></a></li>
</ul>
<?php } else { ?> <span class="comment"><?php echo sprintf( __('You can update the date %s days after publication'), $advertisement_upd_period); ?></span> <?php } ?>
</div>
<?php } // //// Update ?>
<?php endif; // ($post_url != 'public-company') ?>
    </div> <?php /// class="title" ?> 
    

<?php if(in_array($p_status, array('publish', 'future', 'pending'))) { ?>
<div class="actions change_status vip post-<?php echo $p_status ?> <?php echo $post_url ?>"> <?php /// ****** VIP ?> 
<?php if($vip_status) {  $vip_stat_lab = $vip_status_labels[$vip_status]; ?>
<div class="right_blok vip_stat <?php echo $vip_status ?>"><?php echo $vip_stat_lab ?></div>
<?php } ?>
<?php if(count($vip_stat_actions)) { ?>
<ul>
<?php foreach ($vip_stat_actions as $stat_key => $stat_value) { 
$stat_lab = $vip_status_labels[$stat_key]; ?>
<li><a class="<?php echo $stat_key ?>" title="<?php echo $vip_status_desc_arr[$stat_key] ?>" onclick="item_vip_status('<?php echo $my_id ?>', '<?php echo $stat_key ?>')"><?php echo $stat_lab ?></a></li>
<?php } ?>
</ul>
<?php } ?>
</div> <?php /// ____ ****** VIP ?> 
<?php } ?> 
</div>

<?php endif; /// ($action == 'edit') ?> 



    <div class="secto cats">
    <div class="title" id="public_item_secto_cats_name"><h3><?php _e('Category') ?></h3></div>
<div class="public_cats" id="set_publication_cat_contain">
<?php 
$public_cats = array();
$menu_cats_name = 'm_public_cats';  // if($post_url == 'public-company') { $menu_cats_name = 'm_public_company_cats'; }
	if($taxonomy_active) {  // $tax_1 = get_term_by('term_taxonomy_id', $_GET['tax']);
	$child_terms_main = get_terms( $tax_1->taxonomy, array('parent' => $tax_1->term_id, 'hide_empty' => false) );
	if(count($child_terms_main)) { $public_cats = $child_terms_main; }
	}
    elseif ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_cats_name] ) ) {
	$menu_5 = wp_get_nav_menu_object( $locations[$menu_cats_name] );
	$menu_items = wp_get_nav_menu_items($menu_5->term_id);
		foreach ($menu_items as $item) {  if($item->type == 'taxonomy') {
		$tax_6 = get_term_by('id', $item->object_id, $item->object);
		$public_cats[] = $tax_6;
		} }
	}
	// print_r($public_cats); 
	if(count($public_cats)) : 
$line_5_count = 3;
$num_5 = 0; 
?>
<?php if($_GET['tax']) { ?><div class="title main_cat"><h5><?php echo $tax_1->name ?></h5></div><?php } ?>
<ul class="cats_menu p_cats">
<?php foreach ($public_cats as $tax_5) : ?>
<?php $num_5++; 
$tax_5_id = $tax_5->term_id;  $taxonomy_5 = $tax_5->taxonomy;
$child_terms_2 = get_terms( $taxonomy_5, array('parent' => $tax_5_id, 'hide_empty' => false) );	
$par_1 = $tax_5_id;  $par_2 = $taxonomy_5;
if(count($child_terms_2)) { $par_1 = '';  $par_2 = ''; }
	$termchildren = get_term_children( $tax_5_id, $taxonomy_5 );
	$term_ids_2 = array_merge(array($tax_5_id), $termchildren);		
	?>
    <li class="<?php if(in_array($item_term_id, $term_ids_2) and ($taxonomy_5 == $item_taxonomy)) { ?>act<?php } ?>" id="m_item-<?php echo $taxonomy_5.'-'.$tax_5_id ?>">
    <a onclick="set_public_cat('<?php echo $par_1 ?>', '<?php echo $par_2 ?>', this)" title="<?php echo $tax_5->name ?>">
    <?php if($tax_5->term_thumbnail) { ?>
<div class="cat_image"><?php echo wp_get_attachment_image( $tax_5->term_thumbnail, 'thumbnail' ) ?></div>
	<?php } ?>
    <span><?php echo $tax_5->name ?></span>
    </a>
<?php if(count($child_terms_2)) : ?>

<ul class="level_1">
<?php foreach ($child_terms_2 as $tax_2) { ?>
<?php $child_terms_4 = get_terms( $tax_2->taxonomy, array('parent' => $tax_2->term_id, 'hide_empty' => false) );	
$par_1 = $tax_2->term_id;  $par_2 = $tax_2->taxonomy;
if(count($child_terms_4)) { $par_1 = '';  $par_2 = ''; }
	$termchildren_4 = get_term_children( $tax_2->term_id, $tax_2->taxonomy );
	$term_ids_4 = array_merge(array($tax_2->term_id), $termchildren_4);
?>
<li class="<?php if(in_array($item_term_id, $term_ids_4) and ($tax_2->taxonomy == $item_taxonomy)) { ?>act<?php } ?>">
<a onclick="set_public_cat('<?php echo $par_1 ?>', '<?php echo $par_2 ?>', this)" title="<?php echo $tax_2->name ?>"><span><?php echo $tax_2->name ?></span></a>
<?php if(count($child_terms_4)) : ?>

<ul class="level_2">
<?php foreach ($child_terms_4 as $tax_4) { ?>
<?php 
$par_1 = $tax_4->term_id;  $par_2 = $tax_4->taxonomy;
?>
<li class="<?php if(($tax_4->term_id == $item_term_id) and ($tax_4->taxonomy == $item_taxonomy)) { ?>act<?php } ?>">
<a onclick="set_public_cat('<?php echo $par_1 ?>', '<?php echo $par_2 ?>', this)" title="<?php echo $tax_4->name ?>"><span><?php echo $tax_4->name ?></span></a>
</li>
<?php } ?>
</ul>

<?php endif; // ($child_terms_4) ?>
</li>
<?php } ?>
</ul>

<?php endif; // ($child_terms_2) ?> 
    </li>
 <?php // endif; // ($item->type == 'taxonomy') ?>
<?php endforeach; ?>
</ul>
<?php endif; // if(count($public_cats))  ?>

<input type="hidden" name="term_id" class="required" value="<?php echo $item_term_id ?>" />
<input type="hidden" name="taxonomy" value="<?php echo $item_taxonomy ?>" />


</div>
	</div>



<div class="secto main">

<div class="title"><h3><?php _e('Main information') ?></h3></div>

<?php /* <input type="hidden" name="p_type" value="<?php echo $p_type ?>" /> */ ?> 

<ul class="main_info fields wide">

	<li>    
<label for="title"><?php _e('Title') ?><span class="req">*</span></label>
<div class="box"><input type="text" name="title" id="title" value="<?php echo $title ?>" title="<?php _e('Title') ?>" class="required" maxlength="150" placeholder="<?php _e('Title') ?>" /></div>
	</li>  
	<li>     
<label for="description"><?php _e('Description') ?><span class="req">*</span></label>
<div class="box"><textarea name="description" id="description" class="required" placeholder="<?php _e('Description') ?>"><?php echo $description ?></textarea></div>
	</li>
<?php /* 	<li>    
<label for="par_price"><?php _e('Price') ?>, <span class="symb"><?php echo $b_symb ?></span> <span class="req">*</span></label>
<div class="box"><input type="text" name="atrib[price]" id="par_price" value="<?php echo $prod_info_arr['price'] ?>" class="short required" maxlength="150" placeholder="<?php _e('Price') ?>" /></div>
	</li> */ ?>
</ul>

</div> 



<div class="secto imag">

<div class="title"><h3><?php _e('Images') ?></h3></div>



<?php $fileupload_arr = array('img_1', 'img_2', 'img_3', 'img_4', 'img_5'); 
if($action == 'edit') {
	$excerpt2 = $my_post->post_excerpt;	
$ids_12 = explode('ids="', $excerpt2); 
if(count($ids_12) > 1) { $ids_2 = $ids_12[1]; $ids_3 = explode('"', $ids_2); $ids_4 = $ids_3[0]; 
$image_gallery2 = explode(',', $ids_4); }
// print_r($excerpt2);
}
?>
<ul class="fileupload">
    <?php $num = 0;
	foreach ($fileupload_arr as $inp_1) : ?>
<li>
<div class="file_upload">
<div class="input_file_con"><input type="file" name="<?php echo $inp_1 ?>" value="" onchange="img_uplo_preview(this)" /></div>

<div class="img_con">
<?php if($image_gallery2[$num]) { echo wp_get_attachment_image( $image_gallery2[$num], 'thumbnail' ); } 
else { echo '<span class="note">'.__('Please select a file').'</span>'; } ?>
</div>

</div>
</li>
	<?php $num++;
	endforeach;  ?>

</ul>

</div> 



<div id="prod_attributes_spec_list" class="secto attrs ajax_replace2_content">

<?php 
$attrib56_arr = array();
// if($taxonomy_active)
if($action == 'edit' or $taxonomy_active or $_POST['change_taxonomy']) : //// ///////////////////////////////////////////
global $wpdb;
/* ** attributes_arr ** */
if($action == 'edit') {
	$atr_arr_par = $my_id;
}
if(($action == 'add' and $taxonomy_active) or $_POST['change_taxonomy']) { 
	$cur_taxonomy = $taxonomy_active;
	if($_POST['change_taxonomy']) { $cur_taxonomy = $_POST['change_taxonomy']; }
	$p_type_2 = get_taxonomy($cur_taxonomy)->object_type[0];
	$atr_arr_par = $p_type_2; 
}
$groups_atr_arr = post_attributes_arr($atr_arr_par);
/* ** ____ ** */
?>

	<?php foreach ($groups_atr_arr as $group) : ?> 
    
<div class="secto <?php echo $group['code'] ?>">
    <div class="title"><h3><?php echo $group['name'] ?></h3></div> 

    <ul class="<?php echo $group['code'] ?> fields wide">
    
    <?php foreach ($group['items'] as $attribute) :  
				if(!in_array($attribute['backend_input'], array('map'))) : 
	$attrib56_arr[] = 'atrib['.$attribute['code'].']'; ///// ////// attrib56_arr 
	
	if(strpos($attribute['code'], 'price') !== false) { ///	
		$attribute['frontend_unit'] = $b_symb;
	} ///	
	$item_id = 'atr-'.$attribute['code'];
	$item_class = '';  if($attribute['is_required'] == 'yes') { $item_class = 'required'; }
	?>
    
    <li class="atr_item <?php echo $attribute['backend_input'] ?>">

<label for="<?php echo $item_id ?>"><?php echo $attribute['frontend_label'] ?><?php if($attribute['frontend_unit']) { ?>, <span class="unit"> <?php echo $attribute['frontend_unit'] ?></span><?php } ?> <?php if($attribute['is_required'] == 'yes') { ?><span class="req">*</span><?php } ?></label>

<div class="box">
	<?php 
	$meta_key_1 = $attribute['code'];
	 
// add_post_meta($my_id, $meta_key_1, '', true);
// $m_value = get_post_meta ($my_id, $meta_key_1, true);
$m_value = $meta_arr[$meta_key_1][0];  // $meta_arr = get_post_custom($my_id); 
$m_values_arr = array();  if($meta_arr[$meta_key_1]) { $m_values_arr = $meta_arr[$meta_key_1]; } //// 
?>
      
<?php if ($attribute['backend_input'] == 'text' ) { ?>
<input type="text" name="atrib[<?php echo $meta_key_1 ?>]" id="<?php echo $item_id ?>" class="<?php echo $item_class ?>" value="<?php echo $m_value ?>" title="<?php echo $attribute['frontend_label'] ?>" />  
    
<?php } elseif ($attribute['backend_input'] == 'checkbox' ) { ?>
<input type="hidden" name="atrib[<?php echo $meta_key_1 ?>]" value="0" />
<input type="checkbox" name="atrib[<?php echo $meta_key_1 ?>]" id="<?php echo $item_id ?>" class="type-check" value="1" <?php if ($m_value == 1) { ?>checked="checked"<?php } ?> />

<?php } elseif (in_array($attribute['backend_input'], array('select'))) { ?>
<div class="select_box">
<i class="ja ja-caret-down"></i> 
<select name="atrib[<?php echo $meta_key_1 ?>]" id="<?php echo $item_id ?>" class="<?php echo $item_class ?>" title="<?php echo $attribute['frontend_label'] ?>">
        	<option value="">  </option>
		<?php foreach ($attribute['options'] as $option) { ?>
        	<option value="<?php echo $option['id'] ?>" <?php if ($option['id'] == $m_value) { ?>selected="selected"<?php } ?>><?php echo $option['label'] ?></option>
		<?php } ?>
</select>
</div>

<?php } elseif ($attribute['backend_input'] == 'multiple-select' ) { ?>
	<input type="hidden" name="atrib[<?php echo $meta_key_1 ?>][0]" value="0" />
    	<?php foreach ($attribute['options'] as $option) { 
		$opt_id = $option['id'];  $item_id_2 = $item_id.'-'.$opt_id; ?>
	<div class="opt">
    <input type="checkbox" name="atrib[<?php echo $meta_key_1 ?>][<?php echo $opt_id ?>]" id="<?php echo $item_id_2 ?>" class="type-check" value="<?php echo $opt_id ?>" <?php if(in_array($opt_id, $m_values_arr)) { ?>checked="checked"<?php } ?> />
    <label for="<?php echo $item_id_2 ?>"><?php echo $option['label'] ?></label>
    </div>
		<?php } ?>
        
<?php } elseif ($attribute['backend_input'] == 'textarea' ) { ?>
<textarea name="atrib[<?php echo $meta_key_1 ?>]" id="<?php echo $item_id ?>" class="<?php echo $item_class ?>"><?php echo $m_value ?></textarea>

<?php } elseif ($attribute['backend_input'] == 'date' ) { /// function scripts_for_datepicker ?>
<?php if($num_d != 1) { ?>
	<script>
jQuery(document).ready(function($) {  
	$( ".datepicker" ).datepicker( { 
  dateFormat: "dd.mm.yy", 
  changeYear: true 
  } ); 
});
	</script>
<?php } ?>
<?php $num_d = 1; ?>
<input type="hidden" name="<?php echo $item_input_key ?>" value="<?php echo $attribute['code'] ?>" />
<input type="text" name="<?php echo $item_input_name ?>" class="datepicker" id="<?php echo $item_id ?>" value="<?php echo $input_value ?>" readonly="readonly" /> <span><strong><?php _e('Choose a date') ?></strong></span>

<?php }  ?> 
  
</div> <!-- box -->
    </li>
    <?php endif;  endforeach; ///  ?>
    </ul>
    </div>
	
	<?php endforeach; ?>

<?php endif; // ($action == 'edit') ///////////////////////////////////////// ?>

</div>



<div class="secto map">
    <div class="title"><h3><?php _e('Map') ?></h3></div> 
<?php /* Google Map */
 wp_register_script( 'fields_map', get_template_directory_uri().'/lib/wow_e_shop/js/fields_map.js', array(), '1.0', true );
 wp_enqueue_script( 'fields_map' );
$map_meta_key = 'location_map';
$map_value = $meta_arr[$map_meta_key][0];  
$map_coords = array('address' => 'Kyiv, Ukraine', 'lat' => 50.42353284574126, 'lng' => 30.51974058151245);
if($map_value) {
$map_coords_2 = explode('||', $map_value);
$map_coords = array('address' => $map_coords_2[2], 'lat' => $map_coords_2[0], 'lng' => $map_coords_2[1]);
}
$options4 = get_option('site_add_settings_4');  $map_api = $options4['my_google_map_api'];
if(!$map_api) { $map_api = 'AIzaSyB26HqhWs5_arfnhGuRbUBh4limZ7PCRy8'; }
?>
<script>
my_google_map_api = '<?php echo $map_api ?>';
</script>
<div class="acf-google-map" data-zoom="14">
	<input type="hidden" class="map-value" name="atrib[<?php echo $map_meta_key ?>]" value="<?php echo $map_value ?>" />
				<?php foreach( $map_coords as $coord => $coord_val ): ?>
		<input type="hidden" class="input-<?php echo $coord; ?>" value="<?php echo $coord_val; ?>" />
				<?php endforeach; ?>			
			<div class="title">				
				<div class="has-value">
<div class="submitbox"> <a href="#" class="acf-sprite-remove ir submitdelete" title="<?php _e('Delete'); ?>"><?php _e('Delete'); ?></a> </div>
					<h4 class="map_tit"><?php echo $map_coords['address']; ?></h4>
				</div> 		
 <div class="no-value"> <?php /* <a href="#" class="acf-sprite-locate ir" title="<?php _e("Find current location"); ?>">Locate</a> */ ?> <input type="text" placeholder="<?php _e('Search for address...'); ?>" class="search" style="width:70%;" /> </div>            				
			</div>			
			 <div class="canvas" style="height: 400px;"> </div>             		
</div>
</div>
 
 

<div class="secto customer">
    <div class="title"><h3><?php _e('Customer information') ?></h3></div>    
    <?php 
	
	$customer_info_arr = array( 
		'first_name' => array('label' => __('First Name'), 'value' => $prod_info_arr['first_name'], 'clas' => 'required'),
  // 'last_name' => array('label' => __('Last Name'), 'value' => $prod_info_arr['last_name'], 'clas' => ''),
		'email' => array('label' => __('Email'), 'value' => $prod_info_arr['email'], 'clas' => ''),
		'phone' => array('label' => __('Phone'), 'value' => $prod_info_arr['phone'], 'clas' => 'required'),
		// 'show_phone' => array('label' => __('Show phone'), 'value' => 1, 'clas' => '', 'type' => 'checkbox')
		// 'city88' => array('label' => __('City'), 'value' => $city, 'clas' => 'required', 'type' => 'select', 'options' => $options_cities, 'comment' => array($city_comment, $city_comment_2)),
		// 'address' => array('label' => __('Address'), 'value' => $address, 'clas' => ''),		
	); // 
if($user_type == 'company') { 
$customer_info_arr['first_name']['label'] = __('Company name');
}
	?> 

    <ul class="customer fields wide">
    <?php foreach ($customer_info_arr as $key => $info) : 
	$attrib56_arr[] = 'atrib['.$key.']'; ///// attrib56_arr 
	?>
    <?php $field_id = 'customer-'.$key; ?>
    <li class="<?php echo $info['type'] ?>">
    <label for="<?php echo $field_id ?>"><?php echo $info['label'] ?><?php if($info['clas'] == 'required') { ?><span class="req">*</span><?php } ?></label>
    <div class="box">
    <?php if($info['type'] == 'select') { ?>
    	<?php if( count($info['options']) ) : ?>
    <div class="select_box">
    <select name="atrib[<?php echo $key ?>]" id="<?php echo $field_id ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>" >
    <option value=""><?php _e('Select a city') ?></option>
	<?php foreach ($info['options'] as $option_1) { ?>
    <option value="<?php echo $option_1['label'] ?>"<?php if($option_1['label'] == $info['value']) { ?> selected="selected"<?php } ?>><?php echo $option_1['label'] ?></option>
    <?php } ?>
    </select>
    </div>	
		<?php endif; ?>
	<?php } elseif($info['type'] == 'checkbox') { ?>
	<input type="checkbox" name="atrib[<?php echo $key ?>]" id="<?php echo $field_id ?>" value="<?php echo $info['value'] ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>"<?php if($prod_info_arr[$key] == 1) { ?> checked="checked"<?php } ?> />
	
	<?php } else { ?>
    <input type="text" name="atrib[<?php echo $key ?>]" id="<?php echo $field_id ?>" value="<?php echo $info['value'] ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>" maxlength="50" placeholder="<?php echo $info['label'] ?>" />
	<?php } ?>
    </div>
    </li>
    <?php endforeach; ?>
    </ul>
</div>

     
     
    <div class="form_notice" id="public_f_notice_text_5"><?php /* notice text */ ?></div>     
     

<div class="but_line p_line">
<?php /* <span id="notice_text_2nd_stage" class="comment"<?php if($action == 'edit') { ?> style=" display: none;"<?php } ?>><?php _e('Save and go to 2nd stage') ?></span> */ ?>
<?php if($action == 'edit') { $subm_val = __('Save'); } else { $subm_val = $save_new_lab; } 
// $subm_val = __('Save'); // $subm_val = __('Publish');
// __('Add product') __('Add advertisement') 
?>
<input type="submit" name="submit" class="button public" value="<?php echo $subm_val ?>" />
</div>  

</form>
   
  


<script type="text/javascript">
function item_change_status(item_id, status) {
  var url2 = window.location.href;
  new Ajax.Updater( '', url2, { 
  	method: 'post',
    parameters: {change_item_id: item_id, change_item_status: status},
	onComplete: 
		function() {
			window.location.href = url2;
		} // onComplete function
	} );
}



function item_vip_status(item_id, vip_stat) {
	// VIP статус, опублікувати компанію 
show_lightb_window('checkout_my_item_page');  var lig_cart = lightb_cart; ///
ajax_prepare_html(cart_page2_container);
	
	new Ajax.Updater( page_temp.id, '<?php bloginfo('url'); echo '/checkout-my-item/'; ?>', { 
	method: 'post',
	parameters: {vip_status_prod_id: item_id, vip_status: vip_stat}, 
	evalScripts: true, //
	onComplete: 
		function() {
			lig_cart.className = lig_cart.className.replace(/small/g, ''); 
			page_replace_new(cart_page2_container);	
		}
	} );
} 



function set_public_cat(term_id2, taxonomy2, element) {
	var block_upd_2;
	var li_bloks = document.getElementById("set_publication_cat_contain").getElementsByTagName("LI");
		for (var i = 0; i < li_bloks.length; i++) {			
 		li_bloks[i].className = "";	
		} 
	var curve_li = element.parentNode;
	curve_li.className = 'act';
	
	var curve_li_2 = curve_li.parentNode.parentNode;
	if(curve_li_2.tagName == 'LI') { 
	curve_li_2.className = 'act'; 
		var curve_li_3 = curve_li_2.parentNode.parentNode;
		if(curve_li_3.tagName == 'LI') { 
		curve_li_3.className = 'act'; 
		}
	} ///

	var forma_publ = document.forms.form_public_item;
	var input_term_id = forma_publ.elements['term_id'];
	var input_taxonomy = forma_publ.elements['taxonomy'];
	
	if(term_id2) {
	input_term_id.value = term_id2;
	input_taxonomy.value = taxonomy2;
	
  var url2 = window.location.href;  // 
  block_upd_2 = document.getElementById("prod_attributes_spec_list");
  
  ajax_prepare_html(block_upd_2);
  new Ajax.Updater( page_temp.id, url2, { 
  	method: 'post',
    parameters: {change_taxonomy: taxonomy2},
	evalScripts: true, //
	onComplete: 
		function() { page_replace_new(block_upd_2); }
	} );
	}
	
	else {
	input_term_id.value = '';
	input_taxonomy.value = '';
	}
}


function public_forma_check() {
pub_forma_check_fields(); /*  */ // errore 
if ( errore == 1 )  {
	return false;
}
}


function pub_forma_check_fields() {
<?php $attrib25_arr = array_merge(array('title', 'description'), $attrib56_arr); 
// 'term_id' 
?>
	var notice_text = "<?php _e('Fill the field!') ?>";
	var notice = document.getElementById("public_f_notice_text_5");
	var forma_public = document.forms.form_public_item;

	errore = 0;
<?php $arr45_text = '"'.implode('", "', $attrib25_arr).'"'; ?>
var arr45 = [<?php echo $arr45_text ?>]; // var arr45 = [input_title, input_phone];

		for (var i = 0; i < arr45.length; i++) { /////// ////
		if(forma_public.elements[arr45[i]]) {  	
		inp_field4 = forma_public.elements[arr45[i]]; 
		if(inp_field4.length > 1) { inp_field4 = inp_field4[0]; } ////
  if ( inp_field4.className.indexOf("required") != -1 ) { // alert(inp_field4.name);
   if ( inp_field4.value.length < 1 ) {
    inp_field4.focus();
	inp_field4.className += ' error'; 	errore = 1;	
  } else { inp_field4.className = inp_field4.className.replace(/error/g, ''); }
 if(inp_field4.parentNode.className.indexOf("select_box") != -1) {  if(inp_field4.className.indexOf("error") != -1) { inp_field4.parentNode.className += ' error'; } else { inp_field4.parentNode.className = inp_field4.parentNode.className.replace(/error/g, ''); }  }
  }		
		}
		} // //////// for 

if(forma_public.elements['atrib[email]']) { 
	var input_email = forma_public.elements['atrib[email]'];
  if ( input_email.className.indexOf("required") != -1 ) { 
   var reg_email = /^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;
   if ( !input_email.value.match(reg_email) ) {
    input_email.focus();
	input_email.className += ' error'; 	errore = 1;	
  } else { input_email.className = input_email.className.replace(/error/g, ''); }
  }   
}

	var input_term_id = forma_public.elements['term_id']; // hidden 
  if ( input_term_id.className.indexOf("required") != -1 ) { //
  var cats_block = document.getElementById("set_publication_cat_contain");
   if ( input_term_id.value.length < 1 ) {
    // inp_field4.focus();
	cats_block.className += ' error'; 	errore = 1;	
  } else { cats_block.className = cats_block.className.replace(/error/g, ''); }
  }
    
  if ( errore == 1 )  {
	notice.className += ' error';
	notice.innerHTML = notice_text;
    return false;
	}
	
}



function img_uplo_preview(input) {
jQuery(document).ready(function($) {
	var img_co = $(input).parent().parent().find(".img_con");
	img_co.html("");
	// img_co.addClass("activ");    
		if (input.files && input.files[0]) {
		fullName = input.value;  shortName = fullName.match(/[^\/\\]+$/);
            var reader = new FileReader();		
			// $(input).parent().addClass("activ");
		    img_co.append("<span></span> <img />");
            reader.onload = function (e) {
    			img_co.find("img").attr('src', e.target.result);
				img_co.find("span").html(shortName);
            }            
            reader.readAsDataURL(input.files[0]);
        }
});
}
</script>



 
  

    
    </div>    
	
	           
    </div>      
	


     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>