<?php get_header(); ?>
	
<?php if (have_posts()) : the_post();
	switch (true) {
		case is_front_page():
			if (get_field('mainvisual')) {
				the_field('mainvisual');
			}
			get_template_part('content', 'page');
			break;
		case is_page():
			get_template_part('template-part/page-head');
			get_template_part('breadcrumb');
			echo '<article id="maincontent" class="maincontent">';
			echo '<div class="container">';
			if (is_page('sitemap')) {
				get_template_part('content', 'page-sitemap');
			} else {
				get_template_part('content', 'page');
			}
			echo '</div>';
			echo '</article>';
			break;
		default:
			break;
	}
?>

<?php endif; ?>

<?php get_footer(); ?>