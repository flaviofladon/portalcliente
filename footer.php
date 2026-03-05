<?php if (!defined('ABSPATH')) exit; ?>
</main>

<footer class="site-footer">

  <div class="footerbar">
    <div class="container">

      <div class="footerbar-inner">

        <?php
        $logo = get_theme_mod('pc_logo_footer');
        if ($logo):
        ?>

        <img src="<?php echo esc_url($logo); ?>" class="footer-img">

        <?php endif; ?>

      </div>

      <div class="footer-bottom">

        <div></div>

        <div class="footer-copy">
          © <?php echo date('Y'); ?>. Todos os direitos reservados.
        </div>

      </div>

    </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>