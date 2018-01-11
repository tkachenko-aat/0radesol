<?php
/*
Template Name: WOW advanced
*/
?>
<?php get_header(); ?>

        
<div class="page advanced no_column blog">

  
    
	 <div id="advanced_page" class="content">  
 
	 
	 <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
 
 
<?php 
/* *** Розширений пошук та перегляд всіх товарів типу 'popular_prod', 'recomend_prod' .... *** */

 $prod_type = 'advanced';
 if($_REQUEST['par']) { $prod_type = $_REQUEST['par']; }
 
$products_type_arr = WOW_Product_List_Func::get_front_products_type_arr();
// $type_arr_2 = array('popular_prod', 'recomend_prod');
 

$prod_args = WOW_Product_List_Func::get_front_products_args($prod_type, '');
$prod_args['query_name'] = 'advanced'; /* !!!! */

$prod_label = get_the_title();
if($_REQUEST['par']) { 
$prod_label = $products_type_arr[$prod_type]['label'];
$attr_labels = WOW_Attributes_Front::get_attribute_labels($prod_type);
if($attr_labels['frontend_label_2']) { $prod_label = $attr_labels['frontend_label_2']; } // 
}
// echo '<pre>'; print_r($prod_args); echo '</pre>';

?>
 

   <?php // page main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>   
 
    <div class="page_title title_content">  <h1><?php echo $prod_label; ?></h1>  </div>
    <?php /* <div class="page_title">  <h1><?php the_title(); ?></h1>  </div> */ ?>
    
    <div class="entry-content"> <?php the_content(); ?> </div>   
    
	<?php // -//- end page main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>    


<?php if(!$_REQUEST['par']) : ?>
<div class="advanced_filter">
<?php include WOW_DIRE.'front_html_blocks/sidebar_filter.php'; /* wow_e_shop *** sidebar_filter *** */ ?>
</div>
<?php endif;  ?>



<?php if($_GET) : // показати товари //////////////// //// ?>

<div id="advanced_search_rez">

<?php $prod_query = new WP_Query($prod_args); ?>

<?php // echo '<pre>'; print_r($prod_query->query_vars); echo '</pre>'; ?> 

<?php // main content ?> <?php if( $prod_query->have_posts() ) : ?>

<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; $no_feat_image_2 = $no_feat_image; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'medium-img' );  $no_feat_image_2 = $no_feat_image;
}
?>

<?php include WOW_DIRE.'front_html_blocks/toolbar_sorter.php'; /* wow_e_shop *** toolbar_sorter *** */ ?>

<div class="grid_cont maine adv_products <?php echo $prod_type ?>">

<?php 
/// $view_mode = 'grid'; 
$view_mode = WOW_Product_List_Func::get_view_mode();
?>

<?php if($view_mode == 'grid') : /* ********  grid  ******** */ ?>

<ul class="cols_4 products-grid">    
  <?php while($prod_query->have_posts()) : $prod_query->the_post(); 
      global $more;  $more = 0;  // необхідно для тегу <!--more-->
  ?>  

 <?php $post_id = $post->ID; ?> 
<li class="item shad_item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>>
 <?php // $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?>  
 <div class="inn_cont">
 <a class="product-image" href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a>
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 
 <?php // $count = get_post_meta($post->ID, 'prod_sales', true); echo $count; ?>	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <div class="price-box"><?php echo $product_price ?></div>    
		<?php $stock_2 = get_post_meta($post->ID, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
     	<?php $product_type = get_post_meta ($post->ID, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php the_ID() ?>', '1')"<?php } ?> class="button btn-cart"><?php _e('Add to cart') ?></a> </div>
                    <?php else: ?>
             <div class="availability out-of-stock"><span><?php _e('Out of stock') ?></span></div>
                    <?php endif; ?>
        </div>
            <div class="addto-links">
            <div class="link"><a class="compare" onclick="addto_compare('<?php the_ID() ?>')" title="<?php _e('Add to compare') ?>"><span><?php _e('Add to compare') ?></span></a></div>
            <div class="link"><a class="wishlist" onclick="addto_wishlist('<?php the_ID() ?>')" title="<?php _e('Add to wishlist') ?>"><span><?php _e('Add to wishlist') ?></span></a></div>
            </div>
	</div> <!-- addto -->
    
	<div class="product_info atr_table">
	<?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
	</div> 
 
 </div>
</li>
 
 <?php endwhile; // posts query ?>
</ul> 
 
 
 
 <?php else: // /* ********  view_mode == 'list'  ******** */ ?>

 <ul class="products-list">
  <?php while($prod_query->have_posts()) : $prod_query->the_post(); 
   global $more;  $more = 0;  // необхідно для тегу <!--more-->
  ?>  

 <?php $post_id = $post->ID; ?> 
<li class="item shad_item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>>
 <?php // $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?> 
 <div class="inn_cont"> 
 <div class="prod-image">
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image_2.'</div>'; } ?></a>
 </div>
 
 <div class="prod-center">
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 <div class="entry-content"><?php the_content(); ?></div>
	<div class="product_info atr_table">
	<?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
	</div>    
 <?php // $count = get_post_meta($post->ID, 'views', true); echo $count; ?>
 </div>
	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <div class="price-box"><?php echo $product_price ?></div>    
		<?php $stock_2 = get_post_meta($post->ID, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
     	<?php $product_type = get_post_meta($post->ID, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php the_ID() ?>', '1')"<?php } ?> class="button btn-cart"><?php _e('Add to cart') ?></a> </div>
                    <?php else: ?>
             <div class="availability out-of-stock"><span><?php _e('Out of stock') ?></span></div>
                    <?php endif; ?>
        </div>
            <div class="addto-links">
            <div class="link"><a class="compare" onclick="addto_compare('<?php the_ID() ?>')" title="<?php _e('Add to compare') ?>"><span><?php _e('Add to compare') ?></span></a></div>
            <div class="link"><a class="wishlist" onclick="addto_wishlist('<?php the_ID() ?>')" title="<?php _e('Add to wishlist') ?>"><span><?php _e('Add to wishlist') ?></span></a></div>
            </div>
	</div> <!-- addto -->
     
 </div>
 </li>
 
 <?php endwhile; // posts query ?> 
 
 </ul> <!-- products-list -->
 
 <?php endif; // $view_mode ?>
 
 

</div> <!-- grid_cont -->


<?php else : // no posts ?> 

 <article class="no-posts"> <p> <?php _e( 'There are no products matching the selection.' ); ?> </p> </article>
 
  <?php endif;  wp_reset_query(); ?>	<?php // -//- end main content ?>    
   		
	
	<?php if (function_exists('wp_corenavi')) wp_corenavi($prod_query); ?>

</div>
<?php endif; // if($_GET) //////////////// //// ?>


      
               
    </div> <!-- content -->  

	
     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>