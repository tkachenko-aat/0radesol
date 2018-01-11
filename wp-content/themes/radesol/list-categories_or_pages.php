
<?php // Блок Підсторінки / Сусідні сторінки
if(is_page()) : 
$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0'); // підсторінки даної сторінки
if(!$children and $post->post_parent) { $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0'); } // "сусідні" сторінки даної сторінки
	 if ($children) { ?>
     <div class="block widget list_pages cats_tree">
<div class="block-title"> 
<span><?php _e('Pages') ?></span> 
<a class="toogle-b"></a>
</div>
<div class="block-content">
      <ul>
	<?php echo $children; ?> 
  	  </ul>
</div>      
     </div>        
<?php } 
endif; ?>
 
<?php 
$taxonomy = '';
/// Блок "Підкатегорії / Сусідні категорії" (сторінка категорії, сторінка товару)
if(is_archive()) : 
// $queried_object = $wp_query->queried_object; 
$term_id = $queried_object->term_id;
$taxonomy = $queried_object->taxonomy;
$curr_id = $term_id;
if(count(get_term_children($term_id, $taxonomy))) { $parent_id = $term_id; }
else { $parent_id = $queried_object->parent; }
elseif(is_single()) : 
//  	$post_type = get_post_type( $post );   
//  		$taxonomy_names = get_object_taxonomies( $post );  $taxonomy = $taxonomy_names[0];
//  		$terms = wp_get_post_terms($post->ID, $taxonomy);
//  		$term_4 = $terms[0];
$curr_id = $term_4->term_id;
$parent_id = $term_4->parent;
endif;

$child_terms = array();
if($taxonomy and $parent_id) {
	$child_terms = get_terms( $taxonomy, array('parent' => $parent_id, 'hide_empty' => false) ); //
}
?>
<?php if(count($child_terms)) : ?>
<div class="block widget cats_tree">
<div class="block-title"> 
<span><?php _e('Categories') ?></span> 
<a class="toogle-b"></a>
</div>
<div class="block-content">
<ul class="menu">
<?php foreach ($child_terms as $cat) : ?>
<li<?php if($cat->term_id == $curr_id) { ?> class="active"<?php } ?>>
<a href="<?php echo get_term_link($cat) ?>" title="<?php echo $cat->name ?>">
<?php /* 
<?php if($cat->term_thumbnail) { ?>
<div class="cat_image"><?php echo wp_get_attachment_image( $cat->term_thumbnail, 'blog-thumb' ) ?></div>
<?php } ?>
<div class="cat_name"> </div>
 */ ?>
<?php // $count_1 = WOW_categories_Func::get_term_post_count4($cat); // $count_1 = $cat->count; ?>
<?php echo $cat->name ?> <span><?php // echo '('.$count_1.')' ?></span>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
</div>
<?php endif; // ($child_terms) ?>