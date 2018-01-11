<?php
/*
Template Name: WOW compare-products
*/
?>

<?php WOW_Compare_Session::compare_add_product(); ?>
<?php WOW_Compare_Session::compare_remove(); ?>	


<?php get_header(); ?>

        
<div class="page compare no_column blog">

  
    
	 <div id="compare_page" class="content ajax_replace2_content">  

<?php //// no_feat_image 
$no_feat_image = '<img src="'.get_template_directory_uri().'/images/no_feat_image.png" class="no_feat" alt="no image" />'; 
$options_45 = get_option('site_media_settings_4'); $img_8_id = $options_45['no_feat_image_id']; 
if($img_8_id and wp_attachment_is_image($img_8_id)) { 
$no_feat_image = wp_get_attachment_image( $img_8_id, 'medium-img' ); 
}
?>
     
     <?php $po_arr = array_keys($_POST); 
	 if (in_array('comp_prod_id', $po_arr)) : 
	 $prod_last_id = $_POST['comp_prod_id'];
	 ?>
   	<div class="product_added">
    <div class="f_left">
    	<div class="prod-image">
<a class="product-image" title="<?php echo get_the_title($prod_last_id); ?>"><?php if ( has_post_thumbnail($prod_last_id) ) { echo get_the_post_thumbnail( $prod_last_id, 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a>
		</div>      	
    </div>
    <div class="f_right">
    <h3 class="product-name"><?php echo get_the_title($prod_last_id); ?></h3>
    <div class="added"><?php _e('The product has been added to compare list.') ?></div>
    <div class="button_line">
    <a onclick="show_compare()" class="button wide"><?php _e('Show compare list') ?></a>
    <a onclick="overlay_hide()" class="button wide"><?php _e('Continue shopping') ?></a>
    </div>
    </div>
    </div>
    
    <?php else : ?>
	 
	 
	 <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
   
 
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
   
    <div class="page_title title_content"> <h1><?php the_title(); ?></h1> </div>
    
    <div class="entry-content"> <?php the_content(); ?> </div>   
    
   <?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	  
  
    
    
    <div class="compare_products">  
    <?php $compare_array = WOW_Compare_Session::compare_array(); ?>
    
	<?php if(count($compare_array)) : ?>
    <?php $compare_attrib_all = WOW_Attributes_Front::post_compare_attributes(); // 
	$compare_attrib_2 = array_values($compare_attrib_all); $compare_atr_list2 = $compare_attrib_2[0];
	?>
  
    
<?php    
$slider_name = 'slider_compare';
// $slider_count = 3;
// $slider_scroll = 1;
// $slider_speed = 300;
?> 
<?php /* jquery  */ ?> <?php /* script jCarousel */ ?>

<script type="text/javascript">
<?php if(!in_array('popupp', $po_arr)) { ?> window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. <?php } ?> 
jQuery(document).ready(function($) {
        var slides_count = <?php echo count($compare_array); ?>;  var count_42 = 1;
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
});
<?php if(!in_array('popupp', $po_arr)) { ?> }, false); // __ after jQuery is loaded <?php } ?> 
</script>    
    
<div class="compare_table">

<div class="compare_left">

<div class="compare_subtitle">
<div class="inn">
<div class="s_top"> <a class="return_to compareee" onclick="overlay_hide()"><?php _e('Return to catalog') ?></a> </div>
<div class="numb_of"> <span><?php _e('Number of products') ?>:</span> <div class="tot"><?php echo count($compare_array); ?> </div>  </div>
<div class="bottom_line">
<a class="remove_all" onclick="remove_compare('all')"><span class="btn-remove"><i class="ha ha-close"></i></span> <span><?php _e('Delete all') ?></span> </a>
</div>
</div>
</div>

<div class="product-attributes"> 
<div class="at_title"> <h4><span><?php _e('Products characteristics') ?></span></h4> </div>
<div class="at_container">
<?php if(count($compare_attrib_all)) : ?>
<?php foreach($compare_atr_list2 as $attribute) { ?>
<div class="compare_attribut atr-<?php echo $attribute['code'] ?>"><?php echo $attribute['frontend_label'] ?> </div>
<?php } ?>
<?php endif; ?>
</div>
</div>

</div> <!-- compare_left -->


<div class="compare_main">

<div class="prod_collection compare hslider-container">
            
		<div class="<?php echo $slider_name; ?> horizontal-slider">          
<?php
$posts_args_3 = array (       
        'post_type'  => 'any',
		'post__in' => $compare_array,
		'posts_per_page'   => -1,
		'order' => 'ASC',	
		'orderby' => 'post__in',		
		'post_status' => 'publish'
    );

$compare_query = new WP_Query($posts_args_3);

    if( $compare_query->have_posts() ) { ?>
<ul>

<?php  while ($compare_query->have_posts()) : 
	$compare_query->the_post(); 
		// global $more;  $more = 0;  // необхідно для тегу <!--more-->
		$post_id = $post->ID;
?>
<li class="item">
             <div class="slider_lift">
             <div class="product-info">
  <a onclick="remove_compare('<?php echo $post_id ?>')" class="btn-remove btn-delete" title="<?php _e('Remove') ?>"> <i class="ha ha-close"></i> </a>
             <div class="prod-image">
 <a class="product-image" href="<?php the_permalink(); ?>" title="<?php // the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium-img' ); } else { echo '<div class="inn">'.$no_feat_image.'</div>'; } ?></a> 
			</div>
 <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    
                    <div class="actions">
		<?php $product_price = WOW_Attributes_Front::product_get_price(); ?>
        <div class="price-box"><?php echo $product_price ?></div>
                           
                    <?php $stock_2 = get_post_meta ($post_id, 'stock', true); ?>
					<?php if($stock_2 > 0 or $stock_2 == '') : ?>
      <?php $product_type = get_post_meta ($post_id, 'product_type', true); ?>
            <div class="addtocart"> <a <?php if($product_type == 'configurable') { ?>href="<?php the_permalink(); ?>"<?php } else { ?>onclick="addtocart('<?php echo $post_id ?>', '1')"<?php } ?> class="button btn-cart" ><?php _e('Add to cart') ?></a> </div>
                    <?php else: ?>
              <div class="availability out-of-stock"><span><?php _e('Out of stock') ?></span></div>
                    <?php endif; ?>
                    </div>
              </div>
               
               <div class="product-attributes">  
               <div class="top_space"> </div>
               <div class="at_container">     
               		<?php if(count($compare_attrib_all)) : ?>
			   <?php foreach($compare_attrib_all[$post_id] as $attribute): ?>              
               <div class="compare_attribut atr-<?php echo $attribute['code'] ?>">
       <span class="value"><?php $value = implode(", ", $attribute['atr_value']); echo $value; ?><?php if($attribute['frontend_unit']) { if($attribute['atr_value'][0] != '-') { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } } ?></span>			
               </div>
               <?php endforeach; // $compare_attrib_all[$id] ?>
               		<?php endif; ?>
               
               </div>           
               </div>
               
              </div>   <!-- slider_lift -->			
</li>
<?php endwhile; ?>

</ul>
<?php }  wp_reset_query(); ?>

		</div>

			<?php if (count($compare_array) > 1) : ?>
 <div class="hslider-nav hslider-prev <?php echo $slider_name; ?>"> <i class="ha ha-arrow ha-arrow-left"></i> </div>
 <div class="hslider-nav hslider-next <?php echo $slider_name; ?>"> <i class="ha ha-arrow ha-arrow-right"></i> </div>
            <?php endif; ?>
            
</div> <!-- prod_collection compare hslider-container -->

</div>


</div> <!-- compare_table -->

   
    
    
    
    
	<?php else : ?>
    <p class="no_items"><?php _e('You have no items to compare.') ?></p>
    <?php endif; // (!count($compare_array)) ?>
        
    
    </div> 
    
    <?php endif; // (!$_POST['comp_prod_id']) ?>   
	
    

    
               
    </div> <!-- contenta -->  
	






	<div style="display: none;">
	<?php include WOW_DIRE.'front_html_blocks/sidebar_compare.php'; /* * sidebar_compare * */ ?>
    </div>




<?php /* script 
function add_compare_sl_script() {
<?php $slider_name = 'slider_compare'; ?>
	var div_1 = document.getElementById("compare_page").getElementsByClassName('compare_main')[0];
	var compare_ul = div_1.getElementsByTagName("ul")[0];  var count_5 = compare_ul.children.length;
	var addto_script = document.createElement('script');
      addto_script.type = 'text/javascript';	
addto_script.text = 'jQuery(document).ready(function($) {  var slides_count = ' + count_5 + ';  var count_42 = 1;	var jcarousel = $(".<?php echo $slider_name; ?>.horizontal-slider");  jcarousel      .on("jcarousel:reload jcarousel:create", function () { var carousel = $(this), width = carousel.innerWidth(); if (width >= 750) { width = width / 4; count_42 = slides_count - 4; } else if (width >= 550) { width = width / 3; count_42 = slides_count - 3; } else if (width >= 320) { width = width / 2; count_42 = slides_count - 2; } carousel.jcarousel("items").css("width", Math.ceil(width) + "px");	if(count_42 <= 0) { jcarousel.parent().addClass("no_slide_navi"); }    })   .jcarousel({ wrap: "circular" });        $(".hslider-prev.<?php echo $slider_name; ?>").jcarouselControl({ target: "-=1" });  $(".hslider-next.<?php echo $slider_name; ?>").jcarouselControl({ target: "+=1" }); });';
     // addto_script.src = 'js/addtocart4.js'; 
	  div_1.appendChild(addto_script); 	
}
*/ ?>



     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>