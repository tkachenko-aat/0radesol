
<?php ////// More articles ///////
	$cat_title = $term_4->name; /* вгорі, на поч. файлу */ // $term_4 
	$avtor_id = get_post_meta($post->ID, 'post_author_custom', true);
	$author_title = get_the_title($avtor_id)."'s ".__('articles');
	$tags = wp_get_post_tags($post->ID);
if ($tags) { $tag_ids=array(); foreach($tags as $individual_tag) {$tag_ids[] = $individual_tag->term_id;} }	
	/* вгорі, на поч. файлу */ // $terms = wp_get_post_terms($post->ID, $taxonomy);
	$term_ids = array();
	if ($terms) { foreach($terms as $ind_term) { $term_ids[] = $ind_term->term_id; } }

$more_args_9 = array (
	'articles_author' => array( 'title' => $author_title, 'args_2' => array( 'meta_query' => array(array('key' => 'post_author_custom', 'value' => $avtor_id)) /* , 'tax_query' => ... */ ) ),
	'articles_tag' => array( 'title' => __('Similar articles'), 'args_2' => array( 'tag__in' => $tag_ids, /* , 'tax_query' => ... */ ) ),
	'articles_cat' => array( 'title' => __('More in').' '.$cat_title, 'args_2' => array( 'tax_query' => array(array('taxonomy' => $taxonomy, 'terms' => $term_ids)) /* , 'meta_query' => ... */ ) ),
);
	if (!$tags) { unset($more_args_9['articles_tag']); }
?> 
<div class="box-content maine blog_child_cats more_articles">

<?php foreach ($more_args_9 as $key_9 => $articles) : ?>
<?php 
$cat_link = get_term_link($cat);  $cat_name = $cat->name;
$more_text_2 = __('Load more'); if(get_post_meta($post->ID, 'page_more_text_2', true)) { $more_text_2 = get_post_meta($post->ID, 'page_more_text_2', true); }
////// More articles /////// 
	$posts_args_7 = array (       
        'post_type'  => 'any', // 
		'posts_per_page'   => 3,
		// 'order' => 'DESC',	
		// 'orderby' => 'date',
		'post__not_in' => array($post->ID), 	
		'post_status' => 'publish'
	);

$posts_args_8 = $posts_args_7 + $articles['args_2']; 
$query_8 = new WP_Query($posts_args_8);

    if( $query_8->have_posts() ) { ?>
<div class="child_cat <?php echo $key_9; ?>">
<div class="tit"> <h4><?php echo $articles['title'] ?></h4> </div>

<div class="grid_cont">
<ul class="blog-list">
<?php	
	while ($query_8->have_posts()) : 
	$query_8->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
?>  
 <li class="item">
 <div class="inn_cont">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a> </div>				
<?php } ?> 			
<h3> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h3> 
<div class="ty">
 <?php $avtor_id = get_post_meta($post->ID, 'post_author_custom', true);
  $avtor_p_type = get_post_type($avtor_id); 
   $avtor_name = get_the_title($avtor_id);  $avtor_link = get_the_permalink ($avtor_id); ?>
	<span class="author <?php echo $avtor_p_type; ?>"><em><?php _e('by') ?></em> <a href="<?php echo $avtor_link; ?>"><?php echo $avtor_name; ?></a></span>
	<span class="cat"><em><?php _e('in') ?></em><?php echo the_category(); ?></span>
</div>
 </div>
 </li> 
<?php endwhile; ?>
</ul>

</div>
</div>
<?php }  wp_reset_query(); ?>

<?php endforeach; ?>

</div>
