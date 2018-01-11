<?php /* Template Name: Blog main page */ ?>

<?php get_header(); ?>

        
<div class="page no_column blog health_blog">


    
	 <div class="content">
     
     <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>

   
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>   
   
    <div class="page_title title_content"><h1><?php the_title(); ?></h1></div>
        
    <div class="maine entry-content"> <?php the_content(); ?> </div>
	
	<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	           



	<div class="new-menu blog_menu">
		<?php wp_nav_menu(array('theme_location' => 'm4','container' => '')); ?>
	</div>





<?php // //////////// Blog ////  
$options4 = get_option('site_add_settings_4');
$cat_ids_2 = $options4['blog_main_cat_ids']; 
$cat_ids = explode(',', $cat_ids_2);
$taxonomy = 'category';
if(count($cat_ids)) : ?>
<?php foreach($cat_ids as $cat_id) : //////// ?>

<?php 
$term_id = (int) $cat_id;  if(term_exists($term_id, $taxonomy)) { // if tax_query
$term2 = get_term($cat_id, $taxonomy);
$cat_title = $term2->name;  $cat_slug = $term2->slug;  $cat_link = get_term_link($term2);
} // if tax_query 
$posts_args_2 = array (       
        'post_type'  => 'any', // 'fishki89', 'post';  'any' - усі типи  
		'posts_per_page'   => 6,
		// 'order' => 'DESC',	
		// 'orderby' => 'date', // 'title', 'date', 'modified', 'comment_count', 'menu_order' 
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			'terms' => $cat_id // 'my-slug2'
			)
		), 
		'meta_query' => array(
			'relation' => 'OR', // 'AND', 'OR'
			array (
			'key' => 'featured_article',
			'compare' => 'NOT EXISTS', // '=', '!=', '>', '>=', '<', '<=', 'IN', 'NOT IN', 'BETWEEN', 
			),			
			array (
			'key' => 'featured_article',
			'value' => 0, // array(2, 5) // (for 'BETWEEN')
			// 'compare' => '=',
			// 'type' => 'NUMERIC' // 'CHAR', 'NUMERIC', 'BINARY', 'DATE', 'DATETIME', 'DECIMAL', 
			)
		),		
		'post_status' => 'publish'
    );

$query_2 = new WP_Query($posts_args_2);

    if( $query_2->have_posts() ) { ?>
<div class="box-content maine blog_main <?php echo $cat_slug ?>">
<div class="tit tit_2"> <h4><?php echo $cat_title ?></h4> </div>

<div class="grid_cont">
<ul class="products-grid cols_3 blog-list">
<?php	
	$latest_posts_arr = array();
	while ($query_2->have_posts()) : 
	$query_2->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
	$latest_posts_arr[] = $post->ID;
?>  
 <li class="item">
 <div class="inn_cont">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( 'main-img' ); ?></a> </div>				
<?php } ?> 			
<h2> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2> 
<div class="ty">
 <?php $avtor_id = get_post_meta($post->ID, 'post_author_custom', true);
  $avtor_p_type = get_post_type($avtor_id); 
   $avtor_name = get_the_title($avtor_id);  $avtor_link = get_the_permalink ($avtor_id); ?>
	<span class="author <?php echo $avtor_p_type; ?>"><em><?php _e('by') ?></em> <a href="<?php echo $avtor_link; ?>"><?php echo $avtor_name; ?></a></span>
	<span class="cat"><em><?php _e('in') ?></em><?php echo the_category(); ?></span>
</div>
<?php $cutti_num = 200;
// $short_content_2 = preg_replace('`\[[^\]]*\]`', '', strip_tags(get_the_content())); // 
$short_content_2 = strip_shortcodes( strip_tags(get_the_content()) ); // WP function "strip_shortcodes"
$charset = get_bloginfo('charset'); // $charset = 'UTF-8';
$short_content = mb_substr($short_content_2, 0, $cutti_num, $charset); 
$short_content = mb_substr($short_content, 0, mb_strripos($short_content, ' ', 0, $charset), $charset);
?>
          <div class="descr entry-content"> <p><?php echo $short_content; ?></p> </div>
 </div>
 </li> 
<?php endwhile; ?>
</ul>

</div>
</div>
<?php }  wp_reset_query(); ?>





<?php /// Featured Article
	$posts_args_feat = array (       
        'post_type'  => 'any',
		'posts_per_page'  => 4, // 6
		// 'order' => 'DESC',	
		// 'orderby' => 'date',		
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			'terms' => $cat_id // 'my-slug2'
			)
		), 
		'meta_query' => array(
			array (
			'key' => 'featured_article',
			'value' => 1, // array(2, 5) // (for 'BETWEEN')
			// 'compare' => '=', // '=', '!=', '>', '>=', '<', '<=', 'IN', 'NOT IN', 'BETWEEN', 
			)
		),
		'post_status' => 'publish'
    );
