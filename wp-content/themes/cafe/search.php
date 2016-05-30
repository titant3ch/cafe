<?php /**
 * The template for displaying Search Results pages.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */
get_header(); ?>
	<div class="cafe-main">
		<article class="search-result">
			<header class="search-result-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for:', 'cafe' ) . '&nbsp;' . '%s', get_search_query() ); ?></h1>
			</header>
		</article>
		<?php if ( have_posts() ) :
			while ( have_posts() ) : 
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