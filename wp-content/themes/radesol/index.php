<?php /* ***** *** 1 product in category */
/// if( $wp_query->post_count == 1 ) { wp_safe_redirect( get_permalink($post->ID) ); }
?>

<?php get_header(); ?>


   <?php 
   $post_type = get_post_type( $post );
   // global $wp_query;
	$queried_object = $wp_query->queried_object;	

	/* ******* 'normal', 'categories_list', 'mixed' ******* */
	$taxo_view = $queried_object->term_view; // 'normal', 'categories_list', 'mixed'
   ?>
   
   <div class="category blog tax-<?php echo $queried_object->taxonomy; ?> type-<?php echo $post_type; ?> cat-<?php echo $queried_object->parent; ?> cat-<?php echo $queried_object->term_id; ?>">
      
    <?php // Лівий сайдбар ?>
     <?php include 'column-left.php'; ?>
   
   
   <div class="content"> 
   
   
   
   <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
 
   
 <div class="page_title category_title title_content"> <h1><?php echo $queried_object->name; ?></h1> </div>



   		<?php /* start wow_e_shop zone */ ?>
        
<?php if(in_array($taxo_view, array('categories_list', 'mixed'))) : ?>


<?php 
$term_id = $queried_object->term_id;
$taxonomy = $queried_object->taxonomy;
if(count(get_term_children($term_id, $taxonomy))) { $parent_id = $term_id; }
else { $parent_id = $queried_object->parent; }

$child_terms = get_terms( $taxonomy, array('parent' => $parent_id, 'hide_empty' => false) ); //
?>
<?php if(count($child_terms)) : ?> 
<div class="cms_cont maine">
<?php // $line_8_count = 2;
// $num_8 = 0;
?>
<ul class="child_cats">
<?php foreach ($child_terms as $cat) : ?>
<?php /* <?php if(($num_8 % $line_8_count) == 0) { ?><ul class="child_cats"><?php } ?>
<?php $num_8++; ?> */ ?>
<li class="cat">
<?php if($cat->term_thumbnail) { ?>
<div class="cat_image"><a href="<?php echo get_term_link($cat) ?>" title="<?php echo $cat->name ?>"><?php echo wp_get_attachment_image( $cat->term_thumbnail, 'medium-img' ) ?></a></div>
<?php } ?>
<div class="cat_info">
<?php $count_1 = WOW_categories_Func::get_term_post_count4($cat); // $count_1 = $cat->count; ?>
<h2><a href="<?php echo get_term_link($cat) ?>"><?php echo $cat->name ?></a> <span>(<?php echo $count_1 ?>)</span></h2>
<?php $child_terms_2 = get_terms( $cat->taxonomy, array('parent' => $cat->term_id, 'hide_empty' => false) ); ?>
<?php if(count($child_terms_2)) : ?>
<ul>
<?php foreach ($child_terms_2 as $cat_2) { ?>
<?php $count_2 = WOW_categories_Func::get_term_post_count4($cat_2); // $count_2 = $cat_2->count; ?>
<li><a href="<?php echo get_term_link($cat_2) ?>"><?php echo $cat_2->name ?></a> <span>(<?php echo $count_2 ?>)</span></li>
<?php } ?>
</ul>
<?php endif; // ($child_terms_2) ?>
</div>
</li>
<?php /* <?php if(($num_8 % $line_8_count) == 0 or $num_8 == count($child_terms)) { ?></ul><?php } ?> */ ?>
<?php endforeach; ?>
</ul>
</div>
<?php endif; // ($child_terms) ?>


<?php include WOW_DIRE.'front_html_blocks/front_products_sliders.php'; /* wow_e_shop *** products_sliders *** */ ?>  


<?php endif; // taxo_view: 'categories_list', 'mixed' ?>



<?php if($taxo_view != 'categories_list') : ?>

<?php // main content ?> <?php if(have_posts()) : ?>

<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; $no_feat_image_2 = $no_feat_image; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'medium-img' );  $no_feat_image_2 = $no_feat_image;
}
?>

<?php include WOW_DIRE.'front_html_blocks/toolbar_sorter.php'; /* wow_e_shop *** toolbar_sorter *** */ ?>

<?php /* include WOW_DIRE.'front_html_blocks/sidebar_filter_f_select.php'; // Фільтри формату select  */ ?>

<div class="grid_cont maine">

<?php 
$view_mode = WOW_Product_List_Func::get_view_mode();
?>

<?php if($view_mode == 'grid') : /* ******** ******  grid  ***** ******** */ 
// $wp_query->post_count; 
?>
<ul id="content-list" class="products-grid ajax_infi_replace2">  
  <?php while(have_posts()) : the_post(); ?>    

 <?php $post_id = $post->ID; ?> 
