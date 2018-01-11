<?php
/*
Template Name: WOW wishlist
*/
?>
<?php if (!is_user_logged_in()) { wp_safe_redirect( get_bloginfo('url') ); } ?>
 
<?php WOW_Wishlist::wishlist_add_product(); ?>
<?php WOW_Wishlist::wishlist_remove(); ?>


<?php get_header(); ?>

        
<div class="page wishlist no_column blog">

<?php $po_arr = array_keys($_POST); 
	if (!in_array('wish_prod_id', $po_arr)) : ?>
<?php include WOW_DIRE.'front_html_blocks/profile_menu.php'; /* wow_e_shop *** profile_menu *** */ ?>
<?php endif; ?>
  
    
	 <div id="wishlist_page" class="content ajax_replace2_content">  
<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'medium-img' ); 
}
?>     
     <?php if (in_array('wish_prod_id', $po_arr)) : 
	 $prod_last_id = $_POST['wish_prod_id'];
	 ?>
   	<div class="product_added">
    <div class="f_left">
    	<div class="prod-image">
<a class="product-image" title="<?php echo get_the_title($prod_last_id); ?>"><?php if ( has_post_thumbnail($prod_last_id) ) { echo get_the_post_thumbnail( $prod_last_id, 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a>
		</div>      	
    </div>
    <div class="f_right">
    <h3 class="product-name"><?php echo get_the_title($prod_last_id); ?></h3>
    <div class="added"><?php _e('The product has been added to wishlist.') ?></div>
    <div class="button_line">
    <a href="<?php bloginfo('url'); echo '/profile/wishlist/'; ?>" class="button wide"><?php _e('Go to wishlist') ?></a>
    <a onclick="overlay_hide()" class="button wide"><?php _e('Continue shopping') ?></a>
    </div>
    </div>
    </div>
    
    <?php else : ?>
	 


	 
	 <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
   
 
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
   
    <div class="page_title title_content"> <h1><?php the_title(); ?></h1> </div>
    <div class="entry-content"> <?php the_content(); ?> </div> 
    
   <?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	  
  
    
    
    <div class="wishlist_products">    
	
	<?php $wishlist_id = WOW_Wishlist::select_wishlist_id();
	$wishlist_array = WOW_Wishlist::cur_wishlist_array($wishlist_id);
	?>
    
       
	<?php if(count($wishlist_array)) : ?>
    
<div class="grid_cont maine">      

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // pagination
$posts_args_2 = array (       
        'post_type'  => 'any',
		'post__in' => $wishlist_array,
		// 'showposts'	=> 12,
		'posts_per_page'    => 12,
		'paged' => $paged, // pagination
		'order' => 'ASC',	
		'orderby' => 'post__in', // 'title', 'post__in' 
		'post_status' => 'publish'
    );

$wish_query = new WP_Query($posts_args_2);

    if( $wish_query->have_posts() ) { ?>

<ul class="products-grid cols_4">
<?php while ($wish_query->have_posts()) : 
	$wish_query->the_post(); 
		global $more;  $more = 0;  // необхідно для тегу <!--more-->
?> 
 <li class="item"> <?php // content ?>
 <?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?>  
 <div class="inn_cont">
<a onclick="remove_wishlist('<?php echo $post->ID ?>')" class="btn-remove btn-delete" title="<?php _e('Remove') ?>"> <i class="ha ha-close"></i> </a>
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php // the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a>
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <div class="price-box"><?php echo $product_price ?></div>    
		<?php $stock_2 = get_post_meta ($post->ID, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
     	<?php $product_type = get_post_meta ($post->ID, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php echo $post->ID ?>', '1')"<?php } ?> class="button btn-cart" ><?php _e('Add to cart') ?></a> </div>
                    <?php else: ?>
             <div class="availability out-of-stock"><span><?php _e('Out of stock') ?></span></div>
                    <?php endif; ?>
         </div>
            <div class="addto-links">
            <div class="link"><a class="compare" onclick="addto_compare('<?php echo $post->ID ?>')" title="<?php _e('Add to compare') ?>"><span><?php _e('Add to compare') ?></span></a></div>       
            </div>
	</div> <!-- addto -->
    
	<div class="product_info atr_table">
	<?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
	</div>  
 
 </div>
 </li>
 
<?php endwhile; ?>
</ul>
<?php }  wp_reset_query(); 
?>
</div> <!-- grid_cont -->

    <?php if (function_exists('wp_corenavi')) wp_corenavi($wish_query); ?>


   
    
    
	<?php else : ?>
    <p class="no_items"><?php _e('You have no items in wishlist.') ?></p>
    <?php endif; // (!count($wishlist_array)) ?>
        
    
    </div> 
    
    <?php endif; // (!$_POST['wish_prod_id']) ?>   
	
    

    
               
    </div> <!-- contenta -->  






	<div style="display: none;">
	<?php include WOW_DIRE.'front_html_blocks/sidebar_wishlist.php'; /* * sidebar_wishlist * */ ?>
    </div>





     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>