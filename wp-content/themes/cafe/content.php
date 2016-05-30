<?php /**
 * The default template for displaying content
 *
 * Used for single/page/index/archive/search.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */ ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<header class="post-heading-section">
		<section class= "entry-title-and-img">
			<div class="
				<?php if ( has_post_thumbnail() ) : /* post with thumbnail */?>
					cafe-black-box-with-thumbnail 
				<?php else : ?>
					cafe-black-box-no-thumbnail
				<?php endif; 
				if ( ( has_post_thumbnail() && ( has_excerpt() ) ) || ( has_post_thumbnail() && $post->post_content != "" && ( "gallery" !=get_post_format() ) && "image" != get_post_format() ) ) : ?>
					 cafe-black-box-has-excerpt
				<?php endif; ?> ">
				<h1 class="cafe-post-title">
					<?php if ( ! is_singular() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php else : 
						the_title(); 
					endif; ?>
				</h1>
				<h2 class="cafe-post-metadata">
					<span><?php _e( 'Posted on', 'cafe' ); ?></span>
					<span class="cafe-post-date"> 
						<?php if ( ! is_page() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php printf( date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ) ); ?></a>
						<?php else : 
							echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) );
						endif; ?>
					</span>
					<?php if ( has_category() && ! is_page() && ! is_attachment() ) : ?>
						<img width="5" height="5" class="cafe-square-divider" alt="-" src="<?php echo get_template_directory_uri(); ?>/images/square-divider.png">
						<span class="cafe-post-category"><?php the_category( ', ' ); ?></span>
					<?php endif; ?>
				</h2>
				<?php if ( ( has_post_thumbnail() && ( has_excerpt() ) ) || ( has_post_thumbnail() && "" != $post->post_content && ( "gallery" != get_post_format() ) && "image" != get_post_format() ) ) : ?>
					<div class="cafe-post-excerpt"><?php the_excerpt(); ?></div> 
				<?php endif; ?>
			</div>
			<?php the_post_thumbnail( 'post-featured-image' ); ?> 
		</section>	
		<?php if ( is_singular() ) : 
			do_action( 'cafe_post_caption' );
		endif; ?>
	</header>
	<?php if ( ( has_post_thumbnail() && is_singular() && "" != $post->post_content ) || ( ( "" != $post->post_content || has_tag() || is_attachment() ) && ! has_post_thumbnail() ) ) : ?>	
		<div class="cafe-post-content">
			<div class="cafe-entry">
				<?php if ( ( ! is_singular() && has_excerpt() ) || is_search() ) : 
					the_excerpt(); 
				else : 
					the_content();
				endif;
				wp_link_pages( array( 
					'before'      => '<div class="post-page-links"><span class="post-page-links-title">' . __( 'Pages:', 'cafe' ) . '</span>', 
					'after'       => '</div>', 
					'link_before' => '<span>', 
					'link_after'  => '</span>', 
				) ); ?>
			</div>
			<?php if ( has_tag() ) : ?>
				<footer class="cafe-tags"><?php the_tags( '', ' / ' ); ?></footer>
			<?php endif; ?>
		</div> <!-- END of .cafe-post-content -->
	<?php endif; ?>
</article>
<?php if ( is_singular() ) : ?>
	<nav id="post-nav" class="post-navigation cafe-nav-link" role="navigation">
			<div class="post-nav-prev alignleft"><h3><?php previous_post_link( '%link', '&lArr; %title' ); ?></h3></div>
			<div class="post-nav-next alignright"><h3><?php next_post_link( '%link', '%title  &rArr;' ); ?></h3></div>
			<div class="cafe-clear"></div>
	</nav><!-- #post-nav .post-navigation -->
<?php endif; ?>