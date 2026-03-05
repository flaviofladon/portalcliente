<?php if (!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="topbar">
    <div class="container container-mobile topbar-inner">

      <div class="brand">
        <?php
          $logo_header = get_theme_mod('pc_logo_header');
          if ($logo_header) :
        ?>
          <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>">
            <img class="brand-img" src="<?php echo esc_url($logo_header); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
          </a>
        <?php else: ?>
          <a class="brand-text" href="<?php echo esc_url(home_url('/')); ?>">
            <?php bloginfo('name'); ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- MENU (meio no desktop) -->
      <nav id="site-nav" class="main-nav" aria-label="<?php echo esc_attr__('Menu principal', 'portal-cliente'); ?>">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'fallback_cb'    => false,
            'depth'          => 1,
          ]);
        ?>
      </nav>

      <?php
        $cta_text = function_exists('get_field') ? get_field('pc_topbar_cta_text', 'option') : '';
        $cta_url  = function_exists('get_field') ? get_field('pc_topbar_cta_url', 'option')  : '';
        if (!$cta_text) $cta_text = 'SOBRE NÓS';
        if (!$cta_url)  $cta_url  = home_url('/sobre-nos');
      ?>

      <a class="topbar-cta" href="<?php echo esc_url($cta_url); ?>">
        <?php echo esc_html($cta_text); ?>
      </a>

      <!-- HAMBÚRGUER (só mobile) -->
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav-panel">
        <span class="nav-toggle__line"></span>
        <span class="nav-toggle__line"></span>
        <span class="nav-toggle__line"></span>
        <span class="sr-only">Abrir menu</span>
      </button>

    </div>

    <!-- PAINEL DO MENU (mobile) -->
    <div id="site-nav-panel" class="nav-panel" aria-hidden="true">
      <div class="container container-mobile nav-panel-inner">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'nav-menu-mobile',
            'fallback_cb'    => false, // <<< IMPORTANTE: tira o wp_page_menu (bolinhas)
            'depth'          => 1,
          ]);
        ?>
      </div>
    </div>

  </div>
</header>

<main class="site-main">