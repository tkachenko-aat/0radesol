<?php
/*
Template Name: WOW profile  
*/
?>
<?php if (!is_user_logged_in()) { wp_safe_redirect( get_bloginfo('url') ); } ?>
<?php WOW_Profile::edit_profile(); ?>
<?php get_header(); ?>

        
<div class="page profile no_column blog">


<?php include WOW_DIRE.'front_html_blocks/profile_menu.php'; /* wow_e_shop *** profile_menu *** */ ?>

  
    
	 <div id="profile_page" class="content ajax_replace2_content">	
     
 
     <?php // breadcrumbs
   if (function_exists('breadcrumbs')) breadcrumbs(); ?>

 
   <?php // main content ?> <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

    <div class="page_title title_content"> <h1><?php the_title(); ?></h1> </div>
    <div class="entry-content maine"> <?php the_content(); ?> </div>  
    
   <?php // -//- end main content ?> <?php endwhile; ?>	<?php else : ?>  	<?php endif; ?>	  
  
    
    <div class="profile_co maine">
    
<script type="text/javascript">
function profile_check_fields() {
	var notice_text = "<?php _e('Fill the field!') ?>";
	var notice = document.getElementById("profile_notice_text_5");
	
	var forma_prof = document.forms.form_profile;
	var input_first_name = forma_prof.elements['customer[first_name]'];
	var input_last_name = forma_prof.elements['customer[last_name]'];
	var input_email = forma_prof.elements['customer[user_email]'];	
	var input_pass1 = forma_prof.elements['pass1'];
	var input_pass2 = forma_prof.elements['pass2'];
	
	errore = 0;  

   if ( input_first_name.value.length < 3 ) {
    input_first_name.focus();
	input_first_name.className += ' error'; 	errore = 1;
  } else { input_first_name.className = ''; }
  
   if ( input_last_name.value.length < 3 ) {
    input_last_name.focus();
	input_last_name.className += ' error'; 	errore = 1;
  } else { input_last_name.className = ''; }
  
   var reg_email = /^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;
   if ( !input_email.value.match(reg_email) ) {
    input_email.focus();
	input_email.className += ' error'; 	errore = 1;
  } else { input_email.className = ''; }
  
    if ( (input_pass1.value != '') || (input_pass2.value != '') ) {
		if ( input_pass1.value.length < 6 || input_pass1.value != input_pass2.value) {
			input_pass1.className += ' error'; input_pass2.className += ' error'; 	errore = 1;
			if ( input_pass1.value.length < 6 ) { notice_text = "<?php _e('The minimum password length is 6 characters.') ?>"; } else { notice_text = "<?php _e('The passwords do not match.') ?>"; }
		}
	}
  
    
  if ( errore == 1 )  {
	notice.className += ' error';
	notice.innerHTML = notice_text;
    return false;
	}
}
</script>

<?php // _e('Please enter the same password in the two password fields.') ?>	
<?php 
	$first_name = ''; $last_name = ''; $email = ''; $phone = ''; $city = ''; $address = '';
	
	$current_user = wp_get_current_user();  $user_id = get_current_user_id();
	$email = $current_user->user_email;
	$user_meta = get_user_meta($user_id);
	
	// add_user_meta( $user_id, 'phone', '', true );	
	$first_name = $user_meta['first_name'][0]; $last_name = $user_meta['last_name'][0];
	$description = $user_meta['description'][0];
	$phone = $user_meta['phone'][0];
	$country = $user_meta['country'][0];
	$city = $user_meta['city'][0];
	$address = $user_meta['address'][0];
	$newsletter = $user_meta['newsletter'][0]; // Підписатися на розсилку 
	
	$profile_info_arr = array( 
		'first_name' => array('label' => __('First Name'), 'value' => $first_name, 'clas' => 'required'),
		'last_name' => array('label' => __('Last Name'), 'value' => $last_name, 'clas' => 'required'),
		'user_email' => array('label' => __('Email'), 'value' => $email, 'clas' => 'required'),	
	); // 
	$password_arr = array( 
		'pass1' => array('label' => __('New Password')),
		'pass2' => array('label' => __('Confirm new password')),
	); //
	
	$address_arr = array();
	
	$address_arr = array(
		'phone' => array('label' => __('Phone'), 'value' => $phone, 'clas' => ''),
		'country' => array('label' => __('Country'), 'value' => $country, 'clas' => ''),
		'city' => array('label' => __('City'), 'value' => $city, 'clas' => ''),
		'address' => array('label' => __('Address'), 'value' => $address, 'clas' => ''),		
	); // 

	?>     

