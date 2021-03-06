<?php /**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */
get_header(); ?>
<div class="cafe-main">
	<?php while ( have_posts() ) : 
		the_post(); 
		get_template_part( 'content', 'page' );
		if ( comments_open() || get_comments_number() ) : 
			comments_template();
		endif;
	endwhile; ?>
</div> <!-- END OF div.cafe-main -->
<?php get_sidebar();
get_footer(); ?>