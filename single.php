<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage PhotographeEvent
 * @since Photographe Event 1.0
 */

get_header();
?>

<main id="content" role="main">

	<?php
	/* Start the Loop */
	while (have_posts()) :
		the_post();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			<div class="post-meta">
				<span class="post-author">By <?php the_author(); ?></span>
				<span class="post-date">On <?php the_date(); ?></span>
			</div>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>

		<footer class="entry-footer">
			<span class="post-categories"><?php the_category(', '); ?></span>
			<span class="post-tags"><?php the_tags(); ?></span>
		</footer>
	</article>

	<!-- Previous/Next Post Navigation -->
	<div class="post-navigation">
		<?php
		the_post_navigation(
			array(
				'next_text' => '<span class="nav-label">Next</span> %title',
				'prev_text' => '<span class="nav-label">Previous</span> %title',
			)
		);
		?>
	</div>

	<?php
	endwhile; // End of the loop.
	?>

</main>

<?php
get_footer();
?>