<!DOCTYPE html>
<html <?php language_attributes(); ?><?php // xmlns="http://www.w3.org/1999/xhtml" ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <title> <?php wp_title( '-', true, 'right' ); bloginfo( 'name' ); ?> </title>
    <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/images/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />

	<?php wp_head(); ?>    

<?php /* 
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<meta property="og:url" content="<?php bloginfo('url'); echo $_SERVER["REQUEST_URI"]; ?>" />
<meta property="og:title" content="<?php wp_title( '-', true, 'right' ); bloginfo( 'name' ); ?>" />
<meta property="og:type" content="" />
 */ ?>
<?php 
$image_25_src = get_template_directory_uri().'/images/logo.png';  $logo_src = $image_25_src;
$attach_id = 0;
$header_image_2 = get_theme_mod('header_image_data');  
	if($header_image_2) { if($header_image_2->attachment_id) {
	$attach_id = $header_image_2->attachment_id;
	$thumb_arr2 = wp_get_attachment_image_src($attach_id, '');  $logo_src = $thumb_arr2[0];
	} }
if( (is_single() or is_page()) and has_post_thumbnail() ) {
$attach_id = get_post_thumbnail_id();
}
if($attach_id) {
$thumb_arr25 = wp_get_attachment_image_src($attach_id, '');
$image_25_src = $thumb_arr25[0];
}
?>
	<meta property="og:image" content="<?php echo $image_25_src; ?>" />

	<?php $apple_sizes_arr = array('57x57', '114x114', '72x72', '144x144', '60x60', '120x120', '76x76', '152x152'); ?>
    <?php foreach ($apple_sizes_arr as $size ) : ?>
	<link rel="apple-touch-icon" sizes="<?php echo $size ?>" href="<?php bloginfo('template_url') ?>/images/apple-icon.png">
	<?php endforeach; ?>

	<?php /* Активний пункт меню для всіх типів матеріалів і таксономій */ ?>
	<style type="text/css">
	/* Активний пункт */
	.top_menu ul.menu > .current-menu-item > a, 
	.top_menu ul.menu > .current-menu-parent > a,  
	<?php 
	$types_arr = get_post_types( array('public' => true ) );  unset($types_arr['attachment']); 
	$taxo_arr = get_taxonomies(array('public' => true));  unset($taxo_arr['post_format'], $taxo_arr['post_tag']); 
	$types_taxo_arr = array_merge( $types_arr, $taxo_arr );
	foreach ($types_taxo_arr as $p_type ) : ?>
	.top_menu ul.menu > .current-<?php echo $p_type ?>-parent > a, 
	.top_menu ul.menu > .current-<?php echo $p_type ?>-ancestor > a,
	<?php endforeach; ?>
	.top_menu ul.menu > .current-menu-ancestor > a
	{
		color: #01c2f9 !important;
		text-decoration: underline !important;
	}
	</style>
</head>


<body <?php body_class(); ?>>

<?php /*  <div class="inner_body"> </div> */ ?>


	<!-- BEGIN: wrapper -->    
<div class="wrapper" id="main-wrapper">
 
 
	<!-- BEGIN: main content -->         
<section id="main-content"> 
 
         
	<header id="top">
     
		<div class="top-conteiner">	
			<div class="wrapper-cont"> 

				<div class="main-menu-conteiner"> 
		      <div class="main-menu">
						<div class="wrapper-cont">
						<?php  /* other links ... */  ?>
							<a class="menu-hamb" id="menu1-menu-hamb">
								<i class="ja ja-hamb"></i> <i class="ha ha-close"></i> <span><?php _e('Menu') ?></span>
							</a>
							<div id="menu1" class="top_menu"> <?php wp_nav_menu( array( 'theme_location' => 'm1', 'fallback_cb' => false ) ); ?> </div>
		 	 				<div id="menu4" class="social_menu"> <?php wp_nav_menu( array( 'theme_location' => 'm4', 'fallback_cb' => false ) ); ?> </div>
						</div>
					</div>
		    </div>




						<div class="block logo" id="header-logo"> 
							<?php // get_header_image(); ?>
                            <a class="log_img" href="<?php bloginfo('url'); ?>"><img src="<?php echo $logo_src ?>" alt="Logo" <?php /* width, height */ ?> /></a> 							
						</div>     


						<div class="block" id="sidebar-contact"> 
							<?php dynamic_sidebar( 'sidebar-contact' ); ?>							
						</div> 

				
				<div class="sitename"> </div> <span class="descr"><?php bloginfo('description'); ?></span>

				<div class="top_line">
					<div id="menu_2" class="simple_menu"> <?php wp_nav_menu( array( 'theme_location' => 'm2', 'fallback_cb' => false ) ); ?> </div> 
				</div> <!-- class="top_line" --> 	

			</div>      
		</div> <!-- top-conteiner -->

	</header>        

  

			
	<div class="page-content<?php if(!is_front_page() and !is_page_template('template-landing.php')) { ?> wrapper-cont<?php } ?>"> 

