<?php
if (!defined('ABSPATH')) exit;

global $post;

$hero_image = get_the_post_thumbnail_url($post->ID, 'full');
$title = get_the_title($post->ID);
?>

<section class="hero" style="background-image:url('<?php echo esc_url($hero_image); ?>')">

  <div class="container container-mobile hero-inner">
    <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
  </div>

</section>