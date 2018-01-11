<?php
/*
Template Name: WOW orders  
*/
?>
<?php if (!is_user_logged_in()) { wp_safe_redirect( get_bloginfo('url') ); } ?>

<?php get_header(); ?>

        
<div class="page orders blog">


<?php include WOW_DIRE.'front_html_blocks/profile_menu.php'; /* wow_e_shop *** profile_menu *** */ ?>


    <?php // Лівий сайдбар ?>
     <?php include 'column-left.php'; ?>
     
       
    
	 <div id="orders_page" class="content ajax_replace2_content">	

     
     <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
 
 
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
 
    <div class="page_title title_content"> <h1><?php the_title(); ?></h1> </div>
    <div class="maine entry-content"> <?php the_content(); ?> </div>  
    
   <?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	  
  
    
    <div class="orders_co maine">
<?php
$current_user = wp_get_current_user();  $user_id = get_current_user_id();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // pagination
$posts_args_2 = array (       
        'post_type'  => 'wow_order',
		'posts_per_page'    => 10,
		'paged' => $paged, // pagination
		// 'order' => 'DESC',
		// 'orderby' => 'date', // 'title'
		'author' => $user_id,
		// 'post_status' => 'publish'
    );

$order_query = new WP_Query($posts_args_2);

    if( $order_query->have_posts() ) { ?>

<div class="tab_head"> <div class="colu ord_id"><?php _e('Id') ?></div> <div class="colu ord_date"><?php _e('Date') ?></div> <div class="colu total"><?php _e('Grand total') ?></div> <div class="colu products"><?php _e('Products') ?></div> <div class="colu status"><?php _e('Status') ?></div> </div>

<ul class="blog-archive">	
<?php 
	while ($order_query->have_posts()) : 
	$order_query->the_post(); 
		global $more;  $more = 0;  // необхідно для тегу <!--more-->

$billing_arr = WOW_Checkout::order_billing_info($post->ID);

$excerpt = get_the_excerpt($post->ID);
if ( !empty($excerpt) ) { $excerpt_arr = unserialize($excerpt); }
$products = $excerpt_arr['products'];
$products_2 = array();
foreach ($products as $prod_id => $p_qty) :
$products_2[] = '<span class="tit">'.get_the_title($prod_id).' <span>('.$p_qty.')</span></span>';
endforeach;
$products_txt = implode(', ', $products_2);

$order_status = $post->pinged;
$status_arr = WOW_Checkout::order_status_array();
?> 
 <li class="item"> <?php // content ?>
 <div class="inn">
 <div class="order_head">
 <div class="colu ord_id"><a href="<?php the_permalink(); ?>"><?php _e('The order'); echo ' <span>'.$post->ID.'</span>'; ?></a></div>
 <div class="colu ord_date"><a href="<?php the_permalink(); ?>"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'd.m.Y' ); ?></time></a></div>
 <div class="colu total"><?php echo $billing_arr['grand_total'] ?></div>
 <div class="colu products"><?php echo $products_txt; ?></div>
 <div class="colu status"><a class="stat_icon icon-<?php echo $order_status ?>" href="<?php the_permalink(); ?>" title="<?php echo $status_arr[$order_status] ?>"><i class="fa fa-shopping-cart"></i> <span><?php echo $status_arr[$order_status] ?></span></a></div>
 </div>
 </div>
 </li>
 
<?php endwhile; ?>
</ul>

<?php }  wp_reset_query();  // if( $order_query->have_posts() ) ?>    
  
    
<?php if (function_exists('wp_corenavi')) wp_corenavi($order_query); ?>    
    </div> <!-- orders_co -->
        
	
	           
    </div>      
	

     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>