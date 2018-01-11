
	</div> <!-- page-content -->

</section> <!-- main content -->


<footer id="site_footer">

	<div class="foot_main">
		<div class="wrapper-cont">
			<div class="footer_inn">
				<div class="box-sidebar box_2" id="futer_centr"><?php /* 3 widgets = 3 columns */ ?> 
					<?php dynamic_sidebar( 'futer_centr' ); ?> 
				</div>
				<div class="box-sidebar box_1" id="futer_left"> <?php dynamic_sidebar( 'futer_left' ); ?> </div>
				<div class="box-sidebar box_3 soc_icons" id="futer_right"> 
					<?php dynamic_sidebar( 'futer_right' ); ?>
					<div class="copyright"><?php dynamic_sidebar( 'futer_copyright' ); ?></div>
 <?php /* <a href="http://chili-web.com.ua" target="_blank">Chili-web</a> // http://chili-web.eu/ */ ?>
				</div> 
			</div> <!-- footer_inn -->
		</div>
	</div>

<?php /* /1 code fragments/footer_textwidget_social.php /// Кнопки соц. мереж - код для вставки у textwidget */ ?>

	<div class="foot_bot line">
		<div class="wrapper-cont">
			<div class="footer_inn">
				<div id="menu3"> <?php wp_nav_menu( array( 'theme_location' => 'm3','fallback_cb'=> '' ) ); ?> </div>
			</div>
		</div>
	</div>

 
	    
	<a id="scroll_to_top" title="<?php _e('Scroll to top') ?>"> <i class="ha ha-arrow ha-arrow-up"></i> </a> 

	<!-- chili-web.com.ua -->
</footer>






<?php /* ********** Спливаючі вікна ************* */ ?>

<?php /* Яваскрипти перенесені в footer */ ?>

<div id="overlay_2" class="overlay_fon" style="display: none; position: fixed; left: 0; right: 0; top: 0; bottom: 0; ">  </div> <!-- onClick="overlay_hide()" -->
  
  <?php /* Форма входу */ ?>
 <?php if (!is_user_logged_in()) : ?>
<div id="form_login_mini" class="lightb_window medium" style="display: none;">
	<a class="close_but btn-remove" onClick="overlay_hide()" title="<?php _e('Close') ?>"> <i class="ha ha-close"></i> </a>
	<div class="lightb_inner"> <?php include WOW_DIRE.'front_html_blocks/login_mini.php'; /* wow_e_shop *** login_mini *** */ ?> </div>
</div> 
 <?php endif ?>
  
<div class="lightb_window big" id="lightb_cart" style="display: none;">
	<a class="close_but btn-remove" onClick="overlay_hide()" title="<?php _e('Close') ?>"> <i class="ha ha-close"></i> </a> 
	<div class="lightb_inner"> </div>
</div>

<div class="lightb_window medium" id="lightb_contact_form_call_me" style="display: none;">
	<a class="close_but btn-remove" onClick="overlay_hide()" title="<?php _e('Close') ?>"> <i class="ha ha-close"></i> </a>
	<div class="lightb_inner">     	
		<div class="contact-form call_me">
<?php $form_name = 'contact_form_call_me'; ?>
<h4><?php _e('Call-back service') ?></h4>
<form name="<?php echo $form_name ?>" id="<?php echo $form_name ?>" method="post">
<ul class="c_form fields">
<li> <label for="call_customer_name"><?php _e('Name') ?></label> <div class="box"><input type="text" name="customer_name" id="call_customer_name" class="required" placeholder="<?php _e('Name') ?>" title="<?php _e('Name') ?>" value="" /></div> </li>
<li> <label for="call_customer_phone"><?php _e('Phone') ?></label> <div class="box"><input type="text" name="customer_phone" id="call_customer_phone" class="phone_mask<?php // jQuery mask ?> required" placeholder="<?php _e('Phone') ?>" title="<?php _e('Phone') ?>" value="" /></div> </li>
</ul>
<div class="but_line"><a class="button" onClick="do_contact_form('<?php echo $form_name ?>')"><span><?php _e('Submit') ?></span></a></div>
</form>
		</div>
	</div>
</div>

<?php /* **********  ************* */ ?>  






</div>
<!-- END: wrapper -->


<?php /* *** wp-landing *** Landing page - scroll animation *** */ ?> 

<script type="text/javascript">
	window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
