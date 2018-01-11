<aside id="right-column" class="column fix_column">


<?php include 'list-categories_or_pages.php'; /* *** list-categories_or_pages *** */ ?>

		
<div id="right-sidebar">    
<?php dynamic_sidebar( 'right-sidebar' ); ?>
</div>
  



<?php if(is_single() and get_post_type() == 'post') : ///  ?>
<?php 
/// Posts in category 
$term_ids = array();
if(is_archive()) : 
$queried_object = $wp_query->queried_object; 
$term_id = $queried_object->term_id;
$taxonomy = $queried_object->taxonomy;
if ($term_id) { $term_ids[0] = $term_id; }
// $curr_id = $term_id;
$curr_post_ids = array();
 
elseif(is_single()) : 
  	$post_type = get_post_type();   
  		$taxonomy_names = get_object_taxonomies($post);  $taxonomy = $taxonomy_names[0];
  		$terms = wp_get_post_terms($post->ID, $taxonomy);
if ($terms) {  foreach($terms as $ind_term) { $term_ids[] = $ind_term->term_id; }  }
  		// $term_4 = $terms[0];  $curr_id = $term_4->term_id;
		$curr_post_ids = array($post->ID);
endif;
?>

<?php if(count($term_ids)) : ?>
<?php 
$posts_args_72 = array (       
        'post_type'  => 'any',
		'posts_per_page'  => 4,
		// 'order' => 'DESC',	
		// 'orderby' => 'date',
		'post__not_in' => $curr_post_ids,	
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			// 'field' => 'term_id', // 'slug'
			'terms' => $term_ids // 'my-slug2'
			)
		), 
		'post_status' => 'publish'
    );
$query_75 = new WP_Query($posts_args_72);

    if( $query_75->have_posts() ) { ?>
<div class="block other_posts">
<div class="block-title"> 
<span><?php _e('Posts in category') ?></span> 
<a class="toogle-b"></a>
</div>
<div class="block-content">
<ul class="">
<?php	
	while ($query_75->have_posts()) : 
	$query_75->the_post(); 
?>  
 <li class="item">
 <div class="inn">
	<header>
  <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>   
	<time datetime="<?php the_time( 'Y-m-d' ); ?>"> <?php the_time( 'j.m.Y' ); ?> </time>
    </header>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'main-img' ); ?></a> </div>				
<?php } ?> 
  <?php $content = get_the_content();  $cutti_num = 200; ?>
  <div class="descr entry-content"> <?php echo samorano_short_content($content, $cutti_num); ?> <span class="more"> ...</span> </div>  
 </div>
 </li> 
<?php endwhile; ?>
</ul>
</div>
</div>
<?php }  wp_reset_query(); ?>

<?php endif; // if(count($term_ids)) ?>
<?php endif; // if(get_post_type() == 'post') ?>	
    
	
    
</aside>
