
<?php /* wow_e_shop *** product addtocart_form for configurable with table mode *** */ ?>
<div class="lightb_window medium" id="lightb_addtocart_form" style="display: none;">
<a class="close_but btn-remove" onClick="overlay_hide()" title="<?php _e('Close') ?>"> <i class="fa fa-close" aria-hidden="true"></i> </a>
<div class="lightb_inner"> 
     <?php $product_form_id = 'product_addtocart_form_2'; 
	 $options_7 = get_option('site_add_settings_4');
	 $add_text = $options_7['site_text_1'];
	 ?>
     <form name="prod_form" id="<?php echo $product_form_id ?>" class="prod_form" method="post" action="<?php bloginfo('url'); echo '/cart/'; ?>" >     
    <?php /* <input type="hidden" name="product_form[113]" value="6" /> */ ?>    
    <div class="title">
    <div class="add_text"><?php echo $add_text ?></div>
    <div class="prod_name" id="lightb_addtocart_prod_name"></div>
    </div>		
            <div class="addtocart">      
            	<div class="addtocart_qty">  
    	<label for="qty"><?php _e('Qty') ?>:</label>
        <div class="qty-contain">
<?php $default_qty = 1; 
// $post_id = $post->ID;  $post_id_gen;
?>
        <div class="qty_change_co">    
        <span class="qty_change minus" onclick="qty_chan('minus', 'lig_qty', 'lightb_view')"> </span>
   <input type="text" name="product_form[<?php echo $post_id_gen ?>]" id="lig_qty" maxlength="10" value="<?php echo $default_qty; ?>" title="<?php _e('Qty') ?>" class="qty" onchange="qty_chan('', 'lig_qty', 'lightb_view')" onkeypress="qty_validate(event, 'int')" /> 
    	<span class="qty_change plus" onclick="qty_chan('plus', 'lig_qty', 'lightb_view')"> </span>
        </div>        
        </div>        
    			</div> <!-- addtocart_qty -->

		<div class="button_line"> 
    <a class="button go_back" onClick="overlay_hide()"><?php _e('Cancel') ?></a>
    <a onclick="addtocart('', '', '<?php echo $product_form_id ?>')" class="button btn-cart"><?php _e('Add') ?></a> 
        </div>            
            </div>   
	</form>
</div>
</div>
