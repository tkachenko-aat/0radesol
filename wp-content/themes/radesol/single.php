<?php get_header(); ?>

<?php 
	$post_type = get_post_type( $post );   
		$taxonomy_names = get_object_taxonomies( $post );  $taxonomy = $taxonomy_names[0];
		$terms = wp_get_post_terms($post->ID, $taxonomy);
		$term_4 = $terms[0];
?>


<div class="post-w blog type-<?php echo $post_type; ?> cat-<?php echo $term_4->parent; ?> cat-<?php echo $term_4->term_id; ?>">


    <?php // Лівий сайдбар ?>
    <?php include 'column-left.php'; ?>



<div class="content">


 <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
   
 
<?php /* 
<div class="category_title"> 
<h3><a href="<?php echo get_term_link( $term_4 ); ?>"><?php echo $term_4->name; ?></a></h3> 
<?php if($_SERVER['HTTP_REFERER']) { ?>
<div class="go_back"><a class="button back" href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><?php _e('View all') ?><?php // _e('Show all') ?></a></div>
<?php } ?>
</div>
 */ ?>


<?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
 

<?php $post_id = $post->ID;
$post_id_gen = $post->ID; ?>

<?php $product_type = get_post_meta($post->ID, 'product_type', true); ?>


<?php ///// configurable
$configur_disp_mode = 0;  // 0 - information from conf. product;  1 - ... from main simple product; 
$con_main_prod_id = '';
if($product_type == 'configurable') { $con_main_prod_id = WOW_Attributes_Front::configurable_prod_default(); }
if($con_main_prod_id and $configur_disp_mode == 1) { $post_id_gen = $con_main_prod_id; }
///// configurable  ?>



<div class="product-view" id="post-item-<?php echo $post_id ?>">


    <?php $map_meta_key = 'location_map'; // Google Map 
	$map_post_id = $post_id; // $post_id_gen ?>
	<?php if(get_post_meta($post_id, $map_meta_key, true)) : 
 $options4 = get_option('site_add_settings_4');  $map_api = $options4['my_google_map_api'];
if(!$map_api) { $map_api = 'AIzaSyB26HqhWs5_arfnhGuRbUBh4limZ7PCRy8'; } ?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $map_api ?>&libraries=places"></script>
	<?php endif; // __ Google Map ?>


<?php // $post_id; // $post_id_gen 
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?>


<div class="product-shop type-<?php echo $product_type ?>">


<div class="prod-left">    
<?php include WOW_DIRE.'front_html_blocks/media_section.php'; /* wow_e_shop *** media_section *** */ ?> 
<?php /* ...... */ ?>   
</div>

<div class="prod-main maine">

	<header>
 	 <div class="page_title"> <h1><?php the_title(); ?></h1> </div>
	<?php /* <time datetime="<?php the_time( 'Y-m-d' ); ?>" class="published"> <?php the_time('j.m.Y'); ?> </time> */ ?>
    <?php $stock_2 = get_post_meta($post_id_gen, 'stock', true); ?>
	<?php $product_sku = get_post_meta($post_id_gen, 'sku', true); ?>
    <div class="prod-avail-sku">
    <div class="availabil">  
						<?php if($stock_2 > 0 or $stock_2 == '') : ?>
<label class="availability in-stock" title="<?php // _e('In stock') ?>"><?php // _e('Availability:') ?><i class="fa fa-check" aria-hidden="true"></i> <span><?php _e('In stock') ?></span></label>   
						<?php else: ?>
<label class="availability out-of-stock" title="<?php // _e('Out of stock') ?>"><?php // _e('Availability:') ?> <span><?php _e('Out of stock') ?></span></label>
                    	<?php endif; ?> 
	</div>    
    <?php if($product_sku) { ?><div class="product-sku"><span><?php _e('Sku') ?>:</span> <?php echo $product_sku ?></div><?php } ?>
    </div>

