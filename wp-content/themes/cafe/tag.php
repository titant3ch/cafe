<?php /**
 * The template for displaying Tag pages.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */
get_header(); ?>
	<div class="cafe-main">
		<?php if ( have_posts() ) : ?>
			<article class="search-result">
				<header class="search-result-header">
					<h1 class="page-title">
						<?php printf( __( 'Posts with Tag:', 'cafe' ) . '&nbsp;' . '%s', '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
					</h1>
				</header>
			</article>		
			<?php while ( have_posts() ) : 
				the_post(); 
				get_template_part( 'content', get_post_format() );
			endwhile;
			do_action( 'cafe_page_nav' );
		else : 
			get_template_part( 'content', 'none' );
		endif; ?>
	</div> <!-- END OF div.cafe-main -->
<?php get_sidebar();
get_footer(); ?>