jQuery(document).ready(function($) {

///// nice scroll effect 
	$('a[href^="#"]').on('click',function (e) {
	    //// активний пункт
		// $(".top_menu ul.menu > li").removeClass("current-menu-item"); 
		$(this).parent().parent().children().removeClass("current-menu-item"); 
		$(this).parent().addClass("current-menu-item"); ///
		//// _______
		e.preventDefault();
	    var target = this.hash; 
	    	if(target != '') {
		var $target = $(target);
		var height_7 = 50; if(window.innerWidth < 781) { height_7 = 0; } // 50 - висота меню 
		var height_57 = $target.offset().top - height_7 + 2; 
		$('html, body').stop().animate({
	        'scrollTop': height_57 
	    }, 600, 'swing', function () {
	        // window.location.hash = target; // you can remove this line 
	    });
			} // __ if(target != '')
	});
<?php /* 	
///// активний пункт і секція під час скролінгу 
	$(".section").each(function() {
		// $(this).css( "height", $(this).height() );
	}); 	
	$(window).scroll(function(){
        $(".section").each(function() {
		  // $(this).css( "height", $(this).height() );
		  var window_top = $(window).scrollTop();
          var div_top = $(this).offset().top;
          var sect_id = $(this).attr('id');
		  var height_15 = 50; // 0 
            if (window_top > div_top - height_15) {
                $('#menu1').find('li').removeClass('current-menu-item');
                $('#menu1').find('a[href="#'+sect_id+'"]').parent().addClass('current-menu-item');
				$(".section").removeClass("act-section").removeClass("fix-section"); /// 
				$(this).addClass("act-section"); /// 
					if ($(this).next().is(".section")) { // ".section-cat" 
				// $(this).next().addClass("fix-section"); 
				// $(this).next().children().first().css( "top", height_15 );
					} /// 
            }
            else {
                $('#menu1').find('a[href="#'+sect_id+'"]').parent().removeClass('current-menu-item');
				$(this).removeClass("act-section"); ///
				$(this).next().removeClass("fix-section"); /// 
            };
        });
	});
 */ ?>
});
    }, false); // __ after jQuery is loaded
</script>


<script type="text/javascript"> 

	window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded async. 
	
jQuery(document).ready(function($) {
	 $.fn.scrollToTop=function(){$(this).hide().removeAttr("href");
	 if($(window).scrollTop()!="0"){$(this).fadeIn("slow")}var scrollDiv=$(this);
	 $(window).scroll(function(){if($(window).scrollTop()<200){$(scrollDiv).fadeOut("slow")}
	 else{$(scrollDiv).fadeIn("slow")}});
	 $(this).click(function(){$("html, body").animate({scrollTop:0},"slow")})}
});

jQuery(document).ready(function($) {
$("#scroll_to_top").scrollToTop();
});



jQuery(document).ready(function($) { <?php /* Виїжджаюче головне меню (малі екрани) */ ?>
$(".menu-hamb").click(function(){
		if ($(this).is(".open")) { 
	$(this).removeClass("open").addClass("close");
	$(this).next().addClass("expande");
	$(".top_menu ul.menu > li").removeClass("open").addClass("close"); 
		}
		else { $(this).removeClass("close").addClass("open"); }
	$(this).next().slideToggle("normal");
return false;
});

$(".top_menu li.menu-item-has-children > a").click(function() { <?php /* Відкрити підпункти меню (малі екрани) */ ?>
	if ($(this).parent().is(".open")) { $(this).parent().removeClass("open").addClass("close"); }
	else { 
		$(".top_menu ul.menu > li").removeClass("open").addClass("close");
		$(this).parent().removeClass("close").addClass("open"); 
	}	
	if(window.innerWidth < 900) { //// or is Android, IOs ...
	return false;
	}
});

<?php /* Плавне, із затримкою, відкривання підменю */ ?>
$(".top_menu ul.menu li").hover(
	function () {
		// $(this).children(".sub-menu").removeClass("hide");
		$(this).children(".sub-menu").delay(500).slideDown(400); // show(400)
    },  
	function () {
		$(this).children(".sub-menu").stop(true, true).delay(500).hide(0);		
		// $(this).children(".sub-menu").addClass("hide");
    }  
);


	

$(".column li.menu-item-has-children > a").click(function() { <?php /* бокове меню з виїжджаючими підпунктами */ ?>
	if ($(this).parent().is(".open")) { $(this).parent().removeClass("open").addClass("close"); }
	else { 
		// $(".column ul.menu > li").removeClass("open").addClass("close");
		$(this).parent().removeClass("close").addClass("open"); 
	}	
	$(this).next().slideToggle("normal");
	if(window.innerWidth < 900) { //// or is Android, IOs ...
	return false;
	}
});

<?php /* 
$('.top_menu li.menu-item-has-children').append('<span></span>');
$(".top_menu li.menu-item-has-children > span").click(function(){
	if ($(this).parent().is(".subopen")) { 
	$(this).parent().removeClass("subopen").addClass("subclose");
	}
	else { $(this).parent().removeClass("subclose").addClass("subopen"); }
});	
 */ ?>

$(".toogle-b").click(function(){
if ($(this).parent().parent().is(".open")) {
$(this).parent().parent().removeClass("open").addClass("close"); 
} else { 
		$(".column .block").removeClass("open").addClass("close");
		$(".column .block .block-content").hide("normal");
		$(this).parent().parent().removeClass("close").addClass("open"); 
}
	$(this).parent().next().addClass("expande");	
	$(this).parent().next().slideToggle("normal");
	return false;
});

<?php /* *** fixed (sticky) column */ ?>
<?php // http://leafo.net/sticky-kit/ ?>
window.sticky_fix_column = function() {
	if(window.innerWidth > 780) { 
$(".fix_column").stick_in_parent({offset_top: 50}); // {offset_top: 0, spacer: false} // you can not use "spacer"
	}
	else { $(".fix_column").trigger("sticky_kit:detach"); }
}
	sticky_fix_column();
	$(window).resize(function() {	sticky_fix_column();	});	


<?php /* *** animation with jquery-boxloader // now is used in block "box-content about_info" in front-page.php; you must uncomment/include script 'jquery.boxloader.min.js' in functions.php */ ?>
<?php /* 
$(".anime-left").boxLoader({
	    direction:"x", // "x", "y" 
	    position: "-70%", // 1% ... 100% (from right), -1% ... -100% (from left)
	    effect: "fadeIn", // "fadeIn", "none"
	    duration: "1.5s",
	    windowarea: "50%" // 100% - the element will appear at the bottom of the window
});
$(".anime-right").boxLoader({
	    direction:"x", 
	    position: "70%", 
	    effect: "fadeIn", 
	    duration: "1.5s",
	    windowarea: "50%" 
});
 */ ?>


function elementScrolled(elem) { <?php /* check if element is visible on screen */ ?>
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        var elemTop = $(elem).offset().top;
        return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
}

<?php /* /1 code fragments/progress-bars.php /// insert javascript here 
Динамічна лінійна (горизонтальна) чи кругова діаграма.
you must uncomment/include script 'circular-bar.js' in functions.php */ ?>

}); /// jQuery(document).ready(function($)

    }, false); // __ after jQuery is loaded 



     <?php $po_arr = array_keys($_POST); ?>
	 
