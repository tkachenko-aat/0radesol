<aside id="left-column" class="column fix_column">




<?php if(is_archive()) : ?>
<?php if($taxo_view != 'categories_list' and $queried_object->taxonomy != 'prod-cat') : ?>
<?php include WOW_DIRE.'front_html_blocks/sidebar_filter.php'; /* wow_e_shop *** sidebar_filter *** */ ?>
<?php /* include WOW_DIRE.'front_html_blocks/sidebar_filter_f_select.php'; // Фільтри формату select  */ ?>
<?php endif; ?>
<?php endif; ?>


<?php include 'list-categories_or_pages.php'; /* *** list-categories_or_pages *** */ ?>


<?php include WOW_DIRE.'front_html_blocks/sidebar_compare.php'; /* wow_e_shop *** sidebar_compare *** */ ?>

<?php include WOW_DIRE.'front_html_blocks/sidebar_viewed.php'; /* wow_e_shop *** sidebar_viewed *** */ ?>

<?php include WOW_DIRE.'front_html_blocks/sidebar_wishlist.php'; /* * sidebar_wishlist * */ ?> 



		
<div id="left-sidebar">    
<?php dynamic_sidebar( 'left-sidebar' ); ?>
</div>


 
	    	
</aside>