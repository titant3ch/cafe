<?php get_header(); ?>

<div id="pagina">

	<section class="container" id="single">

		<h1><?php the_title(); ?></h1>
		<hr>
		

		<?php while ( have_posts() ) : the_post() ?>
		<?php the_content(); ?>
		
		<?php endwhile; ?>

		<!-- <a href="#0" class="cd-top">Top</a> -->

	</section>

</div>

<?php get_footer(); ?>