<?php /**
 * The sidebar containing the main widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, displays "Search", "Recent Posts" and "Recent Comments".
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */ ?>
<div class="cafe-sidebar">
	<div class="cafe-sidebar-widget-area">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) :
			dynamic_sidebar( 'sidebar-1' );
		else : /* is_active_sidebar */ ?>
			<aside class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>
			<aside class="widget widget_recent_posts">
				<h4 class="widget-title" ><?php _e( 'recent posts', 'cafe' ); ?></h4>
				<ul>
					<?php $args = array( 'numberposts' => 5 );
					$recent_posts = wp_get_recent_posts( $args );
					foreach ( $recent_posts as $recent ) : ?>
						<li class="recentposts"><a href="<?php echo get_permalink( $recent["ID"] ); ?>" title="Look <?php echo esc_attr( $recent["post_title"] ); ?>" ><?php echo $recent["post_title"]; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</aside>
			<aside class="widget widget_recent_comments">
				<h4 class="widget-title"><?php _e( 'recent comments', 'cafe' ); ?></h4>
				<ul>
					<?php $args = array( 'number' => 5, );
					$comments = get_comments( $args );
					foreach ( $comments as $comment ) : ?>
						<li class="recentcomments">
							<?php if ( esc_url( $comment->comment_author_url ) ) : ?>
								<a href="<?php echo esc_url( $comment->comment_author_url ) . '&nbsp;'; ?>">
							<?php endif; echo $comment->comment_author;
							if ( esc_url( $comment->comment_author_url ) . "&nbsp;" ) : ?>
								</a>
							<?php endif;
							_e( 'on', 'cafe' ) ?>&nbsp;
							<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</aside>
		<?php endif; /* end sidebar widget area */ ?>
	</div> <!-- END of .cafe-sidebar-widget-area -->
</div> <!-- END of div.cafe-sidebar -->	
