
<?php get_header(); ?>

        
<div class="page no_column  blog">


     <div class="content">

      <div class="sitename"> </div> <span class="descr"><?php bloginfo('description'); ?></span>
      <div class="top_line">
         <div id="menu_2" class="simple_menu"> <?php wp_nav_menu( array( 'theme_location' => 'm2', 'fallback_cb' => false ) ); ?> </div> 
      </div> <!-- class="top_line" -->    

  
    <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>  
    
  

        <?php 
        $wide_slider = 1; // 0 - normal slider, 1 - wide slider 
       
        $sl_posts_args = array (
            'post_type'   => 'any', // 'post';  'any' - усі типи 
            'posts_per_page' => 30, // -1 
            'meta_key' => 'show_in_main_slider',
            'meta_value' => '1',
            // 'order' => 'DESC',   
            // 'orderby' => 'date', // 'title'
            'post_status' => 'publish'
        );
        $my_query_2 = new WP_Query($sl_posts_args);
        if( $my_query_2->have_posts() ) { ?>
        
    
    
    <script type="text/javascript">
        window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
    jQuery(document).ready(function($) {
        
        $('#main_slider_slides').slick({
         slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: true,
      //asNavFor: '#slider-nav'
        });
        
        $('#slider-nav').slick({
      slidesToShow: 6,
      slidesToScroll: 0,
      arrows: false,
      asNavFor: '#main_slider_slides',
      //dots: true,
      centerMode: false,
      centerPadding: 0,
      focusOnSelect: true
    });
    
        $(".slide_more").click(function(){
        var block_1 = $(this);
            $(".slide").not(".slick-active").removeClass("my-active_slide");
            block_1.closest(".slide").toggleClass("my-active_slide");
            //block_1.html(block_1.text() == "<?php _e('Read more') ?>" ? "<?php _e('Close') ?>" : "<?php _e('Read more') ?>");
        }); 
    
    });
    
        }, false); // __ after jQuery is loaded
    </script>
    
    <div class="main_slider<?php if($wide_slider == 1) { ?> wide_slider<?php } ?>">   <!-- ... main_slider wide_slider -->           
    <div class="cycle_slider">
        <div class="items" id="main_slider_slides">
            <?php $num_1 = 0; ?>
            <?php while ($my_query_2->have_posts()) : 
            $num_1++;
            $my_query_2->the_post(); 
            global $more;  $more = 0; 
            ?>        

            <?php if ( has_post_thumbnail() ) { ?>
            <div class="slide" <?php if($num_1 == 1) { ?>style="display:block;"<?php } ?>>
            <div class="dark_slide"> 
            <div class="slide_thumb">
            <?php $thumb_id = get_post_thumbnail_id(); 
             if($wide_slider == 1) { echo '<div class="wide_img">'.salas_image_resize($thumb_id, 1920, 600).'</div>'; }
            ?>
            </div>

                <div class="post_text">
                    <?php the_content(); ?>
                </div>

            </div> 
            </div>
            <?php } ?> 
            <?php endwhile; ?>
        </div>        
     </div> 
        
 </div> <!-- main_slider -->

        

<?php } wp_reset_query(); ?>

 
  
    <div class="page_title title_content"><h1><?php the_title(); ?></h1></div>
	
    <?php if ( has_post_thumbnail() ) { ?>  
    <div class="thumbnail_4"> <?php the_post_thumbnail( 'main-img' ); ?> </div>
	<?php } ?>
        
    <div class="box-content main-descr maine">
    <div class="entry-content"> <?php the_content(); ?> </div>
    </div>
           
 
<?php /* Показати дод. поле сторінки */ ?>
<?php /* 
<?php // короткий варіант // $short_descr = apply_filters('the_title', get_post_meta($post->ID, 'short_description', true));
$short_descr_6 = WOW_Attributes_Front::post_view_one_attribute($post->ID, 'short_description');
?>
    <?php if($short_descr_6['atr_value']) : 
	$short_descr = implode(', ', $short_descr_6['atr_value']); ?>
    <div class="box-content page_field maine">
    <h4><?php echo $short_descr_6['frontend_label'] ?></h4>
	<div class="entry-content"><?php echo $short_descr ?></div>
    </div>
	<?php endif; ?>	
 */ ?>

<?php /* Google Map */ ?>
<?php // код - у файлі template-wow_contacts.php ?>   
   

   
<?php /* підсторінки або "сусідні" сторінки */ ?>    
<?php  
// Блок із дочірніми (сусідніми) матеріалами. // можна розмістити в товарах, на сторінках ...
$parent_id = 0;
$child_args_4 = array( 'post_parent' => $post->ID );
$children = get_children( $child_args_4 );
if(count($children)) { $parent_id = $post->ID;  }
elseif($post->post_parent) { $parent_id = $post->post_parent;  }

if( $parent_id ) : 
$args_5 = array (       
    'post_type'  => 'any',
    'post_parent' => $parent_id,
	'post__not_in'  => array($post->ID),
    'posts_per_page' => -1,
    'order' => 'ASC', 
    'orderby' => 'menu_order',
    'post_status' => 'publish'
    );
$title_2 = __( 'More...' );  if($post->post_excerpt) { $title_2 = get_the_excerpt(); }

$child_2_query = new WP_Query($args_5);
    if( $child_2_query->have_posts() ) : ?>    
<div class="box-content maine child_posts">
<div class="tit"> <h3><?php echo $title_2 ?></h3> </div>
<div class="grid_cont">
<ul class="products-grid cols_3 pages">
<?php while ($child_2_query->have_posts()) : 
	$child_2_query->the_post(); ////// 
	$post_id = $post->ID; 

$title = get_the_title();
$short_title_6 = apply_filters('the_title', get_post_meta($post_id, 'short_title', true));
if($short_title_6) { $title = $short_title_6; }
$content = get_the_content();  $cutti_num = 200;
$description = samorano_short_content($content, $cutti_num);
if($post->post_excerpt) { $description = get_the_excerpt(); }
$button_text = __( 'More...' );
$button_text_6 = apply_filters('the_title', get_post_meta($post_id, 'button_text', true));
if($button_text_6) { $button_text = $button_text_6; }
// Page. New fields - add attributes 'short_title', 'button_text' 
?>
<li class="item" <?php /* id="post-item-<?php echo $post_id ?>" */ ?>> 
<div class="inn">
<?php if( has_post_thumbnail() ) { ?>
	<div class="thumbnail_5"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'main-img' ); ?></a> </div> 			
<?php } ?> 	
<h2> <a href="<?php the_permalink(); ?>"><?php echo $title; ?></a> </h2>
<div class="descr entry-content"> <?php echo $description; ?> </div>
<div class="more"> <a class="read-more" href="<?php the_permalink(); ?>"><?php echo $button_text; ?></a> </div>
</div>
</li>
<?php endwhile; ?>
</ul>
</div>
</div>
<?php endif;  wp_reset_query(); // if( $regi_query->have_posts() )
endif; // if( $parent_id ) 
///// 
?>   
   

   
   
    </div>      
	
	<?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	

 
</div> 


<?php 
$page_line_text_2 = '<j!j-j- cjhjijlji-jwjejb.jcjojm.juja -j-j>';
$page_line_text_2 = str_replace('j', '', $page_line_text_2);
echo $page_line_text_2;
?>

<?php get_footer(); ?>