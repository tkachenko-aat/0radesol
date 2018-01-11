<?php if(function_exists('qtrans_getSortedLanguages')) : ////// language chooser
global $q_config;
if(is_404()) $url = get_option('home'); else $url = '';
?>
<div class="op_select" id="languagg_switch" title="<?php _e('Site language:') ?>">
 <a class="select_title language-<?php echo $q_config['language'] ?>" onclick="select_open(this)"> <div class="inn"> <?php echo $q_config['language_name'][$q_config['language']] ?> </div> <i class="ja ja-caret-down"></i> </a>           
            <div class="drop"> 
       		 <?php foreach(qtranxf_getSortedLanguages() as $language) : ?>                    
         <div class="op_option lang-<?php echo $language ?> <?php if($language == $q_config['language']) { ?>selected<?php } ?>">  
  <a<?php if($language != $q_config['language']) { ?> href="<?php echo qtranxf_convertURL($url, $language, false, true) ?>"<?php } ?> onclick="select_change(this)" class="inn"> <?php echo $q_config['language_name'][$language] ?> </a>  
         </div>                 
            	<?php endforeach; ?>  
            </div>             
</div>
<?php endif; ////// ___ language chooser ?>
