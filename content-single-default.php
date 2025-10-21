<section class="blog-content">
    <?php if (have_posts()) : the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <div class="date"><?php the_time('Y.m.d') ?></div>
        <div class="entry">
            <?php the_content(); ?>
        </div>
        <?php
        $categories = get_the_category();
        $category_name = $categories[0]->cat_name;
        $category_id = $categories[0]->cat_ID;
        $category_link = get_category_link($category_id);
        ?>
        <div class="blog_post_button">
            <div class="prev"><?php previous_post_link('<span>%link</span>', '%title', TRUE); ?></div>
            <div class="cat"><a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name ?></a></div>
            <div class="next"><?php next_post_link('<span>%link</span>', '%title', TRUE); ?></div>
        </div>
    <?php endif; ?>

</section>