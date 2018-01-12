<?php
/*
Template Name: Homepage Template
*/
?>

<?php get_header(); ?>



<?php /* /1 code fragments/promo-screen.php /// 
Заставка при 1-му відкриванні сайту. */ ?>



   <div id="home_sidebar" class="wrapper-cont"> 

<?php /* Великий слайдер (з ефектом Touch-Swipe). Можна вибрати тип слайдера. */
	///////////////  /////////////// 
$slider_type = 0; // 0 - normal slider, 1 - wide slider, 2 - text slider 
/* 
wide slider must be placed in full width container, NOT inside .wrapper-cont. So you need to remove ".wrapper-cont" from div id="home_sidebar" ; 
 */ 
$class_7 = ' img_slider';
if($slider_type == 1) { $class_7 = ' img_slider wide_slider'; }
elseif($slider_type == 2) { $class_7 = ' text_slider'; }
	///////////////  /////////////// 	
	$sl_posts_args = array (
		'post_type'   => 'any', // 'post';  'any' - усі типи 
		'posts_per_page' => 5, // -1 
		'meta_key' => 'show_in_main_slider',
		'meta_value' => '1',
		// 'order' => 'DESC',	
		// 'orderby' => 'date', // 'title'
		'post_status' => 'publish'
    );
    $my_query_2 = new WP_Query($sl_posts_args);
    if( $my_query_2->have_posts() ) { ?>
<div class="main_slider<?php echo $class_7 ?>"> 
<?php // http://kenwheeler.github.io/slick  ?>
<script type="text/javascript">
// need touch-slick.js  
	window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
jQuery(document).ready(function($) {
	$('#main_slider_slides').slick({
		speed: 700,
		autoplay: true,
		autoplaySpeed: 3500,
		// infinite: true,
		// slidesToShow: 1,
		// slidesToScroll: 1,
		// arrows: true,
		dots: true
	});

	// $(".slide.slick-cloned .slide_thumb .s_video").empty(); // зачистка відео у слайдах-клонах
<?php /* /1 code fragments/slider_full_screen-js.php /// 
слайди на всю площу екрану. вирівнювання слайда по вертикалі */ ?>

});
    }, false); // __ after jQuery is loaded
</script>
<?php /* 
	<?php $title_6 = WOW_Attributes_Front::post_view_one_attribute($post->ID, 'slider_title'); ?>
    <?php if($title_6['atr_value']) : 
	$title = implode(', ', $title_6['atr_value']); ?>
    <div class="title"><?php echo $title ?></div>    
	<?php endif; ?> 
 */ ?>            
	<div class="cycle_slider">
        <div class="items" id="main_slider_slides">
        <?php $num_1 = 0; ?>
		<?php while ($my_query_2->have_posts()) : 
			$num_1++;
		$my_query_2->the_post(); 
		global $more;  $more = 0;  // необхідно для тегу <!--more-->
		$video_slide = 0;  $class_4 = '';
		// if ( $post->post_excerpt ) { $video_slide = 1;  $class_4 = ' video_slide'; }
		?>        
<?php if ( has_post_thumbnail() ) : ?>
 <div class="slide<?php echo $class_4; ?>" <?php if($num_1 == 1) { ?>style="display:block;"<?php } ?>> 
 <div class="slide_thumb">
 <div class="inn">
							 <?php if ( $video_slide == 1 ) : ?>
                             <div class="s_video"> <?php the_excerpt(); // video ?> </div>
                             <?php endif; ?> 
 <a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { 
 if($slider_type == 2) { the_post_thumbnail('main-img'); }
 else {
 /* !!!! function salas_image_resize */
 $thumb_id = get_post_thumbnail_id(); 
 echo '<div class="image">'.salas_image_resize($thumb_id, 1200, 350).'</div>';
 echo '<div class="small_img">'.salas_image_resize($thumb_id, 500, 400).'</div>';
 // the_post_thumbnail('slider-img'); 
 if($slider_type == 1) { echo '<div class="wide_img">'.salas_image_resize($thumb_id, 2600, 350).'</div>'; }
 } 
 } ?></a> 
 </div> 
 </div>
 <div class="post_text"> 
  <h3> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3> 
 <?php if($slider_type == 2) {   $content = get_the_content();  $cutti_num = 800; ?> 
 <div class="entry-content"><?php echo samorano_short_content($content, $cutti_num); ?></div> <div class="button_line"><a class="button read_more" href="<?php the_permalink(); ?>"><?php _e('More...') ?></a></div> 
 <?php } ?>
 </div> 
 </div> 
