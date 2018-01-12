<?php /* !! Spaces between PHP-symbols are not allowed ! */

/// Функція для вставки меню 
register_nav_menus(
   array(
  'm1' => __('Main menu'),
  'm2' => __('Menu at the top'),
  'm3' => __('Footer menu'),
  'm4' => __('Social menu'),
  'm_home_feature' => __('Homepage - favorites'),
  // 'm_home_prod_categories' => __('Homepage - categories with products'),
  // 'search_feature' => __('Search bar - favorites'), // categories 
  // 'm_public_cats' => __('Menu with categories for publication'),
)
);

/// Функція для вставки сайдбарів 
class Menu_With_Description extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
// get user defined attributes for thumbnail images
		$attr_defaults = array(
			'class' => 'nav_thumb',
			'alt'   => esc_attr( $item->attr_title ),
			'title' => esc_attr( $item->attr_title )
		);
		$attr          = isset( $args->thumbnail_attr ) ? $args->thumbnail_attr : '';
		$attr          = wp_parse_args( $attr, $attr_defaults );
		$item_output = $args->before;
// thumbnail image output
		$item_output .= ( isset( $args->thumbnail_link ) && $args->thumbnail_link ) ? '<a' . $attributes . '>' : '';
		$item_output .= apply_filters( 'menu_item_thumbnail', ( isset( $args->thumbnail ) && $args->thumbnail ) ? get_the_post_thumbnail( $item->object_id, ( isset( $args->thumbnail_size ) ) ? $args->thumbnail_size : 'thumbnail', $attr ) : '', $item, $args, $depth );
		$item_output .= ( isset( $args->thumbnail_link ) && $args->thumbnail_link ) ? '</a>' : '';
// menu link output
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
// menu description output based on depth
		$item_output .= ( $args->desc_depth >= $depth ) ? '<br /><span class="sub">' . $item->description . '</span>' : '';
// close menu link anchor
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
// filter
add_filter( 'wp_nav_menu_args', 'my_add_menu_descriptions' );
function my_add_menu_descriptions( $args ) {
	if ( $args['theme_location'] == 'm2' ) {
		$args['walker']         = new Menu_With_Description;
		$args['desc_depth']     = 0;
		$args['thumbnail']      = true;
		$args['thumbnail_link'] = true;
		//$args['thumbnail_size'] = 'nav_thumb';
		//$args['thumbnail_attr'] = array( 'class' => 'nav_thumb my_thumb', 'alt' => 'test', 'title' => 'test' );
	}
	return $args;
}

