<?php get_header(); ?>

<!--Home-->
<main class="home-page">
	<section class="hero">
		<h1 class="hero-title">Photographe Event</h1>
	</section>
	<section class="container">
		<?php get_template_part('template-parts/filters'); ?>
		<?php
		$args = array(
			'post_type' => 'photo',
			'posts_per_page' => 8,
			'orderby' => 'date',
			'order' => 'DESC',
		);

		$photos_query = new WP_Query($args);
		?>

		<?php if ($photos_query->have_posts()) : ?>
			<div class="gallery">
				<?php while ($photos_query->have_posts()) : $photos_query->the_post(); ?>
					<?php get_template_part('template-parts/gallery_item'); ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
		<button id="load-more" class="btn load-more">Charger plus</button>
	</section>
</main>

<?php get_footer(); ?>