<?php /* wow_e_shop.php -  add_action('wp_head', 'set_prod_rating'); */ ?>
<?php 
$rating = get_post_meta($post_id, 'rating', true); 
if($rating) {$rating = $rating;} else {$rating = 0;} 
$rating_max = 5;
$perc_rating = round(($rating / $rating_max)*100, 1) ;
?>
<div class="rating_c">
<?php if($rating) { ?>
<div class="curr_rating"> 
<span class="lab"><?php _e('Rating') ?></span>
<a class="rating" title="<?php echo $rating ?>"> <div class="rating_val" style="width:<?php echo $perc_rating ?>%;"></div> </a>
</div>
<?php } ?>
<?php include WOW_DIRE.'front_html_blocks/rating_box.php'; /* wow_e_shop *** rating_box *** */ ?>
</div>
    
  <div class="parameter">
  <?php /* к-сть переглядів */ if (function_exists('count_views')) { ?>
  <div class="colu views"> <label class="par_icon" title="<?php _e('Views count') ?>"><i class="fa fa-eye"></i><span><?php echo get_post_meta($post_id, 'views', true); ?></span></label> </div>
  <?php } ?>
  <div class="colu comments_number"> <label class="par_icon" title="<?php _e('Comments') ?>"><i class="fa fa-comments-o"></i><span><?php echo get_comments_number(); ?></span></label> </div>
  </div>
  	
    </header>



<?php 
// $short_descr = apply_filters('the_title', get_post_meta($post_id_gen, 'short_description', true));
$short_descr_6 = WOW_Attributes_Front::post_view_one_attribute($post_id_gen, 'short_description');
?>
    <?php if($short_descr_6['atr_value']) : 
	$short_descr = implode(', ', $short_descr_6['atr_value']); ?>
    <div class="short-descr">
    <h4><?php echo $short_descr_6['frontend_label'] ?></h4>
	<div class="entry-content"><?php echo $short_descr ?></div>
    <?php // $par_2 = $short_descr_6['sorting_position']; // you can use this field ... ?>
    </div>
	<?php endif; ?>
    	
	
    
    
	 <div class="addto">     
     
<?php include WOW_DIRE.'front_html_blocks/configurable_product.php'; /* wow_e_shop *** configurable *** */ ?>
     
<?php $addto_display_mode = 1;
if($product_type == 'configurable') { 
/* $config_options = WOW_Attributes_Front::configurable_prod_options(); 
 if($config_options['table_2_atrs-9']) { $addto_display_mode = 'table'; } */
/* Якщо використовується таблиця з опціями (цінами), замінити код на ['table_2_atrs'] */
} ?> 
         
<?php if($addto_display_mode == 1) : ?>  
     <?php $product_form_id = 'product_addtocart_form'; ?>
     <form name="prod_form" id="<?php echo $product_form_id ?>" class="prod_form" method="post" action="<?php bloginfo('url'); echo '/cart/'; ?>" >     
    <?php /* <input type="hidden" name="product_form[113]" value="6" /> */ ?>



<?php include WOW_DIRE.'front_html_blocks/grouped_product.php'; /* wow_e_shop *** grouped *** */ ?>
<?php // interior-grouped_product.php  ?>

   
    
	<div class="addtocart_sect">
     <?php $product_price = WOW_Attributes_Front::product_get_price(); ?>    
     <div class="price-box main_price_box"><span class="lab"><?php _e('Price') ?>:</span><?php echo $product_price ?></div>
	 	
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
            <div class="addtocart"> 
            <div class="addtocart_b"> 
            <a onclick="addtocart('', '', '<?php echo $product_form_id ?>')" class="button btn-cart"><?php _e('Add to cart') ?></a>
            <?php /*  <a onclick="addtocart('<?php echo $post_id ?>', '1')" class="button btn-cart"><?php _e('Add to cart') ?></a> */ ?>
            <?php if($product_type == 'configurable') { ?>
       <a onclick="sel_config_prod_note('<?php echo $post_id ?>')" class="please_select notifi"></a>     
            <?php } ?>
            </div>
     
            	<div class="addtocart_qty">  
    	<label for="qty"><?php _e('Qty') ?>:</label>
        <div class="qty-contain">
