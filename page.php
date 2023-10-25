<?php

/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Photographe Event
 * @since Photographe Event 1.0
 */

get_header();
?>

<?php
while (have_posts()) : the_post();  // Début de la Boucle
?>

	<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<section class="page-content">
			<h1><?php the_title(); ?></h1>
			<div>
				<?php the_content(); ?>
			</div>
		</section>

	</main>

<?php
endwhile;  // Fin de la Boucle
?>

<?php get_footer(); ?>
