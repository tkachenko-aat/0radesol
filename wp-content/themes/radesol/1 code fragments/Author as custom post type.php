<?php /* 
This is similar to single-posts_args_by_atr_option.php .
But here we don't use attribute.
*/ ?>


<?php
/* functions.php */


add_action('add_meta_boxes', 'add_author_custom_box');
function add_author_custom_box() {
 $types = array('post');
 foreach ($types as $type) {
	$post_type = $type;
add_meta_box('post_author_custom', __('Consultant, writer'), 'post_author_custom_f', $post_type, 'normal', 'low');
 }
}

function post_author_custom_f() {
		global $wpdb;
		global $post;		
	$meta_key_1 = 'post_author_custom';
	add_post_meta($post->ID, $meta_key_1, '', true);
	$post_meta_arr_1 = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key = '$meta_key_1'", ARRAY_A );
	$meta_input_id = $post_meta_arr_1['meta_id']; 
	$input_value = $post_meta_arr_1['meta_value'];
		$p_author = $input_value; 
	$item_input_name = 'meta['.$meta_input_id.'][value]';
	$item_input_key = 'meta['.$meta_input_id.'][key]';
	
	echo '<input type="hidden" name="'.$item_input_key.'" value="'.$meta_key_1.'" />'; ///

$author_types = array (       
 'consultant' => array('order' => 'ASC', 'orderby' => 'title', 'title_1' => __('Select consultant')),
 'writer' => array('order' => 'ASC', 'orderby' => 'title', 'title_1' => __('Select simple author')),
);
	foreach ($author_types as $p_type => $author_arr) :  /////
$posts_args_4 = array (       
        'post_type'  => $p_type,
		'order' => $author_arr['order'],	
		'orderby' => $author_arr['orderby'], // 'menu_order' 
		'posts_per_page' => -1,
		'post_status' => 'publish',
);
$author_4_query = new WP_Query($posts_args_4);
if( $author_4_query->have_posts() ) {
	echo '<div class="box_1">';
	echo '<div class="tit"><strong>'.$author_arr['title_1'].'</strong></div>';
		echo '<span class="line_lab_2">';
		echo '<label class="line_lab" for="nothing_87_'.$p_type.'">---'.__('No author').'---</label>  ';
		echo '<input type="radio" id="nothing_87_'.$p_type.'" name="'.$item_input_name.'" value="" />';
		echo '</span>';	
	while ($author_4_query->have_posts()) :  $author_4_query->the_post(); ///
	$post_id = $post->ID;
	$author_id = 'author-hx-'.$post_id;
	$check = ''; if($p_author == $post_id) { $check = ' checked="checked"'; }
	echo '<span class="line_lab_2">';
	echo '<label class="line_lab" for="'.$author_id.'">'.get_the_title().'</label>  ';
	echo '<input type="radio" id="'.$author_id.'" name="'.$item_input_name.'" value="'.$post_id.'"'.$check.' />';
	echo '</span>';	
	endwhile; ///
	echo '</br></br> </div>';
}  wp_reset_query(); // if( $author_4_query->have_posts() )
	endforeach; /////
		
}
?>





single.php
<?php /// Author latest posts
$post_id = $post->ID;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // pagination
$posts_args_2 = array (       
        'post_type'  => 'any',
		'posts_per_page'  => -1, // 6
		'paged' => $paged, // pagination
		'order' => 'DESC',	
		'orderby' => 'date',		
		'meta_query' => array(
			array (
			'key' => 'post_author_custom',
			'value' => $post_id, // array(2, 5) // (for 'BETWEEN')
			// 'compare' => '=', // '=', '!=', '>', '>=', '<', '<=', 'IN', 'NOT IN', 'BETWEEN', 
			)
		),
		'post_status' => 'publish'
    );

$author_query = new WP_Query($posts_args_2);
    if( $author_query->have_posts() ) { ?>
<div class="box-content maine ">
<?php $title_2 = get_the_title()."'s ".__('latest articles'); if(get_post_meta($post->ID, 'latest_posts_title', true)) { $title_2 = get_post_meta($post->ID, 'latest_posts_title', true); } ?>
<div class="tit"> <h3><?php echo $title_2 ?></h3> </div>
<div class="grid_cont">
<ul class="products-grid cols_3 blog-list "> 
<?php	
	while ($author_query->have_posts()) : 
	$author_query->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
?>  
 <li class="item">
 <div class="inn">
	<header>
  <h2> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>     
	<time datetime="<?php the_time( 'Y-m-d' ); ?>"> <?php the_time( 'j.m.Y' ); ?> </time>
    </header>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'blog-thumb' ); ?></a> </div>				
<?php } ?> 			
<?php $cutti_num = 250;
// $short_content_2 = preg_replace('`\[[^\]]*\]`', '', strip_tags(get_the_content())); // 
$short_content_2 = strip_shortcodes( strip_tags(get_the_content()) ); // WP function "strip_shortcodes"
$charset = get_bloginfo('charset'); // $charset = 'UTF-8';
$short_content = mb_substr($short_content_2, 0, $cutti_num, $charset); 
$short_content = mb_substr($short_content, 0, mb_strripos($short_content, ' ', 0, $charset), $charset);
?>
          <div class="descr entry-content"> <?php echo $short_content; ?> </div>
 </div>
 </li> 
<?php endwhile; ?>
</ul>
</div>
    <?php if (function_exists('wp_corenavi')) wp_corenavi($author_query); ?>
</div>
<?php }  wp_reset_query(); ?>
