<?php get_header(); ?>


   <?php 
   $post_type = get_post_type( $post );
   // global $wp_query;
	$queried_object = $wp_query->queried_object;

	/* ******* 'normal', 'categories_list', 'mixed' ******* */
	$taxo_view = $queried_object->term_view; // 'normal', 'categories_list', 'mixed'
   ?>
   
   <div class="category no_column blog tax-<?php echo $queried_object->taxonomy; ?> type-<?php echo $post_type; ?> cat-<?php echo $queried_object->parent; ?> cat-<?php echo $queried_object->term_id; ?>">
 
   
   <div class="content"> 

<div class="box-content maine actions">
<div id="last_actions"> <?php dynamic_sidebar( 'last_actions' ); ?> </div>
</div>
   
   <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>


   <?php 
	$taxonomy = $queried_object->taxonomy;	///// 
	$term_id = $queried_object->term_id;
   ?>
<?php include 'easy-breadcrumbs.php'; ?>

   
 <div class="page_title category_title title_content"> <h1><?php echo $queried_object->name; ?></h1> </div>



   		<?php /* start wow_e_shop zone */ ?>

<?php 
$term_id = $queried_object->term_id;
$taxonomy = $queried_object->taxonomy;
if(count(get_term_children($term_id, $taxonomy))) { $parent_id = $term_id; }
else { $parent_id = $queried_object->parent; }

$child_terms = get_terms( $taxonomy, array('parent' => $parent_id, 'hide_empty' => false) ); //
?>

        
<?php if(in_array($taxo_view, array('categories_list'))) : ?>


<?php // ........... ?>







<?php elseif($taxo_view == 'mixed') : ///// ///////////////////// ///////// ?>

<?php if(count($child_terms)) : ?> 
<div class="mixed_categories">

<?php foreach ($child_terms as $cat) : ?>
<?php 
// $taxonomy = $queried_object->taxonomy;
$posts_args_2 = array (       
        'post_type'  => 'any',
		'posts_per_page'    => -1,
		'order' => 'ASC',	
		'orderby' => 'menu_order',		
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			'terms' => $cat->term_id // 'my-slug2'
			)
		), 
		'post_status' => 'publish'
    );

$query_2 = new WP_Query($posts_args_2);

    if( $query_2->have_posts() ) : ?>
<div class="box-content cat <?php echo $cat->slug ?>">
<?php $count_1 = WOW_categories_Func::get_term_post_count4($cat); // $count_1 = $cat->count; ?>
<div class="tit"> <h2><?php echo $cat->name ?> <span>(<?php echo $count_1 ?>)</span></h2> </div>

<div class="grid_cont maine">
<ul class="products-grid cols_6">
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

<?php endforeach; ?>

</div>
<?php endif; // ($child_terms) ?>

<?php // _____ taxo_view: 'mixed' ?>













<?php else : // 'normal' ?>

<?php // ........... ?>
    
<?php endif; // taxo_view: 'normal' ?>




<?php $cat_curr = $queried_object; ?>
<?php if($cat_curr->description) { ?>
<div class="cat_description maine">
<?php if($cat_curr->term_thumbnail) { ?>
<div class="cat_image"><?php echo wp_get_attachment_image( $cat_curr->term_thumbnail, 'medium-img' ) ?></div>
<?php } ?>
<div class="descr"><?php echo term_description($cat_curr->term_id, $cat_curr->taxonomy) ?> <?php // echo $cat_curr->description ?></div>
</div>
<?php } ?>


<?php /* **** __end wow_e_shop zone */ ?>
	
 
 </div> <!-- content -->
 
            
    
</div> <!-- class="category blog" -->
   


<?php get_footer(); ?>