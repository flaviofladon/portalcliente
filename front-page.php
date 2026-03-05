<?php get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

  <?php get_template_part('template-parts/hero', 'page'); ?>

  <?php if (trim(get_the_content())) : ?>
    <section class="container container-mobile section page-content">
      <?php the_content(); ?>
    </section>
  <?php endif; ?>

<?php endif; ?>

<?php get_template_part('template-parts/posts-grid'); ?>

<?php get_footer(); ?>