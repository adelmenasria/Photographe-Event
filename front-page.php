<?php get_header(); ?>

<!--Front-Page-->
<main class="home-page">
	<?php get_template_part('template-parts/front-page/hero'); ?>
	<section class="container">
		<?php get_template_part('template-parts/gallery/filters'); ?>
		<div class="gallery">
			<?php
			$args = array(
				'post_type' => 'photo',
				'posts_per_page' => 8,
				'orderby' => 'date',
				'order' => 'DESC',
			);

			$photos_query = new WP_Query($args);

			if ($photos_query->have_posts()) :
				while ($photos_query->have_posts()) : $photos_query->the_post();
					get_template_part('template-parts/gallery/gallery_item');
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<button id="load-more" class="btn load-more">Charger plus</button>
	</section>
</main>

<?php get_footer(); ?>