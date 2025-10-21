<?php
//　Remove extra elements in the image
add_filter('image_send_to_editor', 'remove_image_attribute', 10);
add_filter('post_thumbnail_html', 'remove_image_attribute', 10);

function remove_image_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
  //	$html = preg_replace( '/class=[\'"]([^\'"]+)[\'"]/i', '', $html );　クラスは残す
  $html = preg_replace('/title=[\'"]([^\'"]+)[\'"]/i', '', $html);
  //	$html = preg_replace( '/<a href=".+">/', '', $html );
  //	$html = preg_replace( '/<\/a>/', '', $html );
  return $html;
}

// Create an initialization array for TinyMCE
function _my_tinymce($initArray)
{
  // Change selectable block elements
  $initArray['theme_advanced_blockformats'] = 'p,h3,h4,h5,dt,dd,div';
  return $initArray;
}
// To be executed after TMA
add_filter('tiny_mce_before_init', '_my_tinymce', 10000);

// Prevent disappearance of empty tags with visual editor
function pnd_allow_all_attr($init)
{
  $ext_elements = '';

  $target_elements = array(
    'p', 'a', 'b', 'base', 'big', 'blockquote', 'body', 'br', 'caption', 'dd', 'div', 'dl',
    'dt', 'em', 'embed', 'font', 'form', 'h', 'head',  'hr', 'html', 'i', 'img', 'input',
    'li', 'link', 'meta', 'nobr', 'noembed', 'object', 'ol', 'option', 'p', 'pre', 's',
    'script', 'select', 'small',  'span', 'strike', 'strong', 'sub', 'sup', 'table',
    'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'title', 'tr', 'tt', 'u', 'ul',
    'iframe'
  );
  $target_attr = array(
    '*'
  );

  foreach ($target_elements as $target_element) {
    $ext_elements .= "," . $target_element . "[" . implode('|', $target_attr) . "]";
  }

  if (!empty($ext_elements)) {
    if (!empty($init['extended_valid_elements']))
      $init['extended_valid_elements'] .= $ext_elements;
    else
      $init['extended_valid_elements'] = trim($ext_elements, ',');
  }

  return $init;
}
add_filter('tiny_mce_before_init', 'pnd_allow_all_attr', 100);

add_filter('the_excerpt', 'wpautop');

// Plugins Modify
// SEO Title Remove All Tags
add_filter('aioseop_title', 'change_wordpress_seo_title');
function change_wordpress_seo_title($title)
{
  $title = strip_tags($title);
  return $title;
}
// wpcf7
add_filter('wpcf7_autop_or_not', '__return_false');

// Prevent WP from adding <p> tags on all post types
// function disable_wp_auto_p($content)
// {
//   remove_filter('the_content', 'wpautop');
//   remove_filter('the_excerpt', 'wpautop');
//   return $content;
// }
// add_filter('the_content', 'disable_wp_auto_p', 0);