<?php endif; ?> 
        <?php endwhile; ?>
        </div>        
        <?php // if($my_query_2->post_count > 1) { } ?> 
        </div>    
</div>
<?php } wp_reset_query(); ?>

   </div>  
   
   
   
   
<div class="home_page wrapper-cont"> 

<div class="page no_column blog"> 

   <?php /* 
    <?php // Лівий сайдбар ?>
    <?php include 'column-left.php'; ?>
     */ ?> 
     
     
    
	<div class="content">	
   
   

 
<?php /* * Products sliders * */ ?>
<?php // include WOW_DIRE.'front_html_blocks/front_products_sliders.php'; /* wow_e_shop *** products_sliders *** */ ?> 
<?php /* find selectors: .link_advanc , .box-content .tit .view_all . You can remove "display: none;" */ ?>
  




<?php /* **** Блок "Вибрані категорії" (з підкатегоріями, малюнками) вивести за допомогою звичайного меню на позиції 'm_home_feature' **** */ ?>
<?php $menu_home_name = 'm_home_feature';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_home_name] ) ) : 
	$menu_5 = wp_get_nav_menu_object( $locations[$menu_home_name] );
	$menu_items = wp_get_nav_menu_items($menu_5->term_id);
	// print_r($menu_items); 
$line_5_count = 4;
$num_5 = 0;
?>
<div class="box-content home_cats maine"> <?php /* box-content home_cats wrapper-cont */ ?>
<ul class="child_cats">
<?php foreach ($menu_items as $item) : ?>
<?php $num_5++; 
$obj_id = $item->object_id;
$class_2 = '';
	$item_main_img = '';
	if($item->type == 'taxonomy') {  $term_5 = get_term_by('id', $obj_id, $item->object); 
		$term_5_id = $term_5->term_id;  $taxonomy = $term_5->taxonomy;
	if($term_5->term_thumbnail) { $item_main_img = wp_get_attachment_image( $term_5->term_thumbnail, 'medium-img' ); } 
	 } elseif($item->type == 'post_type') { 
	 $class_2 = ' page_item';
	 if (has_post_thumbnail($obj_id)) { $item_main_img = get_the_post_thumbnail( $obj_id, 'medium-img' ); } 
	 }
?>  
    <li class="cat<?php echo $class_2 ?>" id="m_item-<?php echo $item->ID ?>">
    <a href="<?php echo $item->url ?>" class="tooltip_bot" title="<?php echo $item->title ?>">
    <?php if($item_main_img) { ?><div class="cat_image"><?php echo $item_main_img; ?></div><?php } ?>
    <div class="cat_tit"><h2><?php echo $item->title ?></h2></div>
    </a>
<?php if($item->type == 'taxonomy') : 
$child_terms_2 = get_terms( $taxonomy, array('parent' => $term_5_id, 'hide_empty' => false) ); ?>
<?php if(count($child_terms_2)) : ?>
<ul class="level_1">
<?php foreach ($child_terms_2 as $cat_2) { ?>
<li><a href="<?php echo get_term_link($cat_2) ?>"><?php echo $cat_2->name ?></a></li>
<?php } ?>
</ul>
<?php endif; // ($child_terms_2) 
endif; // ($item->type == 'taxonomy') ?> 
    </li>
