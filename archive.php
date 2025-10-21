<?php get_header(); ?>

<?php
echo '<div class="inner">';
get_template_part('template-part/page-head');
echo '<div id="maincontent" class="maincontent">';
echo '<div class="container">';
/* 
case :
	is_post_type_archive('taxonomy') - Custom Post + Any Term
	
*/
get_template_part('content', 'archive-default');
?>
<?php echo '</div>'; ?>
<?php echo '</div>'; ?>
<?php echo '</div>'; ?>
<?php get_footer(); ?>