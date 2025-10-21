<?php
// Short code registration
function shortcode_url()
{
    return get_bloginfo('url');
}
add_shortcode('url', 'shortcode_url');

function shortcode_templateurl()
{
    return get_bloginfo('template_url');
}
add_shortcode('template_url', 'shortcode_templateurl');

// Enable shortcode in widget
add_filter('widget_text', 'do_shortcode');


// Shortcode to include theme file
function include_my_php($params = array())
{
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}
add_shortcode('include', 'include_my_php');

// Display Images
add_shortcode('source', 'source_img_func');

function source_img_func($atts)
{
    extract(shortcode_atts(array(
        "srcset" => 'none',
        "media" => '(max-width:768px)',
        "type" => ''

    ), $atts));
    $template = get_bloginfo('template_url');
    $pic_tag = '';
    if ($type) {
        $pic_tag = 'type="' . $type . '"';
    }
    if ($media) {

        $media_tag = 'media="' . $media . '"';
    }


    // return '<source srcset="' . $template . '/images/' . $srcset . '" ' . $media_tag . ' ' . $pic_tag . ' />';
    return '<source srcset="' . $template . $srcset . '" ' . $media_tag . ' ' . $pic_tag . ' />';
}


// Display Post

add_shortcode("list_item_post", "get_list_item_post");
function get_list_item_post($atts, $content = null)
{
    extract(shortcode_atts(array(
        "num" => '3',
        "cat" => 'news'
    ), $atts));
    global $post;
    $oldpost = $post;
    $myposts = get_posts('numberposts=' . $num . '&order=DESC&orderby=post_date&category_name=' . $cat);
    $retHtml = '<ul class="newsbox__list">';
    foreach ($myposts as $post) :
        $content = $post->post_content;
        $content = wp_strip_all_tags($content, true);
        if (mb_strlen($content, "utf-8") > 20) {
            $content = mb_substr($content, 0, 20, "utf-8") . '...';
        }

        setup_postdata($post);
        $retHtml .= '<li class="newsbox__item"><a class="newsbox__link" href="' . get_permalink() . '"><span class="newsbox__date">' . get_post_time('Y.m.d') . '</span><span class="newsbox__txt">' . strip_tags(the_title("", "", false)) . '</span></a></li>';
    endforeach;
    $retHtml .= '</ul>';
    $post = $oldpost;
    wp_reset_postdata();
    return $retHtml;
}

add_shortcode("list_item_column", "get_list_item_column");
function get_list_item_column($atts, $content = null)
{
    extract(shortcode_atts(array(
        "num" => '4',
        "cat" => 'column'
    ), $atts));
    global $post;
    $oldpost = $post;
    $myposts = get_posts('numberposts=' . $num . '&order=DESC&orderby=post_date&category_name=' . $cat);
    $retHtml = '';
    foreach ($myposts as $post) :
        $content = $post->post_content;
        $content = wp_strip_all_tags($content, true);
        // if (mb_strlen($content, "utf-8") > 20) {
        // 	$content = mb_substr($content, 0, 20, "utf-8") . '...';
        // }

        $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'medium_large');
        if (!$thumbnail_url) {
            $thumbnail_url  = get_template_directory_uri() . '/images/shared_blog_logo.png)';
        } else {
            $thumbnail_url  = $thumbnail_url;
        }

        setup_postdata($post);
        $retHtml .= '<div class="block_column_it">
						<div class="link"><a href="' . get_permalink() . '"></a></div>
						<figure class="block_column_img"><img src="' . $thumbnail_url . '" alt="' . strip_tags(the_title("", "", false)) . '" width="400" height="74" loading="lazy"></figure>
						<div class="block_column_cont">
							<p class="date">' . get_post_time('Y.m.d') . '</p>
							<p class="title">' . strip_tags(the_title("", "", false)) . '</p>
							<p class="cont">' . $content . '</p>
						</div>
					</div>';
    endforeach;
    $retHtml .= '';
    $post = $oldpost;
    return $retHtml;
}