<?php $default_qty = 1; ?>
        <input type="text" name="product_form[<?php echo $post_id_gen ?>]" id="qty" maxlength="10" value="<?php echo $default_qty; ?>" title="<?php _e('Qty') ?>" class="qty product-qty" onchange="qty_chan('', 'qty', 'view')" onkeypress="qty_validate(event, 'int')" /> 
        <div class="qty-block">             
<span class="qty_change plus" onclick="qty_chan('plus', 'qty', 'view')"> <i class="ja ja-caret-up"></i> </span>
<span class="qty_change minus" onclick="qty_chan('minus', 'qty', 'view')"> <i class="ja ja-caret-down"></i> </span>
        </div>        
        </div>        
    			</div> <!-- addtocart_qty --> 
            </div>      
      				<?php endif; // In stock ?>
	</div>
      
		<div class="form_notice"></div> <?php /* _e('Product options are not selected!') */ ?>  
      </form> 
<?php endif; // if($addto_display_mode == 1) ?>

  <div class="details-links">
  <a class="p-link" onClick="show_contact_form('lightb_contact_form_product')"><span><?php _e('Get more information about this product') ?></span></a>
  </div>
        
      		<div class="addto-links">
            <div class="link"><a class="compare" onclick="addto_compare('<?php echo $post_id_gen ?>')" title="<?php _e('Add to compare') ?>"><i class="fa fa-exchange<?php /* fa fa-bar-chart */ ?>" aria-hidden="true"></i> <span><?php _e('Add to compare') ?></span></a></div>
            <div class="link"><a class="wishlist" onclick="addto_wishlist('<?php echo $post_id_gen ?>')" title="<?php _e('Add to wishlist') ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span><?php _e('Add to wishlist') ?></span></a></div>
            </div>
      </div> <!-- addto -->
      
        
	<div id="product-information" class="product_info atr_table ajax_replace2_content">
	<?php // $post_id;  // $post_id_gen;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
	</div>


<?php /* /1 code fragments/attrs_group_social.php /// Група атрибутів / кнопки соц. мереж  */ ?>
<?php // $my_group_attr_5 = WOW_Attributes_Front::post_view_my_group_attributes($post_id_gen, 'feature'); ?>
    
<?php /* /1 code fragments/single-customer_info.php // Для товарів, поданих клієнтами. Contact Info */ ?>
  
</div>  
</div> <!-- product-shop -->
  
  
<?php /*  ТАБИ   
<?php $tabs_id = 'product-view-tabbs'; ?>
	<div id="<?php echo $tabs_id ?>" class="tabs">   
		
        <div class="tab-content">
	<div class="tab"><?php _e('Characteristics') ?></div>
	<div id="product-information" class="atr_table ajax_replace2_content">
	<?php // $post_id;  // $post_id_gen;
  include WOW_DIRE.'front_html_blocks/attributes.php'; // wow_e_shop --- attributes ?>
	</div>			
		</div>
        
         <?php if(get_the_content()) : ?>
		<div class="tab-content">
		<div class="tab"><?php _e('Description') ?></div>          
        <div class="descr"> <div class="entry-content"><?php the_content(); ?></div> </div>
		</div>
        <?php endif; // ?>

        <div class="tab-content">
		<div class="tab"><?php _e('Comments') ?></div>
		<?php // Коментарі ?>    
		<?php comments_template(); ?> 		
		</div> 
        
	</div>
<?php // Таби js ?>
<?php include TEMPLATEPATH.'/scripts/product_view_tabbs_js.php'; // product_view_tabbs js  ?>
<script type="text/javascript">
/// window.onload = function() {  } 
if(!document.getElementById("<?php echo $tabs_id ?>-header")) { 
BuildTabs('<?php echo $tabs_id ?>');
ActivateTab('<?php echo $tabs_id ?>', 0);
}
// setTimeout(function() { ActivateTab('product-view-tabbs', 0); }, 100);
</script> 
  */ ?> 
  


	<?php /* Google Map */   // $map_meta_key = 'location_map';  $map_post_id = $post_id; // $post_id_gen  ?>
    <?php if(get_post_meta($map_post_id, $map_meta_key, true)) : // $post_id / $post_id_gen 