<?php endforeach; ?>
</ul>
</div>	   
<?php endif; // isset( $locations[ $menu_home_name ] ) ?>







<?php /* /1 code fragments/home_prod_categories.php /// 
Блок "Категорії з товарами" вивести за допомогою звичайного меню на позиції 'm_home_prod_categories' */ ?>






<?php /* **** **** Типовий блок 
Блок, що показує інформацію з декількох текстових сторінок (підсторінок сторінки 'about')
 **** */ ?> 
<?php  
	$page_2 = get_page_by_path('about');
	$title_2 = apply_filters('the_title', get_post_field('post_title', $page_2));
	$text_2_ex = apply_filters('the_excerpt', get_post_field('post_excerpt', $page_2));
	$text_2 = apply_filters('the_content', get_post_field('post_content', $page_2));
$parent_id = 0;
$child_args_4 = array( 'post_parent' => $page_2->ID );  $children = get_children( $child_args_4 );
if(count($children)) { $parent_id = $page_2->ID;  }

if( $parent_id ) : 
$pages_args_2 = array (       
    'post_type'  => 'any', // 'page' 
    'post_parent' => $parent_id,
    'posts_per_page' => -1,
    'order' => 'ASC', 
    'orderby' => 'menu_order',
    'post_status' => array('publish', 'draft')
);
$pages_2_query = new WP_Query($pages_args_2);
    if( $pages_2_query->have_posts() ) : ?>  
      
<div class="box-content animation-box maine about_info">
<div class="tit"> <h3><?php echo $title_2 ?></h3> </div>
<?php if($text_2_ex) { ?><div class="tit main-text"> <?php echo $text_2_ex ?> </div><?php } ?>
<div class="grid_cont">
<ul class="products-grid cols_3 pages">
<?php $i = 0;
	while ($pages_2_query->have_posts()) : 
	$pages_2_query->the_post(); ////// 
	$post_id = $post->ID; 
	
	$i++;
	 $class_5 = 'anime-left';
	 if(round($i/3) == ($i/3) or round($i/4) == ($i/4)) { $class_5 = 'anime-right'; } 	

$title = get_the_title();
$short_title_6 = apply_filters('the_title', get_post_meta($post_id, 'short_title', true));
if($short_title_6) { $title = $short_title_6; }
$content = get_the_content();  $cutti_num = 200;
$description = samorano_short_content($content, $cutti_num);
if($post->post_excerpt) { $description = get_the_excerpt(); }
$button_text = __( 'More...' );
$button_text_6 = apply_filters('the_title', get_post_meta($post_id, 'button_text', true));
if($button_text_6) { $button_text = $button_text_6; }
$post_link = get_the_permalink();
$post_link_6 = get_post_meta($post_id, 'page_link', true);
if($post_link_6) { 
if(strpos($post_link_6, 'http') !== 0 and $post_link_6[0] != '#') { $post_link_6 = get_bloginfo('url').$post_link_6; }	
$post_link = $post_link_6; 
}
// Page. New fields - add attributes 'short_title', 'button_text', 'page_link' 
?>
<li class="item <?php echo $class_5 ?>" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>> 
<div class="inn">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php echo $post_link ?>"><?php the_post_thumbnail( 'main-img' ); ?></a> </div> 			
<?php } ?> 	
<h2> <a href="<?php echo $post_link ?>"><?php echo $title; ?></a> </h2>
<div class="descr entry-content"> <?php echo $description; ?> </div>
<div class="more"> <a class="read-more" href="<?php echo $post_link ?>"><?php echo $button_text; ?></a> </div>
</div>
</li>
<?php endwhile; ?>
</ul>
</div>
</div>
<?php endif;  wp_reset_query(); // if( $regi_query->have_posts() )
endif; // if( $parent_id ) 
?>   


  

