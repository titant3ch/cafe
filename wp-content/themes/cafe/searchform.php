<?php /**
 * The template for displaying search form
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */ ?>
<form class="cafe-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<input type="text" value="<?php echo get_search_query(); ?>" id="s" name="s" placeholder="<?php _e( 'Enter your searchword here', 'cafe' ); ?>">
	<input type="submit" id="searchSubmit"  value="">
</form>