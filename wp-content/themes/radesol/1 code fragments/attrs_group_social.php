<?php /* /// **** Група атрибутів //  */ ?>
<?php $my_group_attr_5 = WOW_Attributes_Front::post_view_my_group_attributes($post_id, 'feature'); ?>
            <?php if(count($my_group_attr_5)) : ?>
            <div class="attributes_51"> 
    <?php foreach ($my_group_attr_5 as $attribute) : ?> 
    <?php $value = implode(", ", $attribute['atr_value']); ?>
    <?php // $par_2 = $attribute['sorting_position']; // you can use this field ... ?>
    <div class="my_atr_item <?php echo $attribute['code'] ?>">
    <a href="<?php echo $value ?>" target="_blank">
    <span class="lab"><?php echo $attribute['frontend_label'] ?> <span>:</span></span> <span class="value"><?php echo $value; ?><?php if($attribute['frontend_unit']) { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } ?></span>
     </a>
     </div>
     <?php endforeach; ?>    
            </div>
            <?php endif; ?>






<?php /* Кнопки соц. мереж - Група атрибутів 'social' */ ?>
<?php /* // коди атрибутів: 
social_facebook
social_vk
social_twitter
social_google_plus
social_vimeo
social_youtube
social_tumblr
social_instagram
social_skype
*/ ?>
<?php $social_attr_5 = WOW_Attributes_Front::post_view_my_group_attributes($post_id, 'social'); ?>
            <?php if(count($social_attr_5)) : ?>
            <div class="social-single"> 
            <ul> 
    <?php foreach ($social_attr_5 as $attribute) : ?> 
<?php $a_code = str_replace('social_', '', $attribute['code']);  $a_code = str_replace('_', '-', $a_code); 
$value = implode(", ", $attribute['atr_value']); 
if($a_code == 'skype') { $value = 'skype:'.$value.'?chat'; } ?>
    <li class="my_atr_item <?php echo $attribute['code'] ?>">
    <a href="<?php echo $value ?>" target="_blank" title="<?php echo $attribute['frontend_label'] ?>">
    <i class="fa fa-<?php echo $a_code ?>"></i>   
     </a>
     </li>
     <?php endforeach; ?>    
            </ul>
            </div>  
			<?php endif; ?>






<?php /* /// **** Група атрибутів у вигляді таблиці; атрибути використовують опції одного базового атрибуту, а не власні опції //  */ ?>
<?php $my_group_attr_5 = WOW_Attributes_Front::post_view_my_group_attributes($post_id, 'country'); 
 $my_group_attr_5 = array_values($my_group_attr_5);
$group_attr_options = $my_group_attr_5[0]['options'];  
?>
            <?php if(count($my_group_attr_5)) : ?>
		<div class="attributes_51">
        <table border="1">
        <tr>
        <th class="col-aa" title=""></th>
		<?php foreach ($group_attr_options as $opt_key => $opt_1) { ?> 
        <th class="col-<?php echo $opt_key ?>" title="<?php echo $opt_1['link'] ?>"><?php echo $opt_1['label'] ?></th>
        <?php } ?> 
        </tr>        
    <?php foreach ($my_group_attr_5 as $attribute) :  if($attribute['backend_table']) : 
	$atr_opt_keys = array_keys($attribute['atr_value']); ?> 
        <tr>
        <td class="col-aa"> <span class="lab"><?php echo $attribute['frontend_label'] ?></span> </td>
        <?php foreach ($group_attr_options as $opt_key => $opt_1) { ?> 
        <td class="col-<?php echo $opt_key ?>"> <?php if(in_array($opt_key, $atr_opt_keys)) { ?><i class="dzembroni"></i> <span class="value"><?php echo $opt_1['label'] ?><?php if($attribute['frontend_unit']) { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } ?></span><?php } ?> </td>
        <?php } ?> 
   <?php // $par_2 = $attribute['sorting_position']; // you can use this field ... ?>
        </tr> 
     <?php endif;  endforeach; ?>    
		</table>
        </div>
            <?php endif; ?>


			