<?php /* **** **** Типовий блок 
вивести матеріали (публікації), вибрані за певними параметрами, у вигляді звичайної сітки ("grid"); у даному прикладі - матеріали із певних категорій 'category' (відомі id цих категорій)
 **** */ ?>
<?php
$options4 = get_option('site_add_settings_4');
$cat_ids_2 = $options4['home_blog_cat_ids']; // Блог
$cat_ids = explode(',', $cat_ids_2);
$taxonomy = 'category';
if(count($cat_ids)) : 
?>

<?php foreach($cat_ids as $cat_id) : ?>
<?php 
$term_id = (int) $cat_id;  if(term_exists($term_id, $taxonomy)) { // if tax_query
$term2 = get_term($cat_id, $taxonomy);
$cat_title = $term2->name;  $cat_slug = $term2->slug;  $cat_link = get_term_link($term2);
} // if tax_query 
$posts_args_2 = array (       
        'post_type'  => 'any', // 'fishki89', 'post';  'any' - усі типи  
		'posts_per_page'    => 8,
		// 'order' => 'DESC',	
		// 'orderby' => 'date', // 'title', 'date', 'modified', 'comment_count', 'menu_order' /// 'meta_value_num' 
		/// 'meta_key' => 'views', // if use 'orderby' => 'meta_value_num'
		'tax_query' => array(
			array (
			'taxonomy' => $taxonomy, // 'category'
			// 'field' => 'term_id', // 'slug'
			'terms' => $cat_id // 'my-slug2'
			)
		), 
		'post_status' => 'publish'
    );

$query_2 = new WP_Query($posts_args_2);

    if( $query_2->have_posts() ) { ?>
<div class="box-content maine home_blog <?php echo $cat_slug ?>">
<div class="tit"> <h3><a href="<?php echo $cat_link ?>"><?php echo $cat_title ?></a></h3> </div>
<div class="grid_cont">
<ul class="products-grid cols_4 blog-list">
<?php	
	while ($query_2->have_posts()) : 
	$query_2->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
	$post_id = $post->ID;
?>  
 <li class="item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>>
 <div class="inn">
	<header>
  <h2> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>     
	<time datetime="<?php the_time( 'Y-m-d' ); ?>"> <?php the_time( 'j.m.Y' ); ?> </time>
    </header>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium-img' ); ?></a> </div> 			
<?php } ?> 			
<?php $content = get_the_content();  $cutti_num = 140; ?>
     <div class="descr entry-content"> <?php echo samorano_short_content($content, $cutti_num); ?> </div>
 </div>
 </li> 
<?php endwhile; ?>
</ul>
</div>
</div>
<?php }  wp_reset_query(); ?>
<?php endforeach; ?>

<?php endif; // (count($cat_ids)) ?>






  
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>  
   
     <div class="home_text maine">
     
    <div class="page_title"> <h1><?php the_title(); ?></h1> </div>
	
	<?php if( get_the_content() ) { ?> <div class="entry-content"> <?php the_content(); ?> </div> <?php } ?>
    
    </div>    
    
	<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	    
      
    
      
      
      
  

<?php /* **** **** Типовий блок 
вивести матеріали (публікації), вибрані за певними параметрами, у вигляді слайдера ("jCarousel"); 
 **** */ ?>
<?php 
	$fishki_args = array (
		'post_type'   => 'post', // 'fishki89', 'post';  'any' - усі типи 
		'posts_per_page' => 30, // -1
		'order' => 'ASC',	
		'orderby' => 'title', // 'title', 'date', 'modified', 'comment_count', 'menu_order' /// 'meta_value_num' 
		/// 'meta_key' => 'views', // if use 'orderby' => 'meta_value_num' 
		'post_status' => 'publish'
    );
    $my_query_3 = new WP_Query($fishki_args); 
