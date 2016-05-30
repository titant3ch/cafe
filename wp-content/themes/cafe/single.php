<?php /**
 * The template for displaying all single posts
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */ 
get_header(); ?>
<div class="cafe-main">
	<?php if ( have_posts() ) : 
		while ( have_posts() ) : 
			the_post(); 
			get_template_part( 'content', get_post_format() );
			if ( comments_open() || get_comments_number() ): 
				comments_template();
			endif;
		endwhile;
	else :	
		get_template_part( 'content', 'none' );
	endif; ?>
</div> <!-- END OF div.cafe-main -->
<?php get_sidebar(); 
get_footer(); ?>