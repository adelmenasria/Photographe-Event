<?php

/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage PhotographeEvent
 * @since Photographe Event 1.0
 */

get_header();
?>

<main id="content" role="main">

  <!-- Default content -->
  <section id="default-content">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_title('<h2>', '</h2>');
        the_content();
      endwhile;
    else :
      echo '<p>' . __('Sorry, no posts matched your criteria.', 'PhotoEvent') . '</p>';
    endif;
    ?>
  </section>

</main>

<?php
get_footer();
?>