if( $my_query_3->have_posts() ) : ?>
<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'medium-img' ); 
}
?>
<div class="box-content co_home_fishki"> 
<?php /* <div class="tit"> <h3><?php _e('Recent posts') ?></h3> </div> */ ?>
<?php $slider_name = 'home_fishki'; ?>
<?php /* jquery  */ ?> <?php /* script jCarousel */ ?>
    
	<div class="hslider-container">   
<script type="text/javascript">
	window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
jQuery(document).ready(function($) {
        var slides_count = <?php echo $my_query_3->post_count; ?>;  var count_42 = 1;
		var jcarousel = $('.<?php echo $slider_name; ?>.horizontal-slider');
        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();
                if (width >= 750) { width = width / 4; count_42 = slides_count - 4; } 
				else if (width >= 550) { width = width / 3; count_42 = slides_count - 3; }
                else if (width >= 320) { width = width / 2; count_42 = slides_count - 2; }
                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
				if(count_42 <= 0) { jcarousel.parent().addClass("no_slide_navi"); }
            })
            .jcarousel({ wrap: 'circular' });

        $('.hslider-prev.<?php echo $slider_name; ?>').jcarouselControl({ target: '-=1' });
        $('.hslider-next.<?php echo $slider_name; ?>').jcarouselControl({ target: '+=1' });

        $('.controls.<?php echo $slider_name; ?>')
            .on('jcarouselpagination:active', 'a', function() { $(this).addClass('activeSlide'); })
            .on('jcarouselpagination:inactive', 'a', function() { $(this).removeClass('activeSlide'); })
            .on('click', function(e) { e.preventDefault(); })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) { return '<a href="#' + page + '">' + page + '</a>'; }
            });
});
    }, false); // __ after jQuery is loaded 
</script>  
            
   		<div class="<?php echo $slider_name; ?> horizontal-slider">		
            <ul>
				<?php while ($my_query_3->have_posts()) : 
				$my_query_3->the_post(); 	
				$post_id = $post->ID; 	
				// global $more;  $more = 0;  // необхідно для тегу <!--more--> ?>
					<li class="item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>>
                    <div class="slider_lift">                        
           <div class="prod-image">
	<a class="product-image" href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a> 					
           </div>
	<h5 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>	
	<?php $content = get_the_content();  $cutti_num = 200; ?>
    <div class="descr entry-content"> <?php echo samorano_short_content($content, $cutti_num); ?> </div>
	<div class="product_info atr_table">
	<?php $post_id = $post->ID;
  // include WOW_DIRE.'front_html_blocks/attributes.php'; /* wow_e_shop *** attributes *** */ ?>
	</div> 
    				</div>
					</li>                    
				<?php endwhile; // ?>
			</ul>
		</div>   

    <?php if ($my_query_3->post_count > 1) : ?>
 <div class="hslider-nav hslider-prev <?php echo $slider_name; ?>"> <i class="ha ha-arrow ha-arrow-left"></i> </div>
 <div class="hslider-nav hslider-next <?php echo $slider_name; ?>"> <i class="ha ha-arrow ha-arrow-right"></i> </div>
<?php /* <i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-right"></i> */ ?>
            
            <div class="controls <?php echo $slider_name ?>"> </div>
    <?php endif; ?>       
	</div> 
   
</div>
<?php endif;  wp_reset_query(); ?> 






<?php /* **** **** Типовий блок 
Зображення (іконки) + текст, без посилань на які-небудь сторінки. Це можна використати для блоків типу "Наші переваги", "Чому обирають нас".
В адмінці це реалізовано як галерея зображень на головній стор. (або іншій стор.) в полі 'excerpt'.
 **** */ ?>
<?php 
/* 
	$page_4 = get_page_by_path('about-advantages');
	$title_4 = apply_filters('the_title', get_post_field('post_title', $page_4));
	$text_4_ex = apply_filters('the_excerpt', get_post_field('post_excerpt', $page_4));
	$text_4 = apply_filters('the_content', get_post_field('post_content', $page_4));
 */	
