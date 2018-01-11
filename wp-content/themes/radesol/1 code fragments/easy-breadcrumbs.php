   <?php 
   // global $wp_query;
	// $queried_object = $wp_query->queried_object;
	// $taxonomy = $queried_object->taxonomy;	///// 
	// $term_id = $queried_object->term_id;
	$to_home_title = __('Home');
	 $options_7 = get_option('site_add_settings_4');
	 if($options_7['go_home_text_2']) { $to_home_title = $options_7['go_home_text_2']; } 
   $show_bre_2 = 0;
   ?>

<?php $menu_bre_name = 'm_breadcr_feature';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_bre_name] ) ) : 
	$menu_5 = wp_get_nav_menu_object( $locations[$menu_bre_name] );
	$menu_items_5 = wp_get_nav_menu_items($menu_5->term_id);
foreach ($menu_items_5 as $key_5 => $item) {
	if($item->object == $taxonomy) { $act_key_5 = $key_5;  $show_bre_2 = 1; }
	// unset($feat_menu_items_5[$key_5]); $my_cat_link = $item; $act_key_5 = $key_5;
}
	if($show_bre_2) : 
$next_key_5 = $act_key_5 + 1;  if(!$menu_items_5[$next_key_5]) { $next_key_5 = 0; }
$link_1 = array('link' => $menu_items_5[$act_key_5]->url, 'title' => $menu_items_5[$act_key_5]->title);
if( is_archive() and $menu_items_5[$act_key_5]->object_id == $term_id ) {
	$link_1['title'] = $to_home_title;  $link_1['link'] = 'home';
}
$link_2 = '';
if(count($menu_items_5) > 1) {
$link_2 = array('link' => $menu_items_5[$next_key_5]->url, 'title' => $menu_items_5[$next_key_5]->title);
}
?> 
<div class="easy_breadcrumbs">
<div class="link link_1">[ <a href="<?php if($link_1['link'] == 'home') { bloginfo('url'); } else { echo $link_1['link']; } ?>"><?php echo $link_1['title'] ?></a> </div>
<?php if($link_2) { ?>
<div class="link link_2"> <a href="<?php echo $link_2['link']; ?>"><?php echo $link_2['title'] ?></a> ]</div>
<?php } ?>
</div>
<?php endif; endif; ?>
