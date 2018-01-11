<div class="s-perfect search_ajax_rez drop_sidebar">

<div class="col col_1">
<?php $menu_search_name = 'search_feature';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_search_name] ) ) : 
	$menu_5 = wp_get_nav_menu_object( $locations[$menu_search_name] );
	$menu_items = wp_get_nav_menu_items($menu_5->term_id);
?>
<?php foreach ($menu_items as $item) : ?>
<?php if($item->type == 'taxonomy') { 
// $tax_5 = get_term_by('id', $item->object_id, $item->object);
$taxonomy = $item->object;  $cat_id = $item->object_id;
$cat_link = $item->url;  $cat_title = $item->title;
	$posts_args_8 = array (       
        'post_type'  => 'any',
		'posts_per_page'    => 12,
		'order' => 'ASC',	
		'orderby' => 'menu_order',		
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			'terms' => $cat_id // 53, 'my-slug2'
			)
		), 
		'post_status' => 'publish'
    );

$query_perf = new WP_Query($posts_args_8);
    if( $query_perf->have_posts() ) { ?>
<div class="box_2"> 
<div class="tit"> <h3><a href="<?php echo $cat_link ?>"><?php echo $cat_title ?></a></h3> </div>
<ul class="s_items cols_2">
<?php	
	while ($query_perf->have_posts()) : 
	$query_perf->the_post(); 
?>  
 <li>
 <a href="<?php the_permalink(); ?>" class="product-box" title="<?php the_title() ?>">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="prod_img"><?php the_post_thumbnail('thumbnail'); ?></div>				
<?php } ?>
<div class="prod_name"><?php the_title(); ?></div> 			
 </a> 
 </li> 
<?php endwhile; ?>
</ul>

</div>
<?php }  wp_reset_query(); ?>
<?php } // if($item->type == 'taxonomy') ?>
<?php endforeach; ?>
<?php endif; // isset( $locations[ $menu_search_name ] ) ?>
</div>


<div class="col col_2">
Health blog ... standart wp menu
</div>

</div>