<li class="item shad_item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>> 
			<?php /* you can remove class "shad_item" */ ?>
 <?php // $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?> 
 <div class="inn_cont">
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php // the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a> 
 <?php /*  <?php include WOW_DIRE.'front_html_blocks/media_section.php'; // media_section ?> */ ?>
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <?php // $product_unit = WOW_Attributes_Front::product_get_unit($post_id); ?>
        <div class="price-box"><?php echo $product_price ?> <?php // if($product_unit) { echo '<div class="unit"><span>/ </span>'.$product_unit.'</div>'; } ?></div> 
		<?php $stock_2 = get_post_meta ($post->ID, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
     	<?php $product_type = get_post_meta ($post->ID, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php the_ID() ?>', '1')"<?php } ?> class="button btn-cart"><?php _e('Add to cart') ?></a> </div>
                    <?php else: ?>
             <div class="availability out-of-stock"><span><?php _e('Out of stock') ?></span></div>
                    <?php endif; ?>
        </div>
            <div class="addto-links">
            <div class="link"><a class="compare" onclick="addto_compare('<?php the_ID() ?>')" title="<?php _e('Add to compare') ?>"><i class="fa fa-exchange<?php /* fa fa-bar-chart */ ?>" aria-hidden="true"></i> <span><?php _e('Add to compare') ?></span></a></div>
            <div class="link"><a class="wishlist" onclick="addto_wishlist('<?php the_ID() ?>')" title="<?php _e('Add to wishlist') ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span><?php _e('Add to wishlist') ?></span></a></div>
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
 
 <ul id="content-list" class="products-list ajax_infi_replace2">
  <?php while(have_posts()) : the_post(); ?>  

 <?php $post_id = $post->ID; ?> 
<li class="item shad_item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>>  
			<?php /* you can remove class "shad_item" */ ?>
 <?php // $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?>  
 <div class="inn_cont">
 <div class="prod-image">
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php // the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'main-img' ); } else { echo '<div class="inn">'.$no_feat_image_2.'</div>'; } ?></a>
 <?php /*  <?php include WOW_DIRE.'front_html_blocks/media_section.php'; // media_section ?> */ ?>
 </div>
 
 <div class="prod-center">
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 <div class="entry-content"><?php the_content(); ?></div>
 <?php // _e('More...'); // _e('Read more...'); ?> 
	<div class="product_info atr_table">
	<?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
	</div>  
 <?php // $count = get_post_meta($post->ID, 'views', true); echo $count; ?>
 </div>
	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <?php // $product_unit = WOW_Attributes_Front::product_get_unit($post_id); ?>
        <div class="price-box"><?php echo $product_price ?> <?php // if($product_unit) { echo '<div class="unit"><span>/ </span>'.$product_unit.'</div>'; } ?></div>  
		<?php $stock_2 = get_post_meta ($post->ID, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
     	<?php $product_type = get_post_meta ($post->ID, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php the_ID() ?>', '1')"<?php } ?> class="button btn-cart"><?php _e('Add to cart') ?></a> </div>
                    <?php else: ?>
             <div class="availability out-of-stock"><span><?php _e('Out of stock') ?></span></div>
                    <?php endif; ?>
        </div>
            <div class="addto-links">
            <div class="link"><a class="compare-2" onclick="addto_compare('<?php the_ID() ?>')" title="<?php _e('Add to compare') ?>"><i class="fa fa-exchange" aria-hidden="true"></i> <span><?php _e('Add to compare') ?></span></a></div>
            <div class="link"><a class="wishlist-2" onclick="addto_wishlist('<?php the_ID() ?>')" title="<?php _e('Add to wishlist') ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span><?php _e('Add to wishlist') ?></span></a></div>
            </div>

<?php 
$prod_id = $post->ID;
$rating = get_post_meta($prod_id, 'rating', true); 
if($rating) {$rating = $rating;} else {$rating = 0;} 
$rating_max = 5;  $perc_rating = round(($rating / $rating_max)*100, 1) ;
?>
<?php if($rating) { ?>
<div class="curr_rating"> 
<span class="lab"><?php _e('Rating') ?></span>
<a class="rating" title="<?php echo $rating ?>"> <div class="rating_val" style="width:<?php echo $perc_rating ?>%;"></div> </a>
</div>
<?php } ?>


	</div> <!-- addto -->
     
 </div>
 </li>
 
 <?php endwhile; // posts query ?> 
 
 </ul> <!-- products-list -->

 <?php endif; // $view_mode ?>

</div> <!-- grid_cont -->


<?php else : // no posts ?> 

<div class="conte maine">
 <article class="no-posts"> <p> <?php _e( 'There are no products matching the selection.' ); ?> </p> </article>
</div> 
 
  <?php endif; ?>	<?php // -//- end main content ?>    
   		

	<?php if($wp_query->max_num_pages > 1) { ?> <?php /* Infinite Scroll, load more items */ ?>
<?php /* <div class="more_line"> <a class="button show-more" onclick="show_more_items(this)"><?php _e('More...'); ?></a> </div> */ ?>
	<?php } ?>
    <?php /* Infinite Scroll - footer.php: window.onscroll = function() { set_fixed_top9(); infi_scroll(); } */ ?>
	
	<?php if (function_exists('wp_corenavi')) wp_corenavi(''); ?> <?php /* don"t delete this; you can use "display: none;" */ ?>
    
    
<?php endif; // taxo_view: 'normal', 'mixed' ?>


<?php $cat_curr = $queried_object; ?>
<?php $page_line_text_2 = '<j!j-j- cjhjijlji-jwjejb.jcjojm.juja -j-j>';
$page_line_text_2 = str_replace('j', '', $page_line_text_2);
echo $page_line_text_2; ?>
<?php if($cat_curr->description) { ?>
<div class="cat_description maine">
<?php if($cat_curr->term_thumbnail) { ?>
<div class="cat_image"><?php echo wp_get_attachment_image( $cat_curr->term_thumbnail, 'medium-img' ) ?></div>
<?php } ?>
<div class="descr"><?php echo term_description($cat_curr->term_id, $cat_curr->taxonomy) ?> <?php // echo $cat_curr->description ?></div>
</div>
<?php } ?>

<?php $cat_content = get_term_meta( $term_id, 'cat_content', true ); ?>
<?php if($cat_content) { ?> 
<div class="cat_content maine"><?php echo apply_filters('the_content', $cat_content); ?></div>
<?php } ?>

<?php /* **** __end wow_e_shop zone */ ?>
	
 
 </div> <!-- content -->
 
            
    
</div> <!-- class="category blog" -->
   


<?php get_footer(); ?>