<form name="form_profile" id="form_profile_edic" method="post" action="" onsubmit="return profile_check_fields()">

<?php if(strpos($_SERVER['HTTP_REFERER'], '/registration') !== false) { //  /registration/ ?>
<div class="message bolde succes"><?php _e('You have registered successfully on our site.') ?></div>
<?php } ?>

<?php $req_arr = array_keys($_GET); if (in_array('pass', $req_arr)) {  
if($_REQUEST['pass'] == 'false') { $clas_8 = 'error'; $pass_update_mess = __('The password was not changed'); } else { $clas_8 = 'succes'; $pass_update_mess = __('The password was successfully changed'); }
?>
<div class="message pass_update <?php echo $clas_8 ?>"><?php echo $pass_update_mess ?></div>
<?php } ?>
<div class="profile-edic columns-2 shad_conte">
    <div class="col col-1"><div class="inn">
    <div class="secto profile_info">
    <div class="title"><h3><?php _e('Edit My Profile') ?></h3></div>
    <ul class="profile fields">
    <li class="user_login">
    <label><?php _e('Login Name') ?></label>
    <div class="box"> <div class="info"><?php echo $current_user->user_login ?></div> </div>
    </li>
	<?php foreach ($profile_info_arr as $key => $info) : ?>
    <?php $field_id = 'customer-'.$key; ?>
    <li>
    <label for="<?php echo $field_id ?>"><?php echo $info['label'] ?><?php if($info['clas'] == 'required') { ?><span class="req">*</span><?php } ?></label>
    <div class="box"><input type="text" name="customer[<?php echo $key ?>]" id="<?php echo $field_id ?>" value="<?php echo $info['value'] ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>" maxlength="50" /></div>
    </li>
    <?php endforeach;  ?>
    </ul>
    </div>
    
    <div class="secto pass">
    <div class="title">
    <h3><?php _e('Password') ?></h3>
    <div class="comment"><?php _e('If you would like to change the password type a new one. Otherwise leave this blank.') ?></div>
    </div>
    <ul class="profile password fields">
    <?php foreach ($password_arr as $key => $info) : ?>
    <?php $field_id = 'p-'.$key; ?>
    <li class="<?php echo 'c-'.$key ?>">
    <label for="<?php echo $field_id ?>"><?php echo $info['label'] ?></label>
    <div class="box"><input type="password" name="<?php echo $key ?>" id="<?php echo $field_id ?>" title="<?php echo $info['label'] ?>" maxlength="20" /></div>
    </li>
    <?php endforeach;  ?>
    </ul>
    </div>    
    </div></div>
    
    
    
    <div class="col col-right"><div class="inn">    
    <div class="secto address">
    <div class="title"><h3><?php _e('Address') ?></h3></div>
    <ul class="profile fields">
    <?php foreach ($address_arr as $key => $info) : ?>
    <?php $field_id = 'customer-'.$key; ?>
    <li>
    <label for="<?php echo $field_id ?>"><?php echo $info['label'] ?><?php if($info['clas'] == 'required') { ?><span class="req">*</span><?php } ?></label>
    <div class="box"><input type="text" name="user_meta[<?php echo $key ?>]" id="<?php echo $field_id ?>" value="<?php echo $info['value'] ?>" title="<?php echo $info['label'] ?>" class="<?php echo $info['clas'] ?>" maxlength="50" /></div>
    </li>
    <?php endforeach;  ?>
    </ul>
    </div>
    
    <div class="secto desc">
    <div class="title"><h3><?php _e('Description') // Comments description ?></h3></div>
    <textarea name="customer[description]" class="order_comment" placeholder="<?php _e('Description') ?>"><?php echo $description ?></textarea>
    </div>

	<div class="secto newsletter"> 
    <ul class="profile fields">
    <li>    
    <div class="f_box"><input type="checkbox" class="fine_checkbox" name="user_meta[newsletter]" id="user_newsletter" value="1"<?php if($newsletter == 1) { ?> checked="checked"<?php } ?> /> <label for="user_newsletter"><?php _e('Subscribe newsletter') ?></label></div>
    </li>
    </ul>
    </div>
    </div></div>
    
    <div class="form_notice" id="profile_notice_text_5"><?php /* notice text */ ?></div>
    
</div> <!-- profile-edic -->

<div class="but_line"> <input type="submit" class="button" value="<?php _e('Save') ?>" /> </div>

</form>
 

<?php // print_r($user_meta); // print_r($current_user); ?>
   
    </div>
        
	
	           
    </div>      
	

     
  
</div> <!-- class="page blog" -->



<?php get_footer(); ?>