<?php if(!in_array('popupp', $po_arr)) { ?> window.addEventListener("DOMContentLoaded", function() { // after jQuery is loaded. <?php } ?> 

	jQuery(document).ready(function($) { <?php // script jquery-ui-tooltip ?> 
		/* $("a").easyTooltip(); */ // 
$( "[title]" ).tooltip({ // all elements with "title" attribute 
  position: { my: "bottom-6", at: "center top" },
});
$( "[aria-label]" ).tooltip({ // all elements with "[aria-label]" attribute 
  position: { my: "bottom-6", at: "center top" },
  content: function(){ return $(this).attr('aria-label'); },
  tooltipClass: "wide-tooltip"
});
			$(".ui-helper-hidden-accessible").remove();
$( ".tooltip_bot" ).tooltip( "option", "tooltipClass", "pos-bottom" );
$( ".tooltip_bot" ).tooltip( "option", "position", { my: "top+8", at: "center bottom" } );
// $( "[aria-label]" ).tooltip( "option", "tooltipClass", "wide-tooltip" );
// $( "[aria-label]" ).tooltip( "option", "content", function(){ return $(this).attr('aria-label'); } );
	});

	jQuery(document).ready(function($) { <?php /* script jquery mask */ ?>
$(".phone_mask").mask('(380) 99-9999999', {placeholder:'_'}); // '(999) 99-9999999' 
	});

<?php if(!in_array('popupp', $po_arr)) { ?> }, false); // __ after jQuery is loaded <?php } ?> 



window.onscroll = function() { 
	set_fixed_top9(); 
	<?php /* infi_scroll(); */ ?> <?php /* Infinite Scroll, load more items */ ?> 
}
window.onload = function() { set_fixed_top9(); } // window.scrollBy(0, -50); 

function set_fixed_top9() {
  var header_con = document.getElementById("top");
  var main_menu = header_con.getElementsByClassName("main-menu")[0];
  // var s_height = document.body.clientHeight || document.documentElement.clientHeight;
  var scroll_y = document.body.scrollTop || document.documentElement.scrollTop;
  
  var header_height = header_con.offsetHeight;  var menu_height = main_menu.offsetHeight;
  var top_con_height = header_height - menu_height;
  var height57 = scroll_y - top_con_height;
  if(height57 >= 0) { header_con.className = 'fix_menu'; } else { header_con.className = ''; }
}

</script>


<?php include WOW_DIRE.'js/e_shop_scripts.php'; /* wow_e_shop *** e_shop_scripts *** */ ?>


<?php wp_footer(); ?>

<?php /* *** animation with wow script // now is used in block "box-content advantages" in front-page.php; you must uncomment/include script 'wow.min.js' in functions.php */ ?>
<?php /* 
<script>
new WOW().init();
</script>
 */ ?>
 
</body>

</html>