/// Функція для вставки сайдбарів 
function my_theme_sidebars_in() {
	register_sidebar(
		array(
			'id' => 'left-sidebar',
			'name' => __( 'left-sidebar' ),
			'description' => __( 'Ліва колонка' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',	
			'after_title'   => '</h3>'
		)
	);	
	register_sidebar(
		array(
			'id' => 'right-sidebar',
			'name' => __( 'right-sidebar' ),
			'description' => __( 'Права колонка' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'id' => 'sidebar-contact',
			'name' => __( 'sidebar-contact' ),
			'description' => __( 'Контакти (телефон) в хедері' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'id' => 'top-sidebar',
			'name' => __( 'top-sidebar' ),
			'description' => __( 'Верхній сайдбар (пошук)' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'id' => 'languagg',
			'name' => __( 'languagg' ),
			'description' => __( 'Languages' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		)
	);		
	register_sidebar(
		array(
			'id' => 'futer_left',
			'name' => __( 'futer_left' ),
			'description' => __( ' ' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',	
			'after_title'   => '</h3>'
		)
	);
	register_sidebar(
		array(
			'id' => 'futer_centr',
			'name' => __( 'futer_centr' ),
			'description' => __( '3 widgets - 3 columns' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',	
			'after_title'   => '</h3>'
		)
	);
	register_sidebar(
		array(
			'id' => 'futer_right',
			'name' => __( 'futer_right' ),
			'description' => __( ' ' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',	
			'after_title'   => '</h3>'
		)
	);
	register_sidebar(
		array(
			'id' => 'futer_copyright',
			'name' => __( 'futer_copyright' ),
			'description' => __( '' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		)
	);	
}

add_action( 'widgets_init', 'my_theme_sidebars_in' );


 
add_theme_support( 'custom-header' );

// post-thumbnails - image_size
if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
// add_theme_support( 'post-thumbnails', array( 'post', 'slide', 'page') );
add_image_size( 'main-img', 420, 370, true );
add_image_size( 'medium-img', 250, 250, true );
// add_image_size( 'blog-thumb', 230, 180, true );
// add_image_size( 'slider-img', 1000, 300, true ); // 750, 280
/* при імпорті товарів деякі розміри зображень вилучаються */
}


function salas_image_resize( $thumb_id, $width, $height ) {
	$size_key = 'salas_'.$width.'_'.$height;
	$metadata = wp_get_attachment_metadata($thumb_id);
	if( !$metadata['sizes'][$size_key] and ($width < $metadata['width'] or $height < $metadata['height']) ) {	
		$attached_file = get_attached_file( $thumb_id );
		$resized = image_make_intermediate_size( $attached_file, $width, $height, true );
		if ( !is_wp_error($resized) ) {			
			$metadata['sizes'][$size_key] = $resized;		
			wp_update_attachment_metadata( $thumb_id, $metadata );
		}
	}
	$image = wp_get_attachment_image( $thumb_id, $size_key );
return $image;
}


function salas_remove_image_sizes($sizes) {
    unset($sizes['large'], $sizes['medium_large']);  /// 'medium' 
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'salas_remove_image_sizes');
/* add_filter( 'image_size_names_choose' ); */


/* Multi Post Thumbnails */
/* 
require_once ( TEMPLATEPATH . '/lib/multi_post_thumbnails.php' );
/// front code - single-post.php 
if (class_exists('MultiPostThumbnails')) {
$p_types = array('post', 'product');
foreach($p_types as $p_type) {
	new MultiPostThumbnails( array(
'label' => 'Featured 2 Image',
'id' => 'thumbnail-feat',
'post_type' => $p_type 
	) );
	new MultiPostThumbnails( array(
'label' => 'Featured Image simple',
'id' => 'thumbnail-simple',
'post_type' => $p_type 
	) );
}
}
 */




/*  register_post_type , register_taxonomy - register_post_type.php */


// підключити набір css, яваскриптів 
function add_my_scripts4() {

wp_enqueue_style( 'tema-wp-style', get_stylesheet_uri(), array(), NULL ); /* style.css - Осн. файл стилів */
wp_enqueue_style( 'simple-icons', get_template_directory_uri().'/presentation/simple-icons.css', array(), NULL );

wp_register_script( 'prototype4', get_template_directory_uri().'/scripts/prototype.js#async', array(), NULL, false );
wp_enqueue_script( 'prototype4' );

 wp_deregister_script( 'jquery' );  wp_deregister_script( 'jquery-migrate' );
 wp_register_script( 'jquery', includes_url('/js/jquery/jquery.js'), array(), NULL, true );
 wp_enqueue_script( 'jquery' );
 // wp_register_script( 'jquery-migrate', includes_url('/js/jquery/jquery-migrate.min.js'), array(), NULL, true );  wp_enqueue_script( 'jquery-migrate' );
  
wp_register_script( 'j_carousel', get_template_directory_uri().'/scripts/j_carousel.js', array(), '9.0', true );
wp_enqueue_script( 'j_carousel' );

wp_register_script( 'touch-slick', get_template_directory_uri().'/scripts/touch-slick.js', array(), '1.0', true );
wp_enqueue_script( 'touch-slick' );

// підключити jquery-ui з ядра 
// wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-slider');
wp_enqueue_script('jquery-ui-tooltip'); //// 

wp_register_script( 'maskedinput', get_template_directory_uri().'/scripts/jquery.maskedinput.js', array(), '9.0', true );
wp_enqueue_script( 'maskedinput' );

wp_register_script( 'sticky-kit', get_template_directory_uri().'/scripts/jquery.sticky-kit.js', array(), '9.0', true );
wp_enqueue_script( 'sticky-kit' );

if(is_single()) {
wp_register_script( 'j_rating', get_template_directory_uri().'/scripts/jquery.rating.js', array(), '1.0', true );
wp_enqueue_script( 'j_rating' );
	
wp_register_script( 'cloud_zoom', get_template_directory_uri().'/scripts/cloud-zoom.js', array(), '9.0', true );
wp_enqueue_script( 'cloud_zoom' );
} // if(is_single()) 
/* 
wp_register_script( 'jquery-boxloader', get_template_directory_uri().'/scripts/animation/jquery.boxloader.min.js', array(), '9.0', true );
wp_enqueue_script( 'jquery-boxloader' );
wp_register_script( 'wow-anime', get_template_directory_uri().'/scripts/animation/wow.min.js', array(), '9.0', true );
wp_enqueue_script( 'wow-anime' );
wp_enqueue_style( 'wow-animate', get_template_directory_uri().'/presentation/animate.css', array(), NULL ); 
wp_register_script( 'circular-bar', get_template_directory_uri().'/scripts/animation/circular-bar.js', array(), '9.0', true );
wp_enqueue_script( 'circular-bar' ); 
 */
}

add_action( 'wp_enqueue_scripts', 'add_my_scripts4', 0 ); ///// ??? priority 

function add_async_forscript($url) {
if ( !is_admin() and (strpos($url, '#async')!==false) ) {
	$url = str_replace('#async', '', $url)."' async='async"; 
}
	return $url;
}
add_filter('clean_url', 'add_async_forscript', 11, 1);





function samorano_short_content($content, $cutti_num) {
// $short_content_2 = preg_replace('`\[[^\]]*\]`', '', strip_tags($content)); // 
$short_content_2 = strip_shortcodes( strip_tags($content) ); // WP function "strip_shortcodes"
$charset = get_bloginfo('charset'); // $charset = 'UTF-8';
$short_content = mb_substr($short_content_2, 0, $cutti_num, $charset); 
$short_content = mb_substr($short_content, 0, mb_strripos($short_content, ' ', 0, $charset), $charset);
	return $short_content;
}



function add_admin_pages_columns_4() {
$p_types = array('page');
/// add_filter('manage_product_posts_columns', 'product_columns_head', 0);
foreach ($p_types as $p_type ) :  
 add_filter('manage_'.$p_type.'_posts_columns', 'page4_columns_head', 0);  
 add_action('manage_'.$p_type.'_posts_custom_column', 'page4_columns_content', 10, 2);
endforeach;
}
add_action('admin_init', 'add_admin_pages_columns_4');

function page4_columns_head($columns) { 
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'page_url' => __( 'Url' ),
		'date' => __( 'Date' )
	);    
	return $columns;  
}
function page4_columns_content($column_name, $post_ID) {  
	if ($column_name == 'page_url') {
		$post2 = get_post($post_ID);  $p_name = $post2->post_name;
		echo '<div class="page-'.$p_name.'"><strong>'.$p_name.'</strong></div>';	
	}	
}  



 /* Адмінка. Сторінки - показати excerpt */ 
add_action( 'init', 'excerpts_to_pages' );
function excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}



/* **** Пошук. Включити в рез-ти лише окремі post_types **** */
function GetSearchfTypes($query) {
    if ($query->is_search) {
        $args4 = array( 'public' => true, '_builtin' => false ); 
		$types_arr = get_post_types($args4);  $types_arr['post'] = 'post';
		unset($types_arr['wow_order'], $types_arr['c_form_order']);
		$query->set('post_type', $types_arr);
    }
return $query;
}
add_filter('pre_get_posts','GetSearchfTypes');


function samorano_search_by_title( $search, $wp_query ) { // only title in search 
    if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
        global $wpdb;
        $q = $wp_query->query_vars;
        $n = ! empty( $q['exact'] ) ? '' : '%';
        $search = array();
        foreach ( ( array ) $q['search_terms'] as $term ) {
     $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
		}
        if ( ! is_user_logged_in() ) { $search[] = "$wpdb->posts.post_password = ''"; }
        $search = ' AND ' . implode( ' AND ', $search );
    }
    return $search;
}
add_filter( 'posts_search', 'samorano_search_by_title', 10, 2 );



 

/// пагінація 
function wp_corenavi($query_2) {
  global $wp_query, $wp_rewrite;
  if($query_2) { $navi_query = $query_2; } else { $navi_query = $wp_query; }
  $max = $navi_query->max_num_pages;  
  $current = max( 1, get_query_var('paged') ); // if (!$current = get_query_var('paged')) { $current = 1; }
  // $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $big = 999999999;
$pagi_args = array(
	'base' => str_replace( array($big, '#038;'), array('%#%', '&'), esc_url(get_pagenum_link($big)) ),
	// 'format' => '?paged=%#%', // '/page/%#%' 
	'current' => $current,
	'total' => $max,
	// 'show_all' => false,
	'mid_size' => 3,
	'end_size' => 1,
	// 'prev_next' => true,
	'prev_text' => '<i class="ha ha-arrow ha-arrow-left"></i>',
	'next_text' => '<i class="ha ha-arrow ha-arrow-right"></i>',
);
$show_total = 1; // текст "Page 1 of 1", 1 - є, 0 - нема
  if ($max > 1) { 
  echo '<div class="navigation">';
  $pages = ''; if ($show_total == 1) { $pages = '<div class="pages">'. __('Page'). ' ' . $current . ' '.__('of').' ' . $max . '</div>'; }
  echo $pages . '<div class="pagi" id="pagi">' . paginate_links($pagi_args) . '</div>';
  echo '</div>';
  }
}


//////// breadcrumbs //////// //
require_once ( TEMPLATEPATH . '/lib/breadcrumbs.php' );



// Зачистити HEAD від зайвого 
    remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'feed_links', 2 );
	remove_action('wp_head', 'feed_links_extra', 3 );
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'parent_post_rel_link'); // prev link    
	remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	

 function remove_footer_admin_1 () {
	 return '<div class="foot_desc" style="text-align: right;"><a href="http://chili-web.com.ua" target="_blank">Chili-web</a> - website development</div>';
 } 
 add_filter('admin_footer_text', 'remove_footer_admin_1');
 
 function admin_footer_version() {	return ''; }
 add_filter( 'update_footer', 'admin_footer_version', 12);
 
 


/* *** disable XML-RPC in WordPress (pingbacks, ...) */
add_filter( 'xmlrpc_enabled', '__return_false' );  // stop all remote requests using XML-RPC
add_filter( 'wp_headers', 'samorano_remove_x_pingback' );  // hide xmlrpc.php in HTTP response headers
function samorano_remove_x_pingback( $headers ) {  
    unset( $headers['X-Pingback'] );
    return $headers;
}



 /* прибрати адмін бар з сайту (але не з адмінки) */
 add_filter('show_admin_bar', '__return_false');



/* Адмінка. Редагування публікації. Дерево категорій - зберегти норм. ієрархію */
add_filter( 'wp_terms_checklist_args', 'admin_cats_checklist_args' );
function admin_cats_checklist_args( $args ) {
		$args['checked_ontop'] = false;
		return $args;
}

// Адмінка. Галерея. Налаштування за замовчуванням 
function my_gallery_default_type_set_link( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
	$settings['galleryDefaults']['columns'] = 4;
    return $settings;
}
add_filter( 'media_view_settings', 'my_gallery_default_type_set_link');


function samorano_redirect_attachment() {
	if ( is_attachment() ) {
		global $post;
		$url_2 = '/404';  if($post->post_parent) { $url_2 = get_permalink($post->post_parent); }
		wp_safe_redirect( $url_2 );  exit;
	}
	if ( is_author() ) {
		$url_2 = '/404';  
		wp_safe_redirect( $url_2 );  exit;
	}
}
add_action( 'template_redirect', 'samorano_redirect_attachment' );




// Заборонити оновлення файлів локалізації 1
add_filter( 'auto_update_translation', '__return_false' );
// Заборонити оновлення файлів локалізації 2
add_action( 'upgrader_process_complete', function() {
	remove_action( 'upgrader_process_complete', array( 'Language_Pack_Upgrader', 'async_upgrade' ), 20 );
}, 1 );

 




// ** New fonts in visual editor and on site **
function v_editor_more_buttons($buttons) {
$buttons[]='fontselect';
$buttons[]='fontsizeselect';
return $buttons;
}
add_filter('mce_buttons_2', 'v_editor_more_buttons');

function samorano_editor_fonts($init) {
	$style_url_2 = get_template_directory_uri().'/presentation/fonts_2.css';
    if(empty($init['content_css'])) {  // 
        $init['content_css'] = $style_url_2;
    } else {
        $init['content_css'] = $init['content_css'].','.$style_url_2;
    }
$font_formats = isset($init['font_formats']) ? $init['font_formats'] : 'Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva';  //
$custom_fonts = ';'.'Open Sans=Open Sans;Roboto=Roboto';  // 
$init['font_formats'] = $font_formats . $custom_fonts;  // 
	return $init;
}
add_filter('tiny_mce_before_init', 'samorano_editor_fonts' );

function load_new_fonts_2() {
wp_enqueue_style( 'fonts_2', get_template_directory_uri().'/presentation/fonts_2.css', array(), NULL );
}
/// add_action('admin_enqueue_scripts', 'load_new_fonts_2');
add_action('wp_enqueue_scripts', 'load_new_fonts_2');
 


add_action('add_meta_boxes', 'add_besto_post_boxes');
function add_besto_post_boxes() {
$p_types = array('post', 'page'); // 'post', 'page' ....
foreach ($p_types as $p_type ) :  
 add_meta_box('in_main_slider', __('Show in main slider'), 'set_in_main_slider', $p_type, 'side', 'low');
// add_meta_box('in_bottom_slider', __('Show in bottom slider'), 'set_in_bottom_slider', $p_type, 'side', 'low');
 remove_meta_box('postcustom', $p_type, 'normal');
endforeach;
}

function set_in_main_slider() { 
	add_new_meta_checkboxi('show_in_main_slider'); 
}
// function set_in_bottom_slider() { add_new_meta_checkboxi('show_in_bottom_slider'); }

function add_new_meta_checkboxi($meta_key_1) {
	global $wpdb;
	global $post;
	// $meta_key_1 = 'show_in_main_slider';
	add_post_meta($post->ID, $meta_key_1, '', true);
	$post_meta_arr_1 = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key = '$meta_key_1'", ARRAY_A );
	$meta_input_id = $post_meta_arr_1['meta_id']; 
	$input_value = $post_meta_arr_1['meta_value'];
	
	$item_input_name = 'meta['.$meta_input_id.'][value]';
	$item_input_key = 'meta['.$meta_input_id.'][key]';

echo '<input type="hidden" name="'.$item_input_key.'" value="'.$meta_key_1.'" />';
echo '<input type="hidden" name="'.$item_input_name.'" value="0" />'; /// /// 
echo '<input type="checkbox" name="'.$item_input_name.'" id="bo_'.$meta_key_1.'" value="1"';
if ($input_value == 1) { echo ' checked="checked"'; }
echo '/>';
echo '<label for="bo_'.$meta_key_1.'"> '.__('Enable').' </label>';
echo '</br></br> <div>The Featured Image must be set !</div>';
}





/* Адмінка. Додати новий пункт налаштувань у розділ Settings (сторінка - reading) */
require_once ( TEMPLATEPATH . '/lib/admin_new_settings_4.php' );
// Нова сторінка налаштувань з динамічними опціями - розкоментувати рядок із кодом 'create_menu_5' у файлі /lib/admin_new_settings_4.php ;




define( 'E_SHOP_F', 0 ); // E_SHOP functionality // 0 - simple site, 1 - eshop, 2 - use only sessions (not orders)

define( 'WOW_DIRE', TEMPLATEPATH . '/lib/wow_e_shop/' ); 
require_once ( WOW_DIRE . 'wow_e_shop.php' );

/* // 1 simple site
include TEMPLATEPATH . '/lib/wow_functions_2/z_wow_product_list.php';
include TEMPLATEPATH . '/lib/wow_functions_2/z_wow_form_order.php';
include TEMPLATEPATH . '/lib/wow_functions_2/z_wow_cat_images.php';
 */


?>