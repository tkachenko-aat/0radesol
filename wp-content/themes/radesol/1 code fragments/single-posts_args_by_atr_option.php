<?php /*  *** Вибірка матеріалів, повязаних з відкритим матеріалом через вибрані опції певного атрибуту (в опціях атрибуту повинно бути заповнене поле "add_post_id"; z_attributes_list_content.php - розкоментувати поле "add_post_id"). 
Наприклад, показати всі публікації (товари) даного автора на його сторінці. ***  */ 
?>
<?php /// 
// $post_id = $post->ID;
$atr_code_2 = 'blog_author';  //  Attribute code - 'blog_author' 
$p_type_2 = ''; // $p_type_2 = 'product';
$posts_args_25 = WOW_Attributes_Front::get_posts_args_by_atr_option($post_id, $atr_code_2, $p_type_2);
$title_2 = __('View posts by this author');
if($posts_args_25['title']) { $title_2 = $posts_args_25['title']; } // Attribute field 'frontend_label_2' 
$posts_args_2 = $posts_args_25['posts_args'];
$author_query_2 = new WP_Query($posts_args_2);
    if( $author_query_2->have_posts() ) { ?>
<div class="box-content maine posts_2">
<div class="tit"> <h3><?php echo $title_2 ?></h3> </div>
<div class="grid_cont">
<ul class="products-grid cols_3 blog-list"> <?php // class="products-list" ?> 
<?php	
	while ($author_query_2->have_posts()) : 
	$author_query_2->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
?> 
 <li class="item">
 <div class="inn">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'blog-thumb' ); ?></a> </div>				
<?php } ?> 
  <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>   
          <div class="descr entry-content"> <?php the_content(); ?> </div>
 </div>
 </li> 
<?php endwhile; ?>
</ul>
</div>
    <?php if (function_exists('wp_corenavi')) wp_corenavi($author_query_2); ?>
</div>
<?php }  wp_reset_query(); ?>