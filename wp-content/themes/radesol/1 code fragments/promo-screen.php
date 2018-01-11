<?php /* Заставка при 1-му відкриванні сайту. Вставити у front-page.php */ ?>



<?php /* Розмістити перед тегом <html>, тобтом перед хедером - "get_header()" (в 1-му рядку коду) */ ?>
<?php session_start();
if($_SESSION['counter']) { $count5 = $_SESSION['counter'] + 1; } else { $count5 = 1; }
$_SESSION['counter'] = $count5;
?>



<?php /* Розмістити після хедера - "get_header()" або відразу після тегу <body> (header.php) */ ?>
<?php $counter = $_SESSION['counter'];  if($counter == 1) { ?> 
<div id="promo-screen-1">
<div class="inn"> 
<div class="text" id="promo-screen-1-text"><div><span>promo text 1</span></div> <div><span>promo text 2</span></div></div> 
</div>
</div>
<script type="text/javascript"> 
window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
jQuery(document).ready(function($) {
	
// Заставка 	
setTimeout(function(){ $("#promo-screen-1").fadeOut("fast"); }, 6000);

}); /// jQuery(document).ready(function($)
}, false); // __ after jQuery is loaded 


<?php /* ****** Складний динамічний текст. Блоки тексту зявляються послідовно, з паузою ******* */ ?>
 i = 0;
p_text_i = [];
promo_text_new = [];
 text_blok_list = document.getElementById("promo-screen-1-text").children; <?php /* кожен дочірній div - блок з текстом; береться текст з цього блоку і замінюється на динамічний текст */ ?>

setTimeout( promo_blok_25(i), 0 ); 
function promo_blok_25(i) { ////////
	p_text_i[i] = 0;  
	promo_text_new[i] = '';
 	var text_blok = text_blok_list[i];
	var promo_text = text_blok.children[0].innerHTML;   // alert(promo_text);
var time_1 = 2000;  if(i == 0) { time_1 = 400; } 
setTimeout(function() {   
	promo_change_text_25(i, text_blok, promo_text);	
	// i++; top_show_text(i);	
}, time_1)
} ////////

function promo_change_text_25(i, text_blok, promo_text) { ////////
var promo_t_arr = promo_text; // 
var frag = promo_t_arr[p_text_i[i]];  
promo_text_new[i] += frag; 
setTimeout(function() {
	text_blok.innerHTML = promo_text_new[i];
		p_text_i[i]++; 
		if(p_text_i[i] < promo_t_arr.length) { promo_change_text_25(i, text_blok, promo_text); }
		else { i++;  if(i < text_blok_list.length) { promo_blok_25(i); } }
}, 100)	
} ///////////
</script>
<?php } // __ if($counter == 1) ?>

