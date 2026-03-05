<?php if (!defined('ABSPATH')) exit; ?>

<article class="card">
  <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
    <div class="card-thumb">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('pc_card', ['loading' => 'lazy']); ?>
      <?php else: ?>
        <div class="card-thumb--placeholder"></div>
      <?php endif; ?>

      <span class="badge">
        <?php
          $cat = get_the_category();
          echo esc_html($cat ? $cat[0]->name : 'Conteúdos');
        ?>
      </span>
    </div>

    <div class="card-content">
      <h3>
        <?php
          $title = get_the_title();
          $title = str_replace(':', ":<br>", esc_html($title)); // quebra depois do :
          echo $title;
        ?>
      </h3>

      <p class="card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>

      <span class="read-more">LEIA MAIS »</span>
    </div>
  </a>
</article>