// $secto_title = $title_4;
$secto_title = apply_filters('the_title', get_post_meta($post->ID, 'advantages_title', true));
// $excerpt_1 = get_post_field( 'post_excerpt', $page_4 );
$excerpt_1 = get_post_field( 'post_excerpt', $post ); // 'excerpt' in homepage
$ids_11 = explode('ids="', $excerpt_1); 
if(count($ids_11) > 1) { $ids_2 = $ids_11[1]; $ids_3 = explode('"', $ids_2); $ids_4 = $ids_3[0]; 
$adv_images = explode(',', $ids_4); }

if(count($adv_images)) : ?>
<div class="box-content maine advantages">
<div class="tit"> <h4><?php echo $secto_title ?></h4> </div>
<div class="grid_cont">
<ul class="products-grid cols_3 icons container">
<?php foreach($adv_images as $img_id) { 
$img_ss_full = wp_get_attachment_image_src($img_id, '');  $img_ss_med = wp_get_attachment_image_src($img_id, 'thumbnail');  // 
$img_title = get_the_title($img_id);
$excerpt8 = get_post_field('post_excerpt', $img_id);
if($excerpt8) { $img_title = get_the_excerpt($img_id); } // apply_filters('the_excerpt', $excerpt8);
$img_descr = '';
$descr8 = get_post_field('post_content', $img_id);
if($descr8) { $img_descr = apply_filters('the_content', $descr8); }
$item_id = 'adv_img-'.$img_id;
?>
<li class="item" id="<?php echo $item_id ?>"> <div class="inn"> 
<?php /* <div data-wow-iteration="4" data-wow-duration="0.3s" data-wow-delay="0.5s" class="inn wow pulse<?php // pulse, rollIn, bounce, bounceInUp, bounceInDown, bounceInRight, bounceInLeft, lightSpeedIn, flip, flipInX, shake, swing  ?>"> */ ?>
<div class="image"> 
<?php echo wp_get_attachment_image( $img_id, 'medium-img' ) // 'thumbnail' ?>
<?php /* <div class="bg_image" style="background-image:url(<?php echo $img_ss_med[0] ?>);"></div> /// for small icons with different sizes */ ?>
</div>
<div class="conte">
<div class="title"><?php echo $img_title ?></div>
<?php if($img_descr) { ?><div class="img_descr"><?php echo $img_descr ?></div><?php } ?>
</div>
</div> </li>
<?php } // foreach($adv_images as $img_id) ?>
</ul>
</div>

</div>
<?php endif; // (count($adv_images)) ?>




  

<?php /* /1 code fragments/settings_dynamic_options_front.php /// 
Показати налаштування (з динамічними опціями), що розміщені в адмінці на стор. "Settings 5". */ ?>

    
  
           
</div>    <!-- content -->  
	


</div> 

