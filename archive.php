<?php if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<?php
  // Título do archive (Categoria, Tag, Autor, Data...)
  $archive_title = get_the_archive_title();
  $archive_desc  = get_the_archive_description();

  // Se for categoria, dá pra limpar "Categoria: "
  if (is_category()) {
    $archive_title = single_cat_title('', false);
  }

  // Hero (se quiser usar uma imagem fixa, dá pra por via CSS no .hero--archive)
?>
<section class="hero hero--archive">
  <div class="container hero-inner">
    <h1 class="hero-title"><?php echo wp_kses_post($archive_title); ?></h1>
  </div>
</section>

<section class="cards-grids section archive-grid">

  <?php
    // ===== BAR DE CATEGORIAS =====
    $cats = get_categories([
      'taxonomy'   => 'category',
      'hide_empty' => true,   // só com posts
      'orderby'    => 'name',
      'order'      => 'ASC',
    ]);

    if (!empty($cats)) :
  ?>
    <nav class="catsbar" aria-label="<?php echo esc_attr__('Categorias', 'portal-cliente'); ?>">
      <ul class="catsbar-list">

        <!-- "Todas" (link pro arquivo do blog, se existir; senão home) -->
        <?php
          $posts_page_id = (int) get_option('page_for_posts');
          $all_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
          $is_all_active = !is_category();
        ?>
        <li class="catsbar-item">
          <a class="catsbar-link <?php echo $is_all_active ? 'is-active' : ''; ?>" href="<?php echo esc_url($all_url); ?>">
            <?php echo esc_html__('Todas', 'portal-cliente'); ?>
          </a>
        </li>

        <?php foreach ($cats as $c): ?>
          <?php
            $active = (is_category() && get_queried_object_id() === (int) $c->term_id);
          ?>
          <li class="catsbar-item">
            <a class="catsbar-link <?php echo $active ? 'is-active' : ''; ?>" href="<?php echo esc_url(get_category_link($c->term_id)); ?>">
              <?php echo esc_html($c->name); ?>
            </a>
          </li>
        <?php endforeach; ?>

      </ul>
    </nav>
  <?php endif; ?>

  <?php if (!empty($archive_desc)) : ?>
    <div class="archive-desc">
      <?php echo wp_kses_post($archive_desc); ?>
    </div>
  <?php endif; ?>

  <?php if (have_posts()) : ?>
    <div class="grid">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/content', 'card'); ?>
      <?php endwhile; ?>
    </div>

    <div class="archive-pagination">
      <?php
        echo paginate_links([
          'prev_text' => '«',
          'next_text' => '»',
        ]);
      ?>
    </div>

  <?php else: ?>
    <p><?php echo esc_html__('Nenhum post encontrado.', 'portal-cliente'); ?></p>
  <?php endif; ?>

</section>

<?php get_footer(); ?>