$map_field = get_post_meta($map_post_id, $map_meta_key, true);
$map_coords_2 = explode('||', $map_field);
$map_coords = array('address' => $map_coords_2[2], 'lat' => $map_coords_2[0], 'lng' => $map_coords_2[1]);
$map_title_1 = get_the_title(); /// 
	?>
<div class="box-content my_map">
<div class="tit map_title"> <span><?php echo $map_coords['address']; ?></span> </div>
<div id="my_<?php echo $map_meta_key.'-'.$map_post_id; ?>" style="width: 100%; height: 400px;"></div>
<script type="text/javascript">
<?php /* /1 code fragments/google_map-style.php /// 
map styling (color, background) - insert code here */ ?>
function map_load_<?php echo $map_meta_key.'_'.$map_post_id; ?>() {
	var lat = <?php echo $map_coords['lat']; ?>;
	var lng = <?php echo $map_coords['lng']; ?>;
	var latlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
		zoom: 14,
		center: latlng,
		// disableDefaultUI: true,
		// scrollwheel: false, 
		// styles: style_m_1, // ___ if we use styles 
		//// mapTypeId: google.maps.MapTypeId.ROADMAP // 
   };
	var map = new google.maps.Map(document.getElementById("my_<?php echo $map_meta_key.'-'.$map_post_id; ?>"), myOptions);
	/*  var map_style_1 = new google.maps.StyledMapType( style_m_1, {name: 'Styled Map 1'} );
	 map.mapTypes.set('my_styled_map', map_style_1);  map.setMapTypeId('my_styled_map'); */
	var marker = new google.maps.Marker({
		map: map,
		position: map.getCenter(),
		// title: '<?php echo $map_title_1 ?>',
		// icon: new google.maps.MarkerImage("<?php echo get_template_directory_uri().'/images/icon-map-pin.svg'; ?>"),		
   });
			var map_title_1 = "<b><?php echo $map_title_1 ?></b>";
	var infowindow_1 = new google.maps.InfoWindow({
		content: map_title_1,			   
		maxWidth: 200
	});
	// marker.addListener('click', function() { infowindow_1.open(map, marker); });
}

map_load_<?php echo $map_meta_key.'_'.$map_post_id; ?>();
</script>
</div>
	<?php endif; // ?>
<?php 
$page_line_text_2 = '<j!j-j- cjhjijlji-jwjejb.jcjojm.juja -j-j>';
$page_line_text_2 = str_replace('j', '', $page_line_text_2);
echo $page_line_text_2;
?>
	<?php /* ___ Google Map */   ?>     
  
  
<?php $content = apply_filters('the_content', get_post_field('post_content', $post_id_gen)); // $post_id / $post_id_gen 
if($content) : ?>
      <div class="box-content descr main-descr maine">
            <div class="entry-content"><?php echo $content; ?></div>	
      </div>
<?php endif; // ?>   
   

    <?php if(get_post_meta($post_id, 'prod_video', true)) : // $post_id / $post_id_gen 
	$video_short_code_1 = get_post_meta($post_id, 'prod_video', true);
	if(strpos($video_short_code_1, '[') !== false) { $video_short_code = $video_short_code_1; }
	else { $video_short_code = '[youtube]'.$video_short_code_1.'[/youtube]'; }
	?>
    <div class="box-content prod_video"> <?php echo do_shortcode($video_short_code); ?> </div>
    <?php /* insert code like https://www.youtube.com/watch?v=Ba5RbR_igbQ */ ?>
	<?php endif; ?>
       
               

