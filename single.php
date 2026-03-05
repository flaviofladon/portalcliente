<?php if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php
// Hero = imagem destacada
$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

// Categoria + tags
$cat  = get_the_category();
$tags = get_the_tags();

// Ícones via ACF (se existir)
$icon_calendar = function_exists('get_field') ? get_field('pc_icon_calendar', 'option') : '';
$icon_tag      = function_exists('get_field') ? get_field('pc_icon_tag', 'option') : '';

// fallback SVG do tema
$theme_uri = get_template_directory_uri();
$icon_calendar_fallback = $theme_uri . '/assets/icons/calendar.svg';
$icon_tag_fallback      = $theme_uri . '/assets/icons/tags.svg';
?>

<!-- HERO -->
<section class="hero hero--post" style="<?php echo $hero_image ? 'background-image:url(' . esc_url($hero_image) . ');' : ''; ?>">
  <div class="container hero-inner"></div>
</section>

<!-- Conteúdo -->
<section class="container post-wrap">
  <article class="post-sheet">

    <?php if (has_post_thumbnail()) : ?>
      <div class="post-cover">
        <?php the_post_thumbnail('pc_cover', ['loading' => 'lazy']); ?>
      </div>
    <?php endif; ?>

    <?php if ($cat): ?>
      <div class="post-catline">
        <span class="post-cat"><?php echo esc_html($cat[0]->name); ?></span>
      </div>
    <?php endif; ?>

    <div class="post-metaline">

      <!-- DATA -->
      <span class="meta-item">

        <span class="meta-ico" aria-hidden="true">
          <img
            src="<?php echo esc_url($icon_calendar ? $icon_calendar : $icon_calendar_fallback); ?>"
            class="meta-ico-img"
            alt=""
          >
        </span>

        <span class="post-date">
          <?php echo esc_html(get_the_date('d F, Y')); ?>
        </span>

      </span>

      <!-- TAGS -->
      <?php if ($tags): ?>
      <span class="meta-item">

        <span class="meta-ico" aria-hidden="true">
          <img
            src="<?php echo esc_url($icon_tag ? $icon_tag : $icon_tag_fallback); ?>"
            class="meta-ico-img"
            alt=""
          >
        </span>

        <span class="post-tags">
          <?php
          $names = wp_list_pluck($tags, 'name');
          echo esc_html(implode(', ', $names));
          ?>
        </span>

      </span>
      <?php endif; ?>

    </div>

    <h1 class="post-title"><?php the_title(); ?></h1>

    <div class="post-author">
      Autor: <?php echo esc_html(get_the_author()); ?>
    </div>

    <div class="post-content">
      <?php the_content(); ?>
    </div>

  </article>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>