$feat_query = new WP_Query($posts_args_feat);
    if( $feat_query->have_posts() ) { ?>
<div class="box-content maine featured"> <div class="inn">
<div class="left_cont">
<?php $title_2 = __('Featured Article'); if(get_post_meta($post->ID, 'page_feat_posts_title', true)) { $title_2 = get_post_meta($post->ID, 'page_feat_posts_title', true); } ?>
<div class="tit"> <h4><?php echo $title_2 ?></h4> </div>
<div class="conte">
<?php	
	while ($feat_query->have_posts()) : 
	$feat_query->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
?>  
 <div class="item">
 <div class="inn_cont">
           <?php $thumb = '';
	if ( has_post_thumbnail() ) { $thumb = get_the_post_thumbnail( $post->ID, 'slider-img' ); }  
		   if (class_exists('MultiPostThumbnails')) : 
	if ( MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'feat-image', NULL) ) { 
	$thumb = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'feat-image', NULL, 'slider-img');
	}
			endif;			
			?> 
<?php if ( $thumb ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>" ><?php echo $thumb; ?></a> </div> 	
<?php } ?> 	
<h2> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>
<div class="ty">
 <?php $avtor_id = get_post_meta($post->ID, 'post_author_custom', true);
   $avtor_p_type = get_post_type($avtor_id);
   $avtor_name = get_the_title($avtor_id);  $avtor_link = get_the_permalink ($avtor_id); ?>
	<span class="author <?php echo $avtor_p_type; ?>"><em><?php _e('by') ?></em> <a href="<?php echo $avtor_link; ?>"><?php echo $avtor_name; ?></a></span>
	<span class="cat"><em><?php _e('in') ?></em><?php echo the_category(); ?></span>
</div>
 </div>
 </div> 
<?php endwhile; ?>
</div>  
</div>

<div class="right_cont"> <?php /* right content */ ?> </div>
</div> </div>
<?php }  wp_reset_query(); ?>





<?php $child_cats = get_terms( $taxonomy, array('parent' => $cat_id, 'hide_empty' => true) ); //
if(count($child_cats)) : ?> 
<div class="box-content maine blog_child_cats">

<?php $num_8 = 0; ?>
<?php foreach ($child_cats as $cat) : ?>
<?php 
$num_8++;  
$class_8 = '';  if($num_8 == 1) { $class_8 = ' wide '; } 
$img_size = 'thumbnail';  if($num_8 == 1) { $img_size = 'main-img'; }
$cat_link = get_term_link($cat);  $cat_name = $cat->name;
$more_text_2 = __('Load more'); if(get_post_meta($post->ID, 'page_more_text_2', true)) { $more_text_2 = get_post_meta($post->ID, 'page_more_text_2', true); }
?>

<?php ////// Child cats /////// 
	$posts_args_8 = array (       
        'post_type'  => 'any', // 
		'posts_per_page'   => 3,
		// 'order' => 'DESC',	
		// 'orderby' => 'date',
		'post__not_in'  => $latest_posts_arr, 
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			'terms' => $cat->term_id // 
			)
		), 
		'meta_query' => array(
			'relation' => 'OR', // 'AND', 'OR'
			array (
			'key' => 'featured_article',
			'compare' => 'NOT EXISTS',  
			),			
			array (
			'key' => 'featured_article',
			'value' => 0, 
			)
		),		
		'post_status' => 'publish'
	);
$query_8 = new WP_Query($posts_args_8);

    if( $query_8->have_posts() ) { ?>
<div class="child_cat <?php echo $class_8.$cat->slug; ?>">
<div class="tit"> <h2><a href="<?php echo $cat_link ?>"><?php echo $cat_name ?></a></h2> </div>

<div class="grid_cont">
<ul class="<?php if($num_8 == 1) { ?>products-grid cols_3 <?php } ?>blog-list">
<?php	
	while ($query_8->have_posts()) : 
	$query_8->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
?>  
 <li class="item">
 <div class="inn_cont">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( $img_size ); ?></a> </div>				
<?php } ?> 			
<h3> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h3> 
<div class="ty">
 <?php $avtor_id = get_post_meta($post->ID, 'post_author_custom', true);
  $avtor_p_type = get_post_type($avtor_id); 
   $avtor_name = get_the_title($avtor_id);  $avtor_link = get_the_permalink ($avtor_id); ?>
	<span class="author <?php echo $avtor_p_type; ?>"><em><?php _e('by') ?></em> <a href="<?php echo $avtor_link; ?>"><?php echo $avtor_name; ?></a></span>
	<span class="cat"><em><?php _e('in') ?></em><?php echo the_category(); ?></span>
</div>
	<?php if($num_8 == 1) { ?> 
<?php $cutti_num = 200;
$short_content_2 = strip_shortcodes( strip_tags(get_the_content()) ); // 
$charset = get_bloginfo('charset'); // $charset = 'UTF-8';
$short_content = mb_substr($short_content_2, 0, $cutti_num, $charset); 
$short_content = mb_substr($short_content, 0, mb_strripos($short_content, ' ', 0, $charset), $charset);
?>
          <div class="descr entry-content"> <p><?php echo $short_content; ?></p> </div>
	<?php } ?> 
 </div>
 </li> 
<?php endwhile; ?>
</ul>

<div class="more_line"> <a class="show-more" href="<?php echo $cat_link ?>"><?php echo $more_text_2.' '.$cat_name; ?><?php // _e('More...'); ?></a> </div>
</div>
</div>
<?php }  wp_reset_query(); ?>

<?php endforeach; ?>

</div>
<?php endif; // ($child_cats) ?>






<?php endforeach; //////////// ///////////// ?>

<?php endif; // (count($cat_ids)) ?>





   
    </div> <!-- content --> 


 
</div> <!-- class="page blog" -->



<?php get_footer(); ?>