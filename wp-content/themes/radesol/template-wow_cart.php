<?php
/*
Template Name: WOW cart
*/
?>

<?php WOW_Cart_Session::cart_add_product(); ?>
<?php WOW_Cart_Session::cart_update(); ?>	


<?php get_header(); ?>

        
<div class="page cart no_column blog">

  
    
	 <div id="cart_page" class="content ajax_replace2_content">	
     
     <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
   

   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    
    <div class="page_title title_content tit_buttons">
    <a onclick="overlay_hide()" class="button wide"><?php _e('Continue shopping') ?></a>
    <h1><?php the_title(); ?></h1>      
    </div>
    
    <div class="entry-content"> <?php the_content(); ?> </div>
    
   <?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	
       
    
    <div class="cart_content">	
    
    <?php 
	$cart_error = array('subtotal' => 0); // array();
	$cart_array = WOW_Cart_Session::cart_array();
	$products_parts = WOW_Cart_Session::cart_parts_array(); ///
	$subtotal_base = WOW_Cart_Session::cart_subtotal_base();

	$options_5 = get_option('wow_settings_arr');
	$act_currency_arr = WOW_Product_List_Func::get_act_currency();
	$act_currency = $act_currency_arr['code'];
	$symb = $act_currency_arr['symbol'];
	$kurs = $act_currency_arr['rate']; 
	$round_to = 0; if($options_5['wow_currency_precision']) { $round_to = $options_5['wow_currency_precision']; }
	
	$cart_subtotal = round($subtotal_base * $kurs, $round_to) . '<span>'.$symb.'</span>';

	$min_subtotal_base = $options_5['wow_min_cart_subtotal'];
	$min_subtotal = round($min_subtotal_base * $kurs, 0) . '<span>'.$symb.'</span>';
	if($min_subtotal_base and $subtotal_base < $min_subtotal_base) { $cart_error['subtotal'] = 1; } 
	?>
    <?php if(count($cart_array)) : ?>
    
      
    
<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'thumbnail' ); 
}
?>    
    <form name="form_cart" id="form_update_cart" method="post" >
    <div class="tab_head">
    <div class="colu prod_img"></div> <div class="colu prod_name"><?php _e('Products') ?></div> <div class="colu prod_price"><?php _e('Price') ?></div> <div class="colu prod_qty"><?php _e('Qty') ?></div> <div class="colu prod_price tot"><?php _e('Subtotal') ?></div>
    </div>
	
    <ul class="prod-list">
	<?php foreach ($cart_array as $prod_id => $p_qty) : //////////// foreach ///////////// ?>
	<li>
	<div class="colu prod_img"> <a href="<?php echo get_permalink($prod_id); ?>" title="<?php // echo get_the_title($prod_id); ?>">
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
		<?php $stock_2 = get_post_meta ($prod_id, 'stock', true); ?>
		<?php if($stock_2 != '' and $stock_2 < $p_qty) { $cart_error['qty'] = 1; ?>
    <div class="message p_qty_alert error"> <?php _e('The selected quantity of products is not available.') ?><div><?php _e('Quantity Available:'); echo '<span> '.$stock_2.'</span>'; ?></div> </div>
    	<?php } ?>
    </div>  
    
	<?php $row_price_arr = WOW_Cart_Session::cart_get_row_price($prod_id, $p_qty, $prod_parts_arr); ?>
    <div class="colu prod_price"><span class="price"><?php echo $row_price_arr['item_price'] ?></span></div>
    
    <div class="colu prod_qty">
    <div class="qty_change_co">
	<?php $qty_id = 'qty_change_'.$prod_id; ?>
     <span class="qty_change minus" onclick="qty_chan('minus', '<?php echo $qty_id ?>', 'cart')"> <i class="fa fa-minus<?php /* fa fa-minus-square-o */ ?>"></i> </span>
        <input type="text" name="cart_qty[<?php echo $prod_id ?>]" id="<?php echo $qty_id ?>" value="<?php echo $p_qty ?>" size="4" title="<?php _e('Qty') ?>" class="input-text qty" maxlength="5" onchange="qty_chan('', '<?php echo $qty_id ?>', 'cart')" onkeypress="qty_validate(event, 'int')" />
      <span class="qty_change plus" onclick="qty_chan('plus', '<?php echo $qty_id ?>', 'cart')"> <i class="fa fa-plus"></i> </span>
      </div>
    </div>
    
   <div class="colu prod_price tot"><span class="price"><?php echo $row_price_arr['row_total'] ?></span></div>
    
    <div class="colu rem"> <a onclick="cart_item_delete('<?php echo $qty_id ?>')" class="btn-remove btn-delete" title="<?php _e('Delete') ?>"> <i class="ha ha-close"></i> </a> </div>
    </li>
	<?php endforeach;  //////////// foreach ///////////// ?>
    </ul>
    
    <div class="cart_totals">
<?php if($cart_error['subtotal']) { ?> <div class="message subtotal_alert error"><?php echo __('Minimum order:').'<span class="price"> '.$min_subtotal.'</span>'; ?></div> <?php } else { unset($cart_error['subtotal']); } ?>
    <?php $cart_subtotal = WOW_Cart_Session::cart_get_subtotal(); ?>
    <div class="totals"><span class="price"><?php echo $cart_subtotal ?></span></div>
    <div class="totals_btn">
    <div id="button_update_cart" class="but" style=" display: none;"><a onclick="update_cart()" class="button btn-checkout"><?php _e('Update cart') ?></a></div> 
    <?php /* <div id="button_show_checkout" class="but"><a<?php if(!$cart_error) { ?> onclick="show_checkout_page()"<?php } ?> class="button btn-checkout<?php if($cart_error) { ?> non_act<?php } ?>"><?php _e('Checkout') ?></a></div>  */ ?>  
    <div id="button_show_checkout" class="but"><a<?php if(!$cart_error) { ?> href="<?php bloginfo('url'); echo '/checkout/'; ?>"<?php } ?> class="button btn-checkout<?php if($cart_error) { ?> non_act<?php } ?>"><?php _e('Checkout') ?></a></div>    
    </div>
    </div> <!-- cart_totals -->
    </form>
    
	<?php else : ?>
    <p class="no_items"><?php _e('You have no items in your shopping cart.') ?></p>
    <?php endif; ?>
    
    </div>    
	
	           
    </div>      
	


<div style="display: none;">
<?php include WOW_DIRE.'front_html_blocks/sidebar_cart.php'; /* wow_e_shop *** sidebar_cart *** */ ?>
</div>
     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>