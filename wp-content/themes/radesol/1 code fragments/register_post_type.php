<?php

function my_custom_types_in() {
	
register_post_type( 'fishki_2',
		array(
			'labels' => array(
				'name' => __( 'Fishki beate' ),
				'menu_name' => __( 'Fishki' ),
				'singular_name' => __( 'Fishka' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Fishka 1111' ),
				'edit_item' => __( 'Edit Fishka 1111' ),
			),			
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'comments' ),
			'public' => true,
			'show_in_menu' 	=> true,
			'menu_position' 	=> 5, 	
			'show_in_nav_menus' 	=> false,		
			'taxonomies' 			=> array( 'fishki_cats' ),
			/// 'rewrite' => array('slug' => 'product74', 'with_front' => false),
			'rewrite' 			=> true,
			// 'has_archive'			=> true,
			// 'exclude_from_search' 	=> true,	// !!!!	може викликати проблеми з показом категорій				
			// 'hierarchical' 			=> false,
			// 'menu_icon' 			=> $media_url4 . "icones/menu_icons42.png",
			// 'show_in_menu' 			=> 'edit.php?post_type=' . $post_type_7,
			// 'publicly_queryable' => false, // НЕ показувати на сайті (тільки в адмінці)		
		)
);

register_taxonomy('fishki_cats', array('fishki_2'), array(
			'labels' => array(
				'name' => __('Fishki categories'),
				'singular_name' => __('Fishki cat'),
				'menu_name' => __('Categories'),
				'edit_item' => __('Edit Fishki cat'),		
			),			
			'public' => true,	
			'hierarchical' => true,		
			'show_in_nav_menus' => true,
			'rewrite' => array('slug' => 'fishki_7', 'with_front' => false, 'hierarchical' => true),
			// 'rewrite' 			=> true,
));

}


// add_action( 'init', 'my_custom_types_in', 2 );



 