<?php /* replace <div class="top_menu"> ... </div> */ ?>

	<div id="menu1" class="top_menu"> 
  <?php // wp_nav_menu( array( 'theme_location' => 'm1', 'fallback_cb' => false ) ); ?> 
  
<?php     if ( is_page() ) : 

	$parent_id = $post->ID;
$pages_args = array(
	'post_type' => 'page',
	'post_parent' => $parent_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'post_status' => array('publish', 'draft')
);
$num = 0;
	$query_pages_menu = new WP_Query($pages_args);
    if( $query_pages_menu->have_posts() ) { ?>
        <ul class="menu">
        <?php while ($query_pages_menu->have_posts()) { $query_pages_menu->the_post(); 
		$link = $post->post_name;
		$title = get_the_title();
/// 'short_title'
$short_title_6 = WOW_Attributes_Front::post_view_one_attribute($post->ID, 'short_title');
if($short_title_6['atr_value']) :  $title = implode(', ', $short_title_6['atr_value']);  endif;
/// __ 'short_title' 
		$num++;
		?>        
 <li class="<?php echo 'post-'.$num ?>" id="l_pag_menu_item-<?php the_ID(); ?>"> <a href="<?php echo '#'.$link ?>"><?php echo $title; ?></a> </li> 
        <?php } ?>
        </ul>
<?php } wp_reset_query(); ?>  

<?php endif; // if ( is_page() ) ?>

	</div>