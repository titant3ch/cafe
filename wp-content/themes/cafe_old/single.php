<?php get_header(); ?>

<div id="post">

	<section class="container" id="single">

		<h4><?php the_time('M'); ?><br><?php the_time('j'); ?></h4>

		<hr>

		<h1><?php the_title(); ?></h1>

		<?php while ( have_posts() ) : the_post() ?>
		<article>
		    <?php the_content(); ?>
		</article>
		
		<?php endwhile; ?>

		<a href="#0" class="cd-top">Top</a>

	</section>

</div>

<?php get_footer(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/backtotop.js"></script>