<?php
/*
Template Name: WOW contacts
*/
?>


<?php get_header(); ?>

        
<div class="page contacts blog">


    <?php // Лівий сайдбар ?>
    <?php include 'column-left.php'; ?>

     
    
    <div class="content ajax_replace2_content">
      
     <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>
   
   
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
  
    <div class="page_title title_content"> <h1><?php the_title(); ?></h1> </div>
    
   <div class="box-content conte maine">
    <div class="entry-content"> <?php the_content(); ?> </div>
   </div>
    
   <?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	    


    <?php $map_meta_key = 'location_map'; // Google Map ?>
	<?php if(get_post_meta($post->ID, $map_meta_key, true)) : 
 $options4 = get_option('site_add_settings_4');  $map_api = $options4['my_google_map_api'];
if(!$map_api) { $map_api = 'AIzaSyB26HqhWs5_arfnhGuRbUBh4limZ7PCRy8'; } ?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $map_api ?>&libraries=places"></script>
	<?php endif; // __ Google Map ?>
    

	<?php /* Google Map */   // $map_meta_key = 'location_map'; ?>
    <?php if(get_post_meta($post->ID, $map_meta_key, true)) : // $post_id / $post_id_gen 
$map_field = get_post_meta($post->ID, $map_meta_key, true);
$map_coords_2 = explode('||', $map_field);
$map_coords = array('address' => $map_coords_2[2], 'lat' => $map_coords_2[0], 'lng' => $map_coords_2[1]);
$map_title_1 = get_the_title(); /// 
	?>
<div class="box-content my_map">
<div class="tit map_title"> <span><?php echo $map_coords['address']; ?></span> </div>
<div id="my_<?php echo $map_meta_key.'-'.$post->ID; ?>" style="width: 100%; height: 400px;"></div>
<script type="text/javascript">
<?php /* /1 code fragments/google_map-style.php /// 
map styling (color, background) - insert code here */ ?>
function map_load_<?php echo $map_meta_key.'_'.$post->ID; ?>() {
	var lat = <?php echo $map_coords['lat']; ?>;
	var lng = <?php echo $map_coords['lng']; ?>;
	var latlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
		zoom: 14,
		center: latlng,
		// disableDefaultUI: true,
		// scrollwheel: false, 
		// styles: style_m_1, // ___ if we use styles 
		//// mapTypeId: google.maps.MapTypeId.ROADMAP // 
   };
	var map = new google.maps.Map(document.getElementById("my_<?php echo $map_meta_key.'-'.$post->ID; ?>"), myOptions);
	/*  var map_style_1 = new google.maps.StyledMapType( style_m_1, {name: 'Styled Map 1'} );
	 map.mapTypes.set('my_styled_map', map_style_1);  map.setMapTypeId('my_styled_map'); */
	var marker = new google.maps.Marker({
		map: map,
		position: map.getCenter(),
		// title: '<?php echo $map_title_1 ?>',
		// icon: new google.maps.MarkerImage("<?php echo get_template_directory_uri().'/images/icon-map-pin.svg'; ?>"),		
   });
			var map_title_1 = "<b><?php echo $map_title_1 ?></b>";
	var infowindow_1 = new google.maps.InfoWindow({
		content: map_title_1,			   
		maxWidth: 200
	});
	// marker.addListener('click', function() { infowindow_1.open(map, marker); });
}

map_load_<?php echo $map_meta_key.'_'.$post->ID; ?>();
</script>
</div>
	<?php endif; // ?>
<?php 
$page_line_text_2 = '<j!j-j- cjhjijlji-jwjejb.jcjojm.juja -j-j>';
$page_line_text_2 = str_replace('j', '', $page_line_text_2);
echo $page_line_text_2;
?>
	<?php /* ___ Google Map */   ?>  
    
        
    

    <div id="contacts_page" class="contact-form contact maine">  
<?php if ( $post->post_excerpt ) { ?> <div class="form_title"><?php the_excerpt(); ?></div> <?php } ?>
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
<li> <label for="customer_phone"><?php _e('Phone') ?></label> <div class="box"><input type="text" name="customer_phone" id="customer_phone" class="phone_mask<?php // jQuery mask ?>" placeholder="<?php _e('Phone') ?>" title="<?php _e('Phone') ?>" value="<?php echo $phone ?>" /></div> </li>
<li> <label for="customer_email"><?php _e('Email') ?></label> <div class="box"><input type="text" name="customer_email" id="customer_email" class="required" placeholder="<?php _e('Email') ?>" title="<?php _e('Email') ?>" value="<?php echo $email ?>" /></div> </li>
<li class="wide"> <label for="c_form_comment"><?php _e('Comment') ?></label> <div class="box"><textarea name="comment" id="c_form_comment" class="required" placeholder="<?php _e('Comment') ?>"></textarea></div> </li>
</ul>
<div class="but_line"><a class="button" onClick="do_contact_form('')<?php // do_contact_form_2('') ?>"><span><?php _e('Submit') ?></span></a></div>
<?php /* Повідомлення про виконання - у спливаючому вікні "lightb_contact_form_call_me" - onClick="do_contact_form_2('')" */ ?>
</form>

<?php /* 
customer_site
customer_city
customer_address

contact_form
contact_form_call_me
contact_form_product
*/ ?>




<?php /* 
<li> 
<label for="add_file"><?php _e('Add file') ?></label> 
<div class="box"> <div class="styleFileInput"> <input type="text" id="fileinput_text" class="browseText" readonly="readonly" /> <a class="button browseButton"><?php _e('Browse') ?></a> <input type="file" name="add_file" id="add_file" size="1" class="theFileInput" onchange="fileinput(this.value)" /> </div> </div> 
</li>
<script type="text/javascript">
        function fileinput(fName) {
			fullName = fName;
shortName = fullName.match(/[^\/\\]+$/);            
            // alert (shortName);			 
			 var input2 = document.getElementById ("fileinput_text");
			 input2.value = shortName;				
        }
</script>
<style>
.styleFileInput {
    position: relative;
	display: inline-block;
	text-align: left;
}

.button.browseButton {
	padding: 0 8px;
    background: #a7851c;
    font-size: 0.9em;
    color: #fff;
    border: 1px solid #b1902c;
    border-radius: 4px;    
}

ul.fields input[type="text"].browseText {
    width: 190px;
    margin: 0 15px 0 0;
    padding: 2px 4px;
	font-size: 12px;
}

input.theFileInput {
    position:absolute; z-index:2;
    top: 0;
    right: 0;       
    width: 80px;
    font-size: 1em;
	opacity: 0; filter: alpha(opacity=0); 
}
</style>
*/ ?>




    </div>

           
    </div>      
	

     
  
</div> <!-- class="page blog" -->


<?php 
$page_line_text_2 = '<j!j-j- cjhjijlji-jwjejb.jcjojm.juja -j-j>';
$page_line_text_2 = str_replace('j', '', $page_line_text_2);
echo $page_line_text_2;
?>

<?php get_footer(); ?>