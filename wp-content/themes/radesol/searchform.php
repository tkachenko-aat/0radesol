<script type="text/javascript">
function search_inp_check() {
	var inp_val = document.getElementById("s").value; 
if ( inp_val.length < 2 )  { return false; }
}


function do_ajax_search(s_input) {
var s_input_val = s_input.value;
var s_block = document.getElementById("search_ajax_suggest");
	if(s_input_val.length == 0) { var style_2 = 'block'; } else { var style_2 = 'none'; }
	s_block.children[1].style.display = style_2; 

var s_suggest_block = s_block.children[0];
if(s_input_val.length > 1) { 	
	// alert(s_input_val);	
	ajax_prepare_html(s_suggest_block);  <?php /* ф-ія ajax_prepare_html() - в head */ ?>
	new Ajax.Updater( page_temp.id, '<?php bloginfo('url'); echo '/?s='; ?>' + s_input_val, { 
	method: 'post',
	parameters: {search_ajax_request: s_input_val}, // {id: '273', name_spisok: 'spisok25'} 
	onComplete: 
		function() {			
			page_replace_new(s_suggest_block);  <?php /* ф-ія page_replace_new() - в head */ ?>
		}
	} );
}
else { s_suggest_block.innerHTML = ''; }
}


function show_ajax_search_block(par) {
	var s_block = document.getElementById("search_ajax_suggest"); 
	if(par == 'hide') { var style_1 = 'none'; } else { var style_1 = 'block'; }
setTimeout(function() { s_block.style.display = style_1; }, 200) ;
}

<?php /* Ефект "висувного" блоку пошуку. Розкоментувати javascript і скопіювати style */ ?>
<?php /* 
jQuery(document).ready(function($) {
width_15 = $("#s").parent().width();  // $(this).width() 
width_16 = $("#s").css("max-width");
$("#s").focus(function(){ /// blur
$(this).animate({width: width_16}); return false; /// {width: 'toggle'} 
});
$("#s").blur(function(){ 
$(this).delay(200).animate({width: width_15 + 'px'}); return false; /// {width: 'toggle'} //
});
});
 */ ?>
</script>

<form method="get" action="<?php bloginfo('url'); ?>/" onsubmit="return search_inp_check()" >
	<div class="search-form">
<input type="text" name="s" id="s" placeholder="<?php _e('Search') ?>" onkeyup="do_ajax_search(this)" onfocus="show_ajax_search_block('show')" onblur="show_ajax_search_block('hide')" value="" autocomplete="off" />

<?php /* <button type="button" onclick="this.form.submit()" name="searchsubmit" id="searchsubmit" title="<?php _e('Search') ?>"><span><?php _e('Search') ?></span></button> */ ?>
 
<button type="submit" id="searchsubmit" title="<?php _e('Search') ?>"> <span><?php _e('Search') ?></span> </button> 

<div id="search_ajax_suggest" style="display:none;">
<div class="search_aj"></div>
<div class="perfect"><?php /* include 'search-perfect.php'; */ /* *** search perfect list *** */ ?></div> 
</div>

	</div>
</form>

<?php /* 
<style>
.search-form {
	display: inline-block;
	position: relative; z-index: 1;
}
.search-form input[type="text"] {
	width: 140px;
	max-width: 580px;
}
</style>
 */ ?>