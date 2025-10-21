<?php
$bannerLink = get_field('main_catch_image') ? get_field('main_catch_image') : get_stylesheet_directory_uri() . '/assets/img/part/mv-part.jpg';
?>
<?php

$temp_title = '';

if (is_page()) {
    global $post; // Ensure $post is available
    if ($post) {
        $temp_title = get_the_title();
    }

} elseif (is_category()) {
    // Get current category object
    $cats = get_queried_object();

    // Set temp_title to the category name
    $temp_title = $cats->name;

    // Check if the category has a parent
    if ($cats->parent) {
        // Get the parent category object
        $parent_cat = get_category($cats->parent);

    }

} elseif (is_singular(array('gallery', 'staff'))) { // Custom Post Type Detail
    global $post; // Ensure $post is available
    if ($post) {
        $post_type = get_post_type_object(get_post_type($post));
        $temp_title = $post_type->label;

    }

} elseif (is_single()) {
    // Get categories for the post
    $cats = get_the_category();
    
    if (!empty($cats)) { // Check if there are categories
        $cat = $cats[0]; // Get the first category of the post

        // Check if the category has a parent
        if ($cat->parent) {
            // Get the parent category object
            $parent = get_category($cat->parent);
            // Set temp_title to the parent category name
            $temp_title = $parent->name;

        } else {
            // If no parent, use the current category
            $temp_title = $cat->name;
        }
    }

} elseif (is_404()) {
    $temp_title = 'ページが見つかりません';

} else {
    $post_type = get_post_type_object(get_post_type());
    $temp_title = $post_type->label;
}

?>
<div class="pagehead">
    <div class="pagehead__inner">
        <div class="pagehead__img">
            <img src="<?php echo $bannerLink; ?>" alt="#" />
        </div>
        <div class="pagehead__textbox">
            <div class="pagehead__title">
                <div class="pagehead__title--en">Page title</div>
                <div class="pagehead__title--jp"><?php the_title() ?></div>
            </div>
        </div>
    </div>
</div>