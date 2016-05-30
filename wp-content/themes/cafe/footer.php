<?php /**
 * The Footer for our theme
 *
 * Contains footer content and the closing of the .cafe-site-wrapper div element.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */ ?>
				</div>  <!-- END OF div.cafe-main-and-sidebar -->
				<div class="cafe-clear"></div>
			</div>	<!--END OF div.cafe-site-content -->
			<footer class="cafe-site-footer">
				<div class="cafe-footer-widget-area-wrapper">
					<div class="cafe-footer-widget-area">
						<?php if ( is_active_sidebar( 'sidebar-2' ) ) :
							dynamic_sidebar( 'sidebar-2' );
						else : /* is_active_sidebar */ ?>
							<aside class="cafe-footer-widget widget_categories">
								<h3 class="widget-title"><?php _e( 'archives', 'cafe' ); ?></h3>
								<ul>
									<?php wp_get_archives( array( 'type' => 'yearly' ) ); ?>
								</ul>
							</aside>					
							<aside class="cafe-footer-widget widget_recent_comments">
								<h3 class="widget-title"><?php _e( 'recent comments', 'cafe' ); ?></h3>
								<ul class="recentcomments_list">
									<?php $args = array( 'number' => 2, );
									$comments = get_comments( $args );
									foreach ( $comments as $comment ) : 
										/* checking the length of the current comment and desiding
										 * whether we need '[...]' at the end of the comment excerpt */
										if ( strlen( get_comment( $comment )->comment_content ) < 40 ) :
											$commentExcerptEndLineFiller = '';
										else :
											$commentExcerptEndLineFiller = ' [...]'; 
										endif; /* checking ends */	?>
										<li class="recentcomments">
											<?php if ( esc_url( $comment->comment_author_url ) ) : ?>
												<a href="<?php echo esc_url( $comment->comment_author_url ) . " "; ?>">
											<?php endif; 
											echo $comment->comment_author;
											if ( esc_url( $comment->comment_author_url ) . "&nbsp;" ) : ?>
												</a>
											<?php endif;
											_e( 'on', 'cafe' ) ?>&nbsp;<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a>
											<p><?php echo substr ( get_comment( $comment )->comment_content, 0, 40) . $commentExcerptEndLineFiller; ?></p>
										</li>
									<?php endforeach; ?>
								</ul>
							</aside>
							<aside class="cafe-footer-widget widget_recent_posts">
								<h3 class="widget-title" ><?php _e( 'recent posts', 'cafe' ); ?></h3>
								<ul>
									<?php $args = array( 'numberposts' => 2 );
									$recent_posts = wp_get_recent_posts( $args );
									foreach ( $recent_posts as $recent ) : ?>
										<li class="recentposts">
											<a href="<?php echo get_permalink( $recent["ID"] ); ?>" title="Look <?php echo esc_attr( $recent["post_title"] ); ?>" ><?php echo $recent["post_title"]; ?></a>
											<p><?php _e( 'posted by', 'cafe' ); ?>&nbsp;<span class="cafe_lowercase"><a href="<?php esc_url( the_author_link() ); ?>"><?php the_author(); ?></a></span>&nbsp;<?php _e( 'in', 'cafe' ); ?>&nbsp;<span class="cafe_lowercase"><?php the_category( ', ' ); ?></span></p>
										</li>
									<?php endforeach; ?>
								</ul>
							</aside>
							<aside class="cafe-footer-widget widget_nav_menu">
								<h3 class="widget-title" ><?php _e( 'menu', 'cafe' ); ?></h3>
								<?php wp_nav_menu( array( 
									'theme_location' => 'secondary', 
									'menu_class'     => 'footer_widget_menu', 
								) ); ?>
							</aside>
						<?php endif; /* footer widget area ENDs here */ ?>
					</div> <!-- END of .cafe-footer-widget-area -->
				</div> <!-- END of .cafe-footer-widget-area-wrapper -->
				<div class="cafe-footer-site-info-area">
					<div class="cafe-footer-site-info">
						<span><?php _e( 'Designed with love by', 'cafe' ); echo '&nbsp;' ?><a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebSoft</a></span>
						<a href="#cafe-content"><div class="cafe-up-button"></div></a>
					</div>
				</div> <!-- END of .cafe-footer-site-info-area -->
			</footer> <!-- END of .cafe-site-footer -->
		</div> <!-- END OF div.cafe-site-wrapper -->	
	<?php wp_footer(); ?>
	</body>
</html>

