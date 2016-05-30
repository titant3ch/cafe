<?php /**
 * The template for displaying Archive pages.
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
						<?php if ( is_day() ) :
							printf( __( 'Daily Archives:', 'cafe' ) . '&nbsp;' . '%s', '<span>' . date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ) . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives:', 'cafe' ) . '&nbsp;' . '%s', '<span>' . get_the_date( 'F Y' ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives:', 'cafe' ) . '&nbsp;' . '%s', '<span>' . get_the_date( 'Y' ) . '</span>' );
						else :
							_e( 'Archives', 'cafe' );
						endif; ?>
					</h1>
				</header><!-- .search-result-header -->
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