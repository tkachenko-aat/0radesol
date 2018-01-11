
<?php /* **** Блок "Категорії з товарами" вивести за допомогою звичайного меню на позиції 'm_home_prod_categories' **** */ ?>
<?php $menu_home_name = 'm_home_prod_categories';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_home_name] ) ) : 
	$menu_5 = wp_get_nav_menu_object( $locations[$menu_home_name] );
	$menu_items = wp_get_nav_menu_items($menu_5->term_id);
	// echo '<pre>'; print_r($menu_items); echo '</pre>'; 
$line_5_count = 4;
$num_5 = 0;
?>
<div class="home_prod_categories">
<?php foreach ($menu_items as $item) : ?>
<?php $num_5++; ?>  

<?php 
$section_link = ''; /// 
if($item->type == 'taxonomy') { 
$term_5 = get_term_by('id', $item->object_id, $item->object); 
$term_id = $term_5->term_id;
$taxonomy = $term_5->taxonomy;
$class_2 = 'section-cat';  $section_id = 'home_prod-section-cat-'.$term_5->slug;
// $child_terms_2 = get_terms( $term_5->taxonomy, array('parent' => $term_5->term_id, 'hide_empty' => false) );
$cat_content = get_term_meta( $term_id, 'cat_content', true );  
$sect_content = apply_filters('the_content', $cat_content);
} elseif($item->type == 'post_type') { 
$post2 = get_post($item->object_id);
$section_link = $post2->post_name; /// 
$class_2 = 'section-page';  $section_id = 'home_prod-section-page-'.$post2->post_name;
$sect_content = apply_filters('the_content', $post2->post_content);
} 
?>
    <?php // echo $item->ID // post id = $item->object_id ?>
<div class="box-content section <?php echo $class_2 ?>" id="<?php echo $section_id ?>" style=" z-index: <?php echo (100 - $num_5); ?>;">
<div class="inn"> 
    
	<div class="sect_header"> 
    <?php $item_main_img = '';
	if($item->type == 'taxonomy') {  if($term_5->term_thumbnail) { 
	 $item_main_img = wp_get_attachment_image( $term_5->term_thumbnail, 'medium-img' ); 
	 } } elseif($item->type == 'post_type') { if ( has_post_thumbnail($item->object_id) ) { $item_main_img = get_the_post_thumbnail( $item->object_id, 'medium-img' ); } } ?> 
    <?php if($item_main_img) { ?><div class="sect_image"><?php echo $item_main_img; ?></div><?php } ?>
    <div class="tit"><h2><a href="<?php echo $item->url ?>" title=""><?php echo $item->title ?></a></h2></div>
	<?php if($sect_content) { ?> 
<div class="sect_content maine"><?php echo $sect_content; ?></div>
	<?php } ?>
    </div>

<?php if($section_link == 'new-products') : //// //// //// ?>
<?php include WOW_DIRE.'front_html_blocks/front_products_sliders.php'; ?> 
<?php endif; //// //// //// ?> 

<?php if($item->type == 'taxonomy') : //// //// //// ?>
<?php 
$posts_args_2 = array (       
        'post_type'  => 'any',
		'posts_per_page'    => -1,
		'order' => 'ASC',	
		'orderby' => 'menu_order',		
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			'terms' => $term_id // 'my-slug2'
			)
		), 
		'post_status' => 'publish'
    );

$query_2 = new WP_Query($posts_args_2);
    if( $query_2->have_posts() ) : ?>
	<div class="cat <?php echo $term_5->slug ?>">
<?php // $count_1 = WOW_categories_Func::get_term_post_count4($term_5); // $count_1 = $term_5->count; ?>
	<?php /* 
	<div class="cat_tit"><h2><a href="<?php echo $item->url ?>"><?php echo $item->title ?></a></h2></div>
	 */ ?>
<div class="grid_cont maine">
<ul class="products-grid cols_5">
<?php	
	while ($query_2->have_posts()) : 
	$query_2->the_post(); 
		global $more;  $more = 0;  // необхідно для тегу <!--more-->
?> 
<li class="item"> <?php // content ?>
 <?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?> 
 <div class="inn_cont">
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn"> <img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" /> </div>'; } ?></a> 

 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <div class="price-box"><?php echo $product_price ?></div>    
		<?php $stock_2 = get_post_meta ($post->ID, 'stock', true); ?>
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
    
    <?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
 
 </div>
</li> 
<?php endwhile; ?>
</ul>
</div>

	</div>
<?php endif;  wp_reset_query(); ?>

<?php endif; //// //// //// ___ ($item->type == 'taxonomy') ?> 
</div>
</div>
<?php endforeach; ?>
</div>	   
<?php endif; // isset( $locations[ $menu_home_name ] ) ?>

