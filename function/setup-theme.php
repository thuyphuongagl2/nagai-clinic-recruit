<?php
// Organize head tags
remove_action('wp_head', 'wp_generator'); // generator
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // rel="shortlink"
remove_action('wp_head', 'wlwmanifest_link'); // WLW(Windows Live Writer) wlwmanifest.xml
remove_action('wp_head', 'rsd_link'); // RSD xmlrpc.php?rsd
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10); // rel="next"、rel="prev"
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles', 10);


// Enable RSS feed
add_theme_support('automatic-feed-links');

// Thumbnail settings
add_theme_support('post-thumbnails');

// Display thumbnails in RSS feed
function rss_post_thumbnail($content)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');

// Title tags
add_filter('wp_title', 'my_filter_title', 10);
function my_filter_title($title)
{
    return $title . get_bloginfo('name');
}

// Limit character of post content
function my_excerpt($length)
{
    global $post;
    $content = mb_substr(strip_tags($post->post_content), 0, $length);
    $content = '<a href="' . get_permalink() . '">' . $content . ' ... </a><div class="more"><a href="' . get_permalink() . '">続きを読む</a></div>';
    return $content;
}

// Enable visual editor style sheet
add_editor_style('/assets/css/editor-style.css');

// Disable plug-in style sheets
add_action('wp_print_styles', 'my_deregister_styles', 100);
function my_deregister_styles()
{
    wp_deregister_style('wp-pagenavi');
    wp_deregister_style('contact-form-7');
}

// Styles & Scripts
// async & defer
if (!is_admin()) {
    function add_asyncdefer_attribute($tag, $handle)
    {
        $param = '';
        if (strpos($handle, 'async') !== false) $param = 'async ';
        if (strpos($handle, 'defer') !== false) $param .= 'defer ';
        if ($param)
            return str_replace('<script ', '<script ' . $param, $tag);
        else
            return $tag;
    }
    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}
// Remove default jquery & default Styles
if (!is_admin()) add_action("wp_enqueue_scripts", "deregister_default_scripts", 11);
function deregister_default_scripts()
{
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery');
    wp_deregister_style('wp-block-library');
}

// Remove admin bar
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// Add editor style
function wpdocs_theme_add_editor_styles()
{
    add_editor_style('editor-style.css'); // When the style sheet for the management screen is changed, the file name and number are changed.
}
add_action('admin_init', 'wpdocs_theme_add_editor_styles');


// Disable error display
ini_set('display_errors', 'Off');

// Disable author page
add_action('template_redirect', 'disable_author_page');

function disable_author_page()
{
    global $wp_query;

    if (is_author()) {
        wp_redirect(get_option('home'), 301);
        exit;
    }
}
