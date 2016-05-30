<?php /**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */

/* Checking if the post is password-protected. */
if ( post_password_required() ) :
	return; 
endif; ?>
<article class="comments cafe-entry ">
	<?php if ( have_comments() ) : ?>
		<header>
			<h2 id="cafe-comments-header"><?php printf( _nx( __( 'One Response to', 'cafe' ) . '&nbsp;%2$s', '%1$s&nbsp;' . __( 'responses to', 'cafe' ) . '&nbsp;%2$s', get_comments_number(), 'cafe' ), number_format_i18n( get_comments_number() ), '&#8220;' . get_the_title() . '&#8221;' ); ?></h2>
		</header>
		<div class="comments-nav cafe-nav-link">
			<div class="alignleft"><h5><?php esc_url( previous_comments_link( '&lArr;&nbsp;' . __( 'Previous Comments', 'cafe' ) ) ); ?></h5></div>
			<div class="alignright"><h5><?php esc_url( next_comments_link( __( 'Next Comments', 'cafe' ) . '&nbsp;&rArr;' ) ); ?></h5></div>
			<div class="cafe-clear"></div>
		</div>
		<ol class="comment-list">
			<?php wp_list_comments(); ?>
		</ol>
		<div class="comments-nav cafe-nav-link">
			<div class="alignleft"><h5><?php esc_url( previous_comments_link( '&lArr;&nbsp;' . __( 'Previous Comments', 'cafe' ) ) ); ?></h5></div>
			<div class="alignright"><h5><?php esc_url( next_comments_link( __( 'Next Comments', 'cafe' ) . '&nbsp;&rArr;' ) ); ?></h5></div>
			<div class="cafe-clear"></div>
		</div>
	<?php else : /* This is displayed if there are no comments so far */
	 	if ( comments_open() ) :
	 	else : /* Comments are closed */ ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'cafe' ); ?></p>
		<?php endif;
	endif;
	comment_form(); ?>
</article> <!-- ENDs .comments -->