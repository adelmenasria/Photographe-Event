    <!--Footer-->
    <footer class="footer">
      <?php get_template_part('template-parts/modal'); ?>
      <?php get_template_part('template-parts/lightbox'); ?>
      <nav class="footer-nav">
        <?php
        wp_nav_menu([
          'theme_location' => 'footer-menu',
          'menu_class'     => 'footer-nav-list',
          'menu_id'        => 'footer-nav-list',
          'container'      => false
        ]);
        ?>
    </nav>
  </footer>
  <?php wp_footer() ?>
</body>
</html>