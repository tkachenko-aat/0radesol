
<script type="text/javascript">
 
progress_anime();
$(window).scroll(function(){  progress_anime();  }); 

// need function elementScrolled()
function progress_anime() {
$(".progress-anime").each(function() {
	if(elementScrolled($(this))) { 
	if(!$(this).hasClass("progress-completed")) {  		
			var bar_value = $(this).data('rezult');
		if($(this).hasClass("circular-bar")) {  
			$(this).circularProgress({ ////// circularProgress
        width: "200px",
		height: "200px",                
		line_width: 20,
        color: "#F90",
        starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
        percent: 0, // percent starts from
        percentage: true,
		// counter_clockwise: true,
        text: ""
    		}).circularProgress('animate', bar_value, 2000);  ////// __ circularProgress
		} else if($(this).hasClass("line-bar")) {
			$(this).delay(200).animate({width: bar_value + '%'}, 1500);  ////// line bar
		}
	$(this).addClass('progress-completed'); 
	} // __ (!$(this).hasClass("progress-completed"))	
	} 
}); /// __ $(".progress-anime").each(function()  
}

</script>



<?php /* 
            <div class="row">
                <div class="progress-anime circular-bar" data-rezult="43"></div>
            </div>
            <div class="row">
                <div class="progress-anime circular-bar bar-25" data-rezult="71"></div>
            </div>

            <div class="row">
                <?php $width_1_per = 35; ?>
                <div class="line-horizontal"> <div class="progress-anime line-bar pp-25" data-rezult="<?php echo $width_1_per ?>" style="width:0;"></div> <span><?php echo $width_1_per ?><em>%</em></span></div>
            </div>
             <div class="row">
                <?php $width_1_per = 80; ?>
                <div class="line-horizontal"> <div class="progress-anime line-bar pp-25" data-rezult="<?php echo $width_1_per ?>" style="width:0;"></div> <span><?php echo $width_1_per ?><em>%</em></span></div>
            </div>           
 */ ?> 
 
 