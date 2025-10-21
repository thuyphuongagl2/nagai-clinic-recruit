<?php get_header(); ?>

<?php
echo '<div class="inner">';
get_template_part('template-part/page-head');
echo '<div id="maincontent" class="maincontent">';
echo '<div class="container">';
/* 
case :
	in_category( array('category_name') ) - Default Post + Different Category
	is_singular( array('post_type_name') ) - Custom Post + Any Term
		+ Specific Term
			$terms = get_the_terms( $post->ID, taxonomy );
			if ( $terms[0]->name == 'term_name' )
*/
get_template_part('content', 'single-default');
?>
<?php echo '</div>'; ?>
<?php echo '</div>'; ?>
<?php echo '</div>'; ?>
<?php get_footer(); ?>
