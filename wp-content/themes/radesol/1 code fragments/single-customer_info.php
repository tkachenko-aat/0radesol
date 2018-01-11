<?php  // Для товарів, опублікованих клієнтами. Contact Info ?>
	<div class="customer_info_cont">
<div class="tit"><h4><?php _e('Contact Info') // Customer information ?></h4></div>
<?php $meta_arr = get_post_custom();
// $customer_arr = array('first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address');
$customer_name = implode(' ', array($meta_arr['first_name'][0], $meta_arr['last_name'][0]));
$address_14 = array('country', 'city', 'address');
$address_arr = array();
foreach ($address_14 as $key_4) {  if($meta_arr[$key_4][0]) { $address_arr[] = $meta_arr[$key_4][0]; }  }
$customer_address = implode(', ', $address_arr);
$customer_arr = array(
	'name' => array('label' => __('First Name'), 'value' => $customer_name),
	'email' => array('label' => __('Email'), 'value' => $meta_arr['email'][0]),	
);
if($meta_arr['show_phone'][0] == 1) { $customer_arr['phone'] = array('label' => __('Phone'), 'value' => $meta_arr['phone'][0]); }
$customer_arr['address'] = array('label' => __('Address'), 'value' => $customer_address);
?>
<ul class="customer_info">
<?php foreach ($customer_arr as $key => $info) : if($info['value']) : ?>
<li>
<span class="lab"><?php echo $info['label'] ?></span> <span class="val"><?php echo $info['value'] ?></span>
</li>
<?php endif; endforeach; ?>
</ul>
    </div>