<?php header("X-UA-Compatible: IE=edge,chrome=1"); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=-100%, user-scalable=yes" />
  <meta name="format-detection" content="telephone=no">
  <title><?php wp_title('|', true, 'right'); ?></title>

  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/lib/aos/aos.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <?php if (is_front_page()) : ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <?php endif; ?>

  <?php wp_head(); ?>
</head>

<?php
$tag_h1 = get_field('tag_h1');
if (!$tag_h1) {
  $tag_h1 = get_the_title();
}
if (is_front_page()) {
  $my_body_class = 'home_page';
} else {
  $my_body_class = 'under';
  switch (true) {
    case is_page() && $post->post_parent: // Sub Page
      $parents = get_post_ancestors($post->ID);
      $id = ($parents) ? $parents[count($parents) - 1] : $post->ID;
      $parent = get_post($id);
      $parent_slug = $parent->post_name;
      $my_body_class .= " page-" . $parent_slug . '-' . $post->post_name;
      break;
    case is_page(): // Under Page
      $my_body_class .= " page-" . $post->post_name;
      break;
    case is_category(): // Category
      $parent_cat_slug = get_parent_cat_slug();
      $cat = get_the_category();
      $cat_slug = $cat[0]->slug;
      $my_body_class .= " page-" . $parent_cat_slug;
      $term = get_queried_object();
      $tag_h1 = get_field('tag_h1', $term);
      if (!$tag_h1) {
        $tag_h1 = $cat[0]->name;
      }
      break;
    case is_single(): // Detail
      $parent_cat_slug = get_parent_cat_slug();
      $cat = get_the_category();
      $cat_slug = $cat[0]->slug;
      $my_body_class .= " page-" . $parent_cat_slug;
      break;
    default: // Post Type Category / Taxonomy
      $post_type = get_post_type_object(get_post_type($post));
      if ($post_type) {
        $my_body_class .= " page-" . $post_type->name;
      }
      break;
  }
}
?>

<body class="<?php echo $my_body_class; ?>">
  <header class="header">
    <div class="header__inner">
      <div class="header__logoBox">
        <div class="header__logoItem">
          <a href="<?= get_home_url() ?>" class="header__logoLink">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/common/logo.png" class="header__logo-img" alt="Logo" />
          </a>
          <?php if ($tag_h1) {
            echo '<h1>' . $tag_h1 . '</h1>';
          } ?>
        </div>
      </div>

      <div class="header__content">
          <?php
          wp_nav_menu(array(
            'menu_class' => "menu",
            // 'container' => "ul",
            'container_class' => "header__nav",
            'theme_location' => "header_menu",
            // 'list_item_class'  => 'header__navItem',
            // 'link_class'   => 'header__navLink',
            'walker' => new Submenu_Wrap('pc')
          ));
          ?>
      </div>
    </div>

  </header>
  <main class="<?= (!is_front_page()) ? 'page' : 'top';  ?>">