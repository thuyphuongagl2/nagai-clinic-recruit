<div class="main_blog_container pt50">

<div class="main_blog_content">
<?php if(have_posts()) : ?>
	<!-- <h3 class="mb0"><?php
	$cats = get_queried_object();
	$cat = $cats->name;
	echo $cat;
	?></h3> -->
	<?php while(have_posts()) : the_post();?>
	<?php
		$current_category = get_the_category();
		$current_category_name = $current_category[0]->name;
		$current_category_id = get_cat_ID($current_category_name);
		$current_category_link = get_category_link( $current_category_id );
	?>
	<div class="blog_list_style01">
		<div class="item">
			<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>"><picture><?php the_post_thumbnail( 'medium_large', [ 'alt' => esc_html ( get_the_title() ) ] );?></picture></a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>"><picture><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/blog_logo.jpg" alt="<?php the_title() ?>"></picture></a>
			<?php endif; ?>
			<div class="info">
				<p class="date"><?php the_time('Y.m.d') ?>
					<span class="tag">
						<?php 
							foreach($current_category as $current_categorys) { 
								echo '<a href="' . get_category_link( $current_categorys->term_id ) . '" class="'.$current_categorys->slug.'">'.$current_categorys->name.'</a>';
							}
						?>
						
					</span>
				</p>
				<p class="ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
				<p class="des"><?php $excerpt = wp_trim_words(get_the_excerpt(), 55, '...'); echo $excerpt;?></p>
				<div class="btn01"><a class="btn01__txt" href="<?php the_permalink(); ?>"><span>続きを読む »</span></a></div>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
	
	
	<div id="pagination" class="pagination"><?php global $wp_rewrite;
		$paginate_base = get_pagenum_link(1);
		if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
			$paginate_format = '';
			$paginate_base = add_query_arg('paged', '%#%');
		}
		else {
			$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
			user_trailingslashit('page/%#%/', 'paged');;
			$paginate_base .= '%_%';
		}
		echo paginate_links( array(
			'base' => $paginate_base,
			'format' => $paginate_format,
			'prev_next' => True,
			'prev_text' => __(''),
			'next_text' => __(''),
			'total' => $wp_query->max_num_pages,
// 			'mid_size' => 5,
			'mid_size'  => 1, 
      'end_size'  => 1,
			'current' => ($paged ? $paged : 1),
		));
	?></div>


<?php elseif(! have_posts() ) :?>
	<p>記事がありません</p>
<?php else : ?>       
<?php endif; ?>



</div>
<div class="sidebar">
<?php dynamic_sidebar( 'category_sidebar' ); ?>
</div>

</div>