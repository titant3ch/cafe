<?php /**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div class="cafe-main-and-sidebar">
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="cafe-site-wrapper">
			<div class="cafe-site-header cafe-clearfix">
				<?php if ( get_header_image() ) : ?>
					<div class="cafe-custom-header cafe-clearfix">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
					</div>
				<?php endif; ?>
				<div class="cafe-site-header-container cafe-clearfix">
					<header class="cafe-site-title-desctiption cafe-clearfix">
						<h1 class="cafe-site-title"><a href="<?php echo esc_url( home_url() ); ?>/"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="cafe-site-description"><?php bloginfo( 'description' ); ?></h2>
					</header>
					<nav id="cafe-main-menu" class="cafe-main-navigation">
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_class'     => 'nav-menu' 
						) ); ?>
					</nav>
					<div class="cafe-clear"></div>
				</div> <!-- END of .cafe-site-header-container -->
			</div> <!-- END of .cafe-site-header -->
			<div class="cafe-site-content" id="cafe-content">
				<div class="cafe-breadcrumbs">
					<?php do_action( 'cafe_breadcrumb_output' ); ?>
				</div>
				<div class="cafe-main-and-sidebar">
					<!-- END of header.php -->