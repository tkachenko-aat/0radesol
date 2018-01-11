
    <?php // *** Показати налаштування (з динамічними опціями), що розміщені в адмінці на стор. "Settings 5". ***
	$options_5_1 = get_option('settings_5_1');
	$options_5_arr = get_option('settings_5_arr');
	if($options_5_1) : ?>
    <div class="secto zno">
    <div class="title">
    <h3><?php echo $options_5_arr['sett_5_1_title']; ?></h3>
    <div class="comment"><?php echo $options_5_arr['sett_5_1_comment1']; ?></div>
    </div>
    <ul class="">
    <?php 
	$num = 0;
	foreach ($options_5_1 as $key_2 => $method) : if($method['status'] == 1) : ?>
    <?php $num++;
	$field_id = 'zno-rez-'.$key_2; 	
	?>
    <li id="<?php echo $field_id ?>"> 
    <?php echo $method['label'] ?> ..... 
    <?php echo $method['descr'] ?> - <?php echo $options_5_arr['sett_5_1_unit'] ?>
    </li>
    <?php endif; endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>