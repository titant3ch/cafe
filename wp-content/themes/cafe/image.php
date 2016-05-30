<?php /**
 * The template for displaying image attachments
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */
get_header(); ?>
<div class="cafe-main">
	<?php while ( have_posts() ) : 
		the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
			<div class="post-heading-section">
				<section class= "entry-title-and-img">
					<header class="cafe-black-box-no-thumbnail entry-header">
						<h1 class="cafe-post-title entry-title"><?php the_title(); ?></h1>
						<h2 class="cafe-post-metadata">
							<span><?php _e( 'Posted on', 'cafe' ); ?></span>
							<span class="cafe-post-date"> 
								<?php if ( ! is_page() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ); ?></a>
								<?php else : 
									echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) );
								endif; ?>
							</span>
						</h2>
					</header>
				</section>
			</div>
			<div class="cafe-post-content entry-content">
				<div class="cafe-entry entry-attachment">
					<div class="attachment aligncenter">
						<?php /*
						 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
						 */
						$attachments = array_values( get_children( array( 
							'post_parent'    => $post->post_parent, 
							'post_status'    => 'inherit', 
							'post_type'      => 'attachment', 
							'post_mime_type' => 'image', 
							'order'          => 'ASC', 
							'orderby'        => 'menu_order ID', 
						) ) );
						foreach ( $attachments as $img => $attachment ) :
							if ( $attachment->ID == $post->ID )
								break;
						endforeach;
						$img++;
						/* If there is more than 1 attachment in a gallery */
						if ( count( $attachments ) > 1 ) :
							if ( isset( $attachments[ $img ] ) ) :
								/* get the URL of the next image attachment */
								$next_attachment_url = get_attachment_link( $attachments[ $img ]->ID );
							else :
								/* or get the URL of the first image attachment */
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							endif;
						else :
							/* or, if there's only 1 image, get the URL of the image */
							$next_attachment_url = wp_get_attachment_url();
						endif; ?>
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
							<?php /**
							 * Filter the image attachment size to use.
							 *
							 * @param array $size {
							 *     @type int The attachment height in pixels.
							 *     @type int The attachment width in pixels.
							 * }
							 */
							$attachment_size = apply_filters( 'cafe_attachment_size', array( 690, 540 ) );
							echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
						</a>
						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="wp-caption-text">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div><!-- .attachment -->
				</div><!-- .entry-attachment -->
				<div class="entry-description">
					<?php the_content();
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cafe' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-description -->
			</div><!-- .entry-content -->
		</article><!-- END OF .image-attachment -->
		<nav id="cafe-image-navigation" class="cafe-nav-single cafe-clearfix cafe-nav-link" role="navigation">
			<div class="cafe-nav-previous post-nav-prev alignleft"><h3><?php previous_image_link( false, '&larr;&nbsp;' . __( 'Previous image', 'cafe' ) ); ?></h3></div>
			<div class="cafe-nav-next post-nav-next alignright"><h3><?php next_image_link( false, __( 'Next image', 'cafe' ) . '&nbsp;&rarr;' ); ?></h3></div>
		</nav> <!-- END of #cafe-image-navigation -->
		<?php comments_template();
	endwhile; /* end of the loop. */ ?>
</div> <!-- END OF div.cafe-main -->	
<?php get_sidebar(); 
get_footer(); ?>