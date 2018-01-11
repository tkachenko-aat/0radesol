<?php if ( comments_open() ) : ?>

<div id="comments"> 
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.'); ?></p>
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>


<?php // Коментарі. Перевірка форми з javascript ?> 
<?php /* 
дописати у ядрі (wp-includes/comment-template.php):
<form id="commentform" name="commentform" ... onsubmit="return comments_kella()" >
......
</form>
 */ ?>
<script type="text/javascript" > 
function comments_kella() {	
	var comme_form = document.forms.commentform;
	var input_author = comme_form.author;
	var input_email = comme_form.email;
	var input_comment = comme_form.comment;
	
	var errore = 0;			
	var reg_email = /^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;
	
		if ( input_author ) {
	if ( (input_author.value == '' ) )  {    
    input_author.focus();
	input_author.className += ' error'; 	errore = 1;
    // return false;
  	} else { input_author.className = ''; }
		}
	
		if ( input_email ) {
	 if ( (!input_email.value.match(reg_email)) )  {   
    input_email.focus();
	input_email.className += ' error'; 	errore = 1;
    // return false;
  	} else { input_email.className = ''; }
		}
	
	 if ( (input_comment.value == '' ) )  {    
    input_comment.focus();
	input_comment.className += ' error'; 	errore = 1;
    // return false;
  	} else { input_comment.className = ''; }

	if ( errore == 1 )  {  return false;  }
}


function sikd() { 
var comm_form = document.getElementById("comments-form");
var com_link = document.getElementById("atrakor");
if (comm_form.className == 'active') { comm_form.className = 'pas'; } else { comm_form.className = 'active';}
if (com_link.className == 'comments-form-hed active') { com_link.className = 'comments-form-hed pas'; } else { com_link.className = 'comments-form-hed active';}
}
</script>
 
<button id="atrakor" class="pas" onclick="sikd()"> <span><?php _e('Leave a Reply'); ?></span> </button>


<div id="comments-form" class="pas">
	<?php comment_form(); ?>
    <?php // у форму додати поле 'post_url' - для збереження активної мови ?>
</div>


	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
	<span class="figoo"> <?php _e('Comments'); ?> <span>: </span> </span> <span class="figoo_num">	<?php echo get_comments_number();?> </span>
<?php // printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'twentyeleven' ),
		//		number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		
		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use twentyeleven_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define twentyeleven_comment() and that will be used instead.
				 * See twentyeleven_comment() in twentyeleven/functions.php for more.
				 */
				wp_list_comments();
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
		<!-- 	<h1 class="assistive-text"><?php // _e( 'Comment navigation'); ?></h1> -->
			<?php // previous_comments_link( __( '&larr; Older Comments') ); ?>
			<?php // next_comments_link( __( 'Newer Comments &rarr;') ); ?>
            <div class="nav-previous"><?php previous_comments_link(); ?></div>
			<div class="nav-next"><?php next_comments_link(); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e('Comments are closed.'); ?></p>
	<?php endif; ?>

</div>

<?php endif; ?>