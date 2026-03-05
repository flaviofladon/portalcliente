<?php if (!defined('ABSPATH')) exit; ?>

<section class="container container-mobile section posts-grid">
  <?php
    $q = new WP_Query([
      'post_type' => 'post',
      'posts_per_page' => 6,
      'ignore_sticky_posts' => true,
    ]);
  ?>

  <?php if ($q->have_posts()) : ?>
    <div class="grid">
      <?php while ($q->have_posts()) : $q->the_post(); ?>
        <?php get_template_part('template-parts/content', 'card'); ?>
      <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
  <?php else: ?>
    <p>Nenhum post encontrado.</p>
  <?php endif; ?>
</section>