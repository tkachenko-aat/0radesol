
<script type="text/javascript">
/// слайди на всю площу екрану. вирівнювання слайда по вертикалі 

	$(".slide.slick-cloned .slide_thumb .s_video").empty(); // зачистка відео у слайдах-клонах
	
window.slide_fitter = function() {
		var win_width = $(window).width();  var win_height = $(window).height();
		var win_size_p = (win_width / win_height).toFixed(3);
	$(".slide .slide_thumb .inn").each(function() {
		var elem_width = $(this).width();  var elem_height = $(this).height();
		var elem_size_p = (elem_width / elem_height).toFixed(3); 
			if(win_size_p > elem_size_p) { // // small window height 
		$(this).css( "width", "" ).css( "left", "" );
			if(elem_height > win_height) {
		var height_2 = (win_height - elem_height) / 2; 		
		$(this).css( "top", height_2 );
			}
			} else { // // big window height
		var width_2 = (win_height * elem_size_p).toFixed();  var left_2 = (win_width - width_2) / 2;		
		$(this).css( "top", "" );
		$(this).css( "width", width_2 ).css( "left", left_2 );
					if($(this).height() < win_height) {
				width_2 = (width_2 * (win_height/$(this).height()) * 1.01).toFixed(); 
				left_2 = (win_width - width_2) / 2;
				$(this).css( "width", width_2 ).css( "left", left_2 );
					}
			}
	});	
}
		
	slide_fitter();

	$( window ).resize(function() {	slide_fitter();	});	
	
</script>