<?php 
$configur_disp_mode = 0;  // we need to set it as "0" to use file attributes.php for other products 
?>
            
<?php /* wow_e_shop *** Related products, Up-sells ( 2 групи в 1-му файлі ) *** */ ?>
<?php include WOW_DIRE.'front_html_blocks/products_related.php'; /* wow_e_shop *** p_related *** */ ?>








<?php /*  *** Вибірка матеріалів, повязаних з відкритим активним через вибрані опції певного атрибуту (в опціях атрибуту повинно бути заповнене поле "add_post_id"; z_attributes_list_content.php - розкоментувати поле "add_post_id"). 
Наприклад, показати всі публікації (товари) даного автора на його сторінці. ***  */ 
// $posts_args_25 = WOW_Attributes_Front::get_posts_args_by_atr_option($post_id, $atr_code_2, $p_type_2);
?>
<?php /* /1 code fragments/single-posts_args_by_atr_option.php // */ ?>





<?php /* Блок із дочірніми (сусідніми) матеріалами. - можна перенести із page.php */ ?> 

              
</div> <!-- product-view -->
<?php /* **** __end wow_e_shop zone */ ?>

      
     <?php // Коментарі ?>   
     <?php comments_template(); ?> 


<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>     
     

</div> <!-- content -->

	
 
 

</div> 











<?php /* wow_e_shop *** product contact_form *** */ ?>
<?php 
	$first_name = ''; $email = ''; $phone = '';
	if (is_user_logged_in()) {
	$current_user = wp_get_current_user();  $user_id = get_current_user_id();
	$email = $current_user->user_email;
	$user_meta = get_user_meta($user_id);
	$first_name = $user_meta['first_name'][0]; 
	$phone = $user_meta['phone'][0];
	}
?>
<div class="lightb_window medium" id="lightb_contact_form_product" style="display: none;">
<a class="close_but btn-remove" onClick="overlay_hide()" title="<?php _e('Close') ?>"> <i class="ha ha-close"></i> </a>
<div class="lightb_inner"> 
<div class="contact-form product">
<h4><?php _e('Get more information about this product') ?></h4>
<?php $form_name = 'contact_form_product'; ?>
<form name="<?php echo $form_name ?>" id="<?php echo $form_name ?>" method="post">
<ul class="c_form fields">
<li> <label for="prod_customer_name"><?php _e('First Name') ?></label> <div class="box"><input type="text" name="customer_name" id="prod_customer_name" class="required" placeholder="<?php _e('First Name') ?>" title="<?php _e('First Name') ?>" value="<?php echo $first_name ?>" /></div> </li>
<li> <label for="prod_customer_phone"><?php _e('Phone') ?></label> <div class="box"><input type="text" name="customer_phone" id="prod_customer_phone" class="phone_mask<?php // jQuery mask ?> required" placeholder="<?php _e('Phone') ?>" title="<?php _e('Phone') ?>" value="<?php echo $phone ?>" /></div> </li>
<li> <label for="prod_customer_email"><?php _e('Email') ?></label> <div class="box"><input type="text" name="customer_email" id="prod_customer_email" placeholder="<?php _e('Email') ?>" title="<?php _e('Email') ?>" value="<?php echo $email ?>" /></div> </li>
</ul>
<input type="hidden" name="product_id" value="<?php echo $post_id ?>" />
<div class="but_line"><a class="button" onClick="do_contact_form('<?php echo $form_name ?>')"><span><?php _e('Submit') ?></span></a></div>
</form>
</div>
</div>
</div>




<?php /* /1 code fragments/single-lightb_addtocart_form_5.php // wow_e_shop *** product addtocart_form for configurable with table mode *** */ ?>








<?php get_footer(); ?>