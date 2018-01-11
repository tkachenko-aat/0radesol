<?php
/*
Template Name: Homepage Template
*/
?>

<?php get_header(); ?>



 
   


        
<div class="home_page no_column blog">

  



    
	<div class="content">	
   
   

 
<?php /* * Products sliders * */ ?>
<?php // include WOW_DIRE.'front_html_blocks/front_products_sliders.php'; /* wow_e_shop *** products_sliders *** */ ?> 

  







<?php 
/*
Адмінка. Редагувати секції. 
Кожна секція - це підсторінка головної сторінки. Можна додавати нові підсторінки, змінювати їх порядок. Якщо у верхньому меню потрібна якась інша назва сторінки, заповніть поле short_title (блок "Page. New fields").
Фоновий малюнок секції - головне зображення сторінки.


			 ____ wp-landing ____ 
	Папка з файлами для заміни: 1 tema-wp-landing  
front-page.php - замінити повністю 
header.php - замінити <div class="top_menu"> ... </div> 
			"<div class="page-content wrapper-cont">" - вилучити "wrapper-cont"
footer.php - розкоментувати javascript - (Landing page - scroll animation).
*/


/* *************** /////// Pages sections ////// ************** */

////// Special Urls //////
// home_blog
// kontakt
$parent_id = $post->ID;
	$pages_args = array(
	'post_type' => 'page',
	'post_parent' => $parent_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'post_status' => array('publish', 'draft')
);

    $query_pages_2 = new WP_Query($pages_args);
    if( $query_pages_2->have_posts() ) : 
		$num_5 = 0; 
?>    
    <div class="pages_sections"> 
          
        <?php while ($query_pages_2->have_posts()) : 
		$query_pages_2->the_post(); 
		global $more;  $more = 0;  // необхідно для тегу <!--more-->
			$num_5++; 
		$link = $post->post_name;
		?>   
 
 <div id="<?php echo $link ?>" class="section<?php if ( has_post_thumbnail() ) { ?> absolu<?php } ?>" style=" z-index: <?php echo (100 - $num_5); ?>;">
 <div class="inn">
 
    <?php if ( has_post_thumbnail() ) { ?> 
<div class="wide_fon_thumbnail" id="<?php echo $link ?>_main_section_bg"><div class="kub"><?php echo get_the_post_thumbnail(); // 'slider-img' ?></div></div>
	<?php // original image size must be correct ?>
	<?php } ?> 
 
 <div class="sect_inn">
 <div class="wrapper-cont sec">
 
 <div class="m_content maine">
 <div class="tit"> <h3><?php the_title(); ?></h3> </div>
 <?php if ( $post->post_excerpt ) { ?> <div class="addi_info"><?php the_excerpt(); ?></div> <?php } ?>
 <div class="entry-content"> <?php the_content(); ?> </div>
 </div>
 
 <?php if($link == 'about') : ?>
 
  
 
 
 <?php elseif($link == 'home_blog') : ?>


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
        'post_type'  => 'any',
		'posts_per_page'    => 8,
		// 'order' => 'DESC',	
		// 'orderby' => 'date',		
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
		global $more;  $more = 0;  // необхідно для тегу <!--more-->
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
          <?php $short_content = mb_substr(strip_tags(get_the_content()), 0, 200, 'utf-8'); ?>
          <div class="descr entry-content"> <?php echo $short_content; ?> </div>
 </div>
 </li> 
<?php endwhile; ?>
</ul>
</div>
</div>
<?php }  wp_reset_query(); ?>
<?php endforeach; ?>

<?php endif; // (count($cat_ids)) ?>





 
 
 <?php elseif($link == 'kontakt') : ?>
 
 
<div id="contacts_page" class="contact-form contact maine">  
<?php 
	$first_name = ''; $email = ''; $phone = '';
	if (is_user_logged_in()) {
	$current_user = wp_get_current_user();  $user_id = $current_user->id;
	$email = $current_user->user_email;
	$user_meta = get_user_meta($user_id);
	$first_name = $user_meta['first_name'][0]; 
	$phone = $user_meta['phone'][0];
	}
?>
<form name="contact_form" id="contact_form" enctype="multipart/form-data" action="<?php bloginfo('url'); echo '/contact-form-success/'; ?>" method="post">
<ul class="c_form fields">
<li> <label for="customer_name"><?php _e('Name') ?></label> <div class="box"><input type="text" name="customer_name" id="customer_name" class="required" placeholder="<?php _e('Name') ?>" title="<?php _e('Name') ?>" value="<?php echo $first_name ?>" /></div> </li>
<li> <label for="customer_phone"><?php _e('Phone') ?></label> <div class="box"><input type="text" name="customer_phone" id="customer_phone" placeholder="<?php _e('Phone') ?>" title="<?php _e('Phone') ?>" value="<?php echo $phone ?>" /></div> </li>
<li> <label for="customer_email"><?php _e('Email') ?></label> <div class="box"><input type="text" name="customer_email" id="customer_email" class="required" placeholder="<?php _e('Email') ?>" title="<?php _e('Email') ?>" value="<?php echo $email ?>" /></div> </li>
<li class="wide"> <label for="c_form_comment"><?php _e('Comment') ?></label> <div class="box"><textarea name="comment" id="c_form_comment" class="required" placeholder="<?php _e('Comment') ?>"></textarea></div> </li>
</ul>
<div class="but_line"><a class="button" onClick="do_contact_form('')"><span><?php _e('Submit') ?></span></a></div>
</form>


    </div>
 
 
 
 
 <?php else : ?>
 
 
<?php /* 1111111 */ ?>
 
 
 <?php endif; ?>
 
 </div>
 </div>
 
 </div>
 </div> <!-- section -->
        <?php endwhile; // ///////////////////////// ?>
   
        
        </div>  
        
        
 <?php /* ******* ************  */ /////////// ///////////////// ?>       
<?php endif; wp_reset_query(); ?> <?php ///////////  End sections  ///////////////// ?>

















  
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>  
   
    <div class="h_text wrapper-cont">
    <div class="home_text maine">
     
    <div class="page_title"> <h1><?php the_title(); ?></h1> </div>
	
	<?php if( get_the_content() ) { ?> <div class="entry-content"> <?php the_content(); ?> </div> <?php } ?>
    
    </div>    
    </div>
    
	<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	    
      
    
      
      
  

  
  
  
  
           
</div>    <!-- content -->  
	


 
 


</div> <!-- class="home_page blog" -->



<?php get_footer(); ?>