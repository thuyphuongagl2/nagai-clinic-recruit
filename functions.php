<?php
// handle function
require_once "function/setup-theme.php";
require_once "function/register.php";
require_once "function/filter.php";
require_once "function/shortcode.php";
include('submenu.php');
// Define 
//// Domain Url
function displayDomain()
{
  global $domain;
  $domain = site_url();
  echo $domain;
}


// Get parent category slug
function get_parent_cat_slug()
{
  $cats = get_the_category();
  $cat = $cats[0];
  if ($cat->parent) {
    $parent = get_category($cat->parent);
    return $parent->slug;
  } else {
    return $cat->slug;
  }
}

// Keep the parent-child structure of categories on the posting screen
function solecolor_wp_terms_checklist_args($args, $post_id)
{
  if ($args['checked_ontop'] !== false) {
    $args['checked_ontop'] = false;
  }
  return $args;
}
add_filter('wp_terms_checklist_args', 'solecolor_wp_terms_checklist_args', 10, 2);



// Post-Type default term.
function mfields_set_default_object_terms($post_id, $post)
{
  if ('publish' === $post->post_status) {
    $defaults = array(
      'taxanomy_slug' => array('term_slug')
    );
    $taxonomies = get_object_taxonomies($post->post_type);
    foreach ((array) $taxonomies as $taxonomy) {
      $terms = wp_get_post_terms($post_id, $taxonomy);
      if (empty($terms) && array_key_exists($taxonomy, $defaults)) {
        wp_set_object_terms($post_id, $defaults[$taxonomy], $taxonomy);
      }
    }
  }
}
add_action('save_post', 'mfields_set_default_object_terms', 100, 2);



// Root directory relative link at custom menu link.
function wpd_nav_menu_link_atts($atts, $item, $args, $depth)
{
  if ('/root' == substr($atts['href'], 0, 5)) {
    $atts['href'] = get_home_url() . substr($atts['href'], 5);
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'wpd_nav_menu_link_atts', 20, 4);








