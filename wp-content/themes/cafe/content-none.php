<?php /**
 * The template for displaying if no content.
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */ ?>
<article class="post">
	<header class="post-heading-section">
		<div class="cafe-black-box-no-thumbnail">
			<h1 class="cafe-post-title"><?php _e( 'Nothing Found', 'cafe' ); ?></h1>
		</div>
	</header>
	<div class="cafe-post-content">
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cafe' ); ?></p><br>
		<aside class="widget widget_search" id="searchform-no-results">
			<?php get_search_form(); ?>
		</aside>
	</div><!-- .entry-content -->
</article>