<?php

// Widget
add_action('widgets_init', 'theme_widgets');
function theme_widgets()
{
    register_sidebar(array(
        'name' => __('Copyright', 'theme-slug'),
        'id' => 'copyright',
        'before_widget' => '',
        'after_widget'  => '',
    ));
    register_sidebar( array(
        'name' => __( 'category_sidebar', 'theme-slug' ),
        'id' => 'category_sidebar',
				'before_widget' => '',
				'after_widget'  => '',
    ) );
}

// Register custom menu
function register_my_menus()
{
    register_nav_menus(
        array(
            'header_menu' => 'ヘッダーメニュー',
            'footer_menu1' => 'フッターメニュー1',
            'footer_menu2' => 'フッターメニュー2',
            'footer_menu3' => 'フッターメニュー3',
            'footer_menu4' => 'フッターメニュー4',
            'footer_menu5' => 'フッターメニュー5',
            'footer_menu6' => 'フッターメニュー6',
						'sitemap' => 'サイトマップ'
        )
    );
}
add_action('init', 'register_my_menus');

// navigation: add li tag class 
// function add_menu_list_item_class($classes, $item, $args)
// {
//     if (property_exists($args, 'list_item_class')) {
//         $classes[] = $args->list_item_class;
//     }
//     return $classes;
// }
// add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

// // navigation: add a tag class 
// function add_menu_link_class($atts, $item, $args)
// {
//     if (property_exists($args, 'link_class')) {
//         $atts['class'] = $args->link_class;
//     }
//     return $atts;
// }
// add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);
// Advanced Custom Fields Option Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Gallery Option',
		'menu_title'	=> 'Gallery Option',
		'parent_slug'	=> 'edit.php?post_type=gallery',
	));
	
}