</div> <!-- class="home_page" --> 








    
<?php /* 

** Інтернет-магазин **
Для включення функцій інтернет-магазину у файлі functions.php знайти глобальну змінну 'E_SHOP_F' і присвоїти їй значення "1".
Також для включення всіх функцій необхідно розкоментувати деякі рядки у таких файлах:
- front-page.php – рядок із фрагментом «front_products_sliders.php»;
- template-wow_success.php – 2 рядки із фрагментами «WOW_Checkout::pay_online» , «WOW_Checkout::pay_online_success»

Файли для окремої стор. і категорії типу "fishki" (taxonomy - "fishki-cat")
single-fishki.php 
taxonomy-fishki-cat.php

Нові шрифти (google-fonts) у віз. редакторі і на сайті. functions.php . Розкоментувати блок "New fonts in visual editor and on site"

Multi Post Thumbnails. functions.php . Розкоментувати блок "Multi Post Thumbnails"

General Categories (категорії, які охоплюють усі типи товарів). 
Файл /lib/wow_e_shop/ wow_e_shop.php - знайти текст "!!!! General Categories". Замість "0" написати "1"

Необхідно показати звичайні категорії 'category' у режимі "grid" або виводити список підкатегорій активної категорії ? Скопіюйте файл index.php і назвіть його category.php, попередньо вилучивши старий файл category.php. В новому файлі можна видалити все зайве та робити інші зміни.

Папки "1 code fragments", "1 tema-wp-landing" - можна видаляти, коли основна робота закінчена 

*** Доступний функціонал:
- Слайдер з ефектом "touch screen". Доступні 3 режими показу слайдера. (файл front-page.php)
- Infinite Scroll, load more items (коментарі в index.php, поруч із 'wp_corenavi').
- анімаційні ефекти при скролінгу, динамічна лінійна чи кругова діаграма (коментарі в footer.php - 'animation with jquery-boxloader', 'animation with wow script', '/1 code fragments/progress-bars.php').
- галерея в режимі Cloud Zoom.
- Quick order mode (without cart).
- Add to cart flying effect.
- Адмінка. Копіювання товару (Duplicate item).
- Конфігурований товар. Оновлення ціни, тексту, малюнків товару при виборі опцій. Режим "таблиця цін" (увімкнути в коді).
- "Згрупований" товар (товар складається по частинах)
- Нові поля сторінки (на базі наявних атрибутів)
- Гугл-карта зі зручним вибором точки/адреси в адмінці, зміною стилю (фон, колір).
- Бокове меню з виїжджаючими підпунктами - додайте стандартне меню з підпунктами у ліву чи праву колонку.
- Нова сторінка налаштувань з динамічними опціями - розкоментувати рядок із кодом 'create_menu_5' у файлі /lib/admin_new_settings_4.php ;



****	   ____ wp-landing ____     ****
	Папка з файлами для заміни: 1 tema-wp-landing  
front-page.php - замінити повністю 
header.php - замінити <div class="top_menu"> ... </div> 
			"<div class="page-content wrapper-cont">" - вилучити "wrapper-cont"
footer.php - розкоментувати javascript - (Landing page - scroll animation).



// global $wp_session;
// echo get_bloginfo('url');

** Красивий чекбокс і радіо: class - fine_checkbox, fine_radio  

[:ua]Місто[:ru]Город[:en]City[:]
Старий:  <!--:ua-->Місто<!--:--><!--:en-->City<!--:-->
		 переклад для bloginfo('description'), widget_title :  [:ua]Місто[:en]City

if ( is_front_page() )
if ( is_single() )
if ( is_archive() )

.csv файли у папці теми (attributes.csv, ...). 
Як розділювач використовувати символ ";" . 2-й розділювач - порожній (без жодних символів)

*/ ?>



<?php /* 

Проблема з активним пунктом меню, якщо для товарів включений параметр 'hierarchical' => true,
/wp-includes/nav-menu-template.php
знайти першу умову " ! is_post_type_hierarchical() " і вилучити цю частину умови



Показати малюнки в пунктах меню. файл /wp-includes/ nav-menu-template.php

** перед рядком "$item_output = $args->before;" вставити код:
///// menu images /////
$item_img = '';
if($depth == 1) : /// set the depth: 0, 1, 2, ...
if($item->type == 'taxonomy') { 
$tax_7 = get_term_by('id', $item->object_id, $item->object); 
if($tax_7->term_thumbnail) { $item_img = wp_get_attachment_image( $tax_7->term_thumbnail, 'thumbnail' ); } 
} elseif($item->type == 'post_type') { 
if ( has_post_thumbnail($item->object_id) ) { $item_img = get_the_post_thumbnail( $item->object_id, 'thumbnail' ); } 
}
endif;

** блок "$item_output = $args->before; .... $item_output .= $args->after;" замінити на: 
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $item_img; ///// menu images /////
		$item_output .= $args->link_before . '<span>'.$title.'</span>' . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
 */ ?>








<?php get_footer(); ?>