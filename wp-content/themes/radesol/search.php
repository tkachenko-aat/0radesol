<?php get_header(); ?>


<?php if($_POST['search_ajax_request']) : ?>

<div class="search_ajax ajax_replace2_content">
<?php 
		$s_query_args = array(
			's'           => $_POST['search_ajax_request'],
			'post_status' => 'publish',
			'posts_per_page' => 8
		);

		$search_query = new WP_Query($s_query_args);
if( $search_query->have_posts() ) {
?>
<div class="search_ajax_rez drop_sidebar">
        <ul class="s_items">
        <?php while ($search_query->have_posts()) : 
		$search_query->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
		?>
 <li>
 <a href="<?php the_permalink() ?>" class="product-box" title="<?php the_title() ?>">
 <?php if ( has_post_thumbnail() ) { ?>
 <div class="prod_img"><?php the_post_thumbnail('thumbnail'); ?></div>
 <?php } ?>
 <div class="prod_name"><?php the_title(); ?></div>
 <?php /* <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('d.m.Y'); ?></time> */ ?>
 <?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
 <div class="price-box"><?php echo $product_price ?></div>
 </a>
 </li> 
        <?php endwhile; ?>
        </ul>
</div>
<?php }  wp_reset_query(); ?>
</div>




<?php else : /// /// standart search page ?>

	
     <div class="category blog search-items"> 


    <?php // Лівий сайдбар ?>
    <?php include 'column-left.php'; ?> 
         
   
   <div class="content">
   
    <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
   
<div class="page_title title_content">      
  <h2><?php _e('Search Results'); ?> <span class="kivi"> : </span> <?php printf('<span>' . get_search_query() . '</span>' ); ?></h2>    
</div>


  <?php // main content ?> <?php if(have_posts()) : ?> 
  
<div class="grid_cont maine">  
 <ul class="products-list">
  <?php while(have_posts()) : the_post(); ?>  
<?php $post_id = $post->ID; ?>   
<li class="item shad_item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>> 
 <?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/sticker.php'; /* wow_e_shop *** sticker *** */ ?> 
 <div class="inn_cont">
 <div class="prod-image">
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn"> <img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" /> </div>'; } ?></a>
 </div>
 
 <div class="prod-center">
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 <div class="entry-content"><?php the_content(); ?></div>
 <?php $post_id = $post->ID;
  include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
  
 <?php // $count = get_post_meta($post->ID, 'views', true); echo $count; ?>
 </div>
	
    <div class="addto">
        <div class="addto-main">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <div class="price-box"><?php echo $product_price ?></div>    
		<?php $stock_2 = get_post_meta ($post->ID, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
     	<?php $product_type = get_post_meta ($post->ID, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php the_ID() ?>', '1')"<?php } ?> class="button btn-cart" title="<?php _e('Add to cart') ?>"><?php _e('Add to cart') ?></a> </div>
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

</div> <!-- grid_cont -->
  
<?php else : // no posts ?> 

<div class="conte maine">
 <article class="no-posts"> <p> <?php _e( 'There are no products matching the selection.' ); ?> </p> </article>
</div>
 
  <?php endif; ?>	<?php // -//- end main content ?>   
 
 
<?php if (function_exists('wp_corenavi')) wp_corenavi(''); ?>
 
 
 </div> <!-- content -->
 
    
</div> <!-- blog search-items -->

<?php endif; /// --- standart search page ?>


<?php get_footer(); ?>