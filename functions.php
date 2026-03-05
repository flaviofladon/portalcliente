<?php
if (!defined('ABSPATH')) exit;

/* =========================================================
   THEME SETUP
   ========================================================= */

function pc_theme_setup() {

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  add_theme_support('custom-logo', [
    'height'       => 60,
    'width'        => 220,
    'flex-height'  => true,
    'flex-width'   => true,
  ]);

  add_theme_support('html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script'
  ]);

  register_nav_menus([
    'primary' => __('Menu Principal', 'portal-cliente'),
    'footer'  => __('Menu Rodapé', 'portal-cliente'),
  ]);

  add_image_size('pc_card', 640, 400, true);
  add_image_size('pc_cover', 1200, 675, true);
}
add_action('after_setup_theme', 'pc_theme_setup');


/* =========================================================
   ENQUEUE CSS / JS
   ========================================================= */

function pc_enqueue_assets() {

  /* Roboto */
  wp_enqueue_style(
    'pc-fonts',
    'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap',
    [],
    null
  );

  /* usa minificado se não estiver em debug */
  $min = defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';

  $css_file = "/assets/css/main{$min}.css";
  $js_file  = "/assets/js/main{$min}.js";

  $css_path = get_template_directory() . $css_file;
  $js_path  = get_template_directory() . $js_file;

  $css_ver = file_exists($css_path) ? filemtime($css_path) : '1.0.0';
  $js_ver  = file_exists($js_path)  ? filemtime($js_path)  : '1.0.0';

  wp_enqueue_style(
    'pc-main',
    get_template_directory_uri() . $css_file,
    ['pc-fonts'],
    $css_ver
  );

  wp_enqueue_script(
    'pc-main',
    get_template_directory_uri() . $js_file,
    [],
    $js_ver,
    true
  );
}
add_action('wp_enqueue_scripts', 'pc_enqueue_assets');


/* =========================================================
   WIDGETS
   ========================================================= */

function pc_widgets_init() {

  register_sidebar([
    'name'          => __('Rodapé', 'portal-cliente'),
    'id'            => 'footer-1',
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="footer-title">',
    'after_title'   => '</h4>',
  ]);

}
add_action('widgets_init', 'pc_widgets_init');


/* =========================================================
   EXCERPT
   ========================================================= */

add_filter('excerpt_length', function() {
  return 16;
}, 999);

add_filter('excerpt_more', function() {
  return '';
});


/* =========================================================
   BODY CLASS
   ========================================================= */

add_filter('body_class', function($classes){
  $classes[] = 'pc-theme';
  return $classes;
});


/* =========================================================
   CUSTOMIZER (LOGOS)
   ========================================================= */

function pc_customize_register($wp_customize){

  $wp_customize->add_section('pc_logos', [
    'title' => 'Logos do Tema'
  ]);

  /* logo header */

  $wp_customize->add_setting('pc_logo_header');

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'pc_logo_header',
      [
        'label'    => 'Logo do Cabeçalho',
        'section'  => 'pc_logos',
        'settings' => 'pc_logo_header'
      ]
    )
  );

  /* logo footer */

  $wp_customize->add_setting('pc_logo_footer');

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'pc_logo_footer',
      [
        'label'    => 'Logo do Rodapé',
        'section'  => 'pc_logos',
        'settings' => 'pc_logo_footer'
      ]
    )
  );

}
add_action('customize_register','pc_customize_register');


/* =========================================================
   OTIMIZAÇÕES (SEGURAS)
   ========================================================= */

/* remove emojis */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/* remove wp-embed */
add_action('wp_footer', function(){
  wp_deregister_script('wp-embed');
});

/* remove resource hints */
remove_action('wp_head', 'wp_resource_hints', 2);

/* remove versão WP */
remove_action('wp_head', 'wp_generator');

/* remove feed links */
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

/* remove shortlink */
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

/* remove RSD e WLW */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');


/* =========================================================
   CACHE HEADERS (se o servidor permitir)
   ========================================================= */

add_action('send_headers', function(){

  if (is_admin()) return;

  header_remove('Pragma');
  header('Cache-Control: public, max-age=31536000, immutable');

}, 1);