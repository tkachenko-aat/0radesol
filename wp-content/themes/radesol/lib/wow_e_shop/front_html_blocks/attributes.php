
<?php $attrs_post_id = $post_id;
if(is_single()) { if($configur_disp_mode == 1) { $attrs_post_id = $post_id_gen; } }
$attributes_arr = WOW_Attributes_Front::post_view_attributes($attrs_post_id); ?>
            <div class="attributes"> 
            <?php foreach ($attributes_arr as $group) : ?>    
    <div class="group_attributes group-<?php echo $group['code'] ?>">
    <h5><?php echo $group['name'] ?></h5>
    <div class="atr-list">
    <?php foreach ($group['items'] as $attribute) : ?>  
    <div class="atr_item <?php echo 'atr-'.$attribute['code'] ?>">
    <?php // $par_2 = $attribute['sorting_position']; // you can use this field ... ?>
    <span class="lab"><?php echo $attribute['frontend_label'] ?> <span>:</span></span> <span class="value"><?php $value = implode(", ", $attribute['atr_value']); echo $value; ?><?php if($attribute['frontend_unit']) { ?> <span class="unit"><?php echo $attribute['frontend_unit'] ?></span><?php } ?></span>
     </div>
     <?php endforeach; ?>
     </div>
     </div> 
     <?php endforeach; ?>      
            </div>
            


<?php /* 
// варіант відмінювання слів - метр||метри||метрів 
// замінити <span class="value"> ...
<span class="value">
	<?php $value = implode(", ", $attribute['atr_value']); echo $value; ?>
	<?php if($attribute['frontend_unit']) { 
	$unit = $attribute['frontend_unit'];  $unit_arr = array();
	if(strpos($unit, '||') !== false) { 
	$unit_arr = explode('||', $unit);
 if($value == 1) {$unit = $unit_arr[0];} elseif(in_array($value, array(2, 3, 4))) {$unit = $unit_arr[1];} else {$unit = $unit_arr[2];}
	}
	?> 
    <span class="unit"><?php echo $unit ?></span>
	<?php } ?>
</span>
 */ ?>            