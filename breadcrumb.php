<div class="breadcrumb__contain">
	<div class="breadcrumb">
		<?php global $post;

		// Front Page
		if (is_front_page()) { ?>
			<!-- Breadcrumb is not needed for front page -->
		<?php }


		// Sub Page
		elseif (is_page()) { ?>
			<ul>
				<li class="home"><a href="<?php displayDomain(); ?>">HOME</a><span>&gt;</span></li>
				<?php if ($post->post_parent != 0) : /* 親ページの有無 */ ?>
					<?php $ancestors = array_reverse($post->ancestors); /* 祖先ページの ID を取得 */ ?>
					<?php foreach ($ancestors as $ancestor) : /* 祖先ページの数だけ繰り返し処理 */ ?>
						<!--<li><span>&gt;</span><a href="<?php echo get_permalink($ancestor); ?>"><?php echo get_the_title($ancestor); ?></a></li>-->
					<?php endforeach; ?>
				<?php endif; ?>
				<li><?php echo strip_tags($post->post_title); ?></li>
			</ul>

		<?php }


		// Category
		elseif (is_category()) { ?>
			<?php $cat = get_queried_object(); ?>
			<ul>
				<li class="home"><a href="<?php displayDomain(); ?>">HOME</a><span>&gt;</span></li>
				<?php if ($cat->parent != 0) : /* 親カテゴリーの有無 */ ?>
					<?php $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category')); /* 祖先カテゴリーの取得 */ ?>
					<?php foreach ($ancestors as $ancestor) : /* 親カテゴリーの数だけ繰り返し処理 */ ?>
						<li><a href="<?php echo get_category_link($ancestor); ?>"><?php echo get_cat_name($ancestor); ?></a><span>&gt;</span></li>
					<?php endforeach; ?>
				<?php endif; ?>
				<li><?php echo $cat->cat_name; ?></li>
			</ul>

		<?php }


		// Taxonomy
		elseif (is_tax()) { ?>
			<?php
			$term = get_queried_object();
			$term_name = $term->name;
			$taxanomy = get_taxonomy($term->taxonomy);
			$post_type = get_post_type_object($taxanomy->object_type[0]);
			$post_type_label = $post_type->label;
			$post_type_name = $post_type->name;
			$post_type_link = get_post_type_archive_link($post_type_name);
			?>
			<ul>
				<li class="home"><a href="<?php displayDomain(); ?>">HOME</a><span>&gt;</span></li>
				<li><a href="<?php echo $post_type_link; ?>"><?php echo $post_type_label; ?></a><span>&gt;</span></li>
				<li><?php echo $term_name; ?></li>
			</ul>
		<?php }


		// Single
		elseif (is_single()) { ?>
			<?php
			$current_category = get_the_category();
			$current_category_name = $current_category[0]->name;
			$current_category_id = get_cat_ID($current_category_name);
			$current_category_link = get_category_link($current_category_id);

			$category_parent_id = $current_category[0]->category_parent;
			$category_parent_name = "";
			if ($category_parent_id != 0) {
				$category_parent = get_term($category_parent_id, 'category');
				$category_parent_name = $category_parent->name;
				$category_parent_link = get_category_link($category_parent_id);
			}
			?>
			<ul>
				<li class="home"><a href="<?php displayDomain(); ?>">HOME</a><span>&gt;</span></li>
				<?php if ($category_parent_name) { ?>
					<li><a href="<?php echo $category_parent_link; ?>"><?php echo $category_parent_name; ?></a><span>&gt;</span></li>
				<?php }


				// Post Type Single
				if (is_singular(array('gallery', 'staff'))) { ?>
					<?php
					$post_id = $post->ID;
					$post_type = get_post_type_object(get_post_type($post));
					$post_type_label = $post_type->label;
					$post_type_name = $post->post_type;
					$post_type_link = get_post_type_archive_link($post_type_name);
					?><li><a href="<?php echo $post_type_link; ?>"><?php echo $post_type_label; ?></a><span>&gt;</span></li><?php
																																																									$taxonomy = $post_type_name . '_cat';
																																																									$terms =  wp_get_post_terms($post_id, $taxonomy);
																																																									asort($terms);

																																																									foreach ($terms as $term) :
																																																										$term_id = $term->term_id;
																																																										$term_name = $term->name;
																																																										$term_link = get_term_link($term_id, $taxonomy);

																																																									?><li><a href="<?php echo $term_link; ?>"><?php echo $term_name; ?></a><span>&gt;</span></li><?php
																																																																																																							endforeach;
																																																																																																								?>
				<?php }
				// Default Post Single
				else { ?>
					<li><a href="<?php echo $current_category_link; ?>"><?php echo $current_category_name; ?></a><span>&gt;</span></li>
				<?php } ?>

				<li><?php
						$title = wp_strip_all_tags($post->post_title, true);
						$title = (mb_strlen($title) > 20) ? mb_substr($title, 0, 20) . '･･･' : $title;
						echo $title;
						?></li>
			</ul>

		<?php }


		// File not found
		elseif (is_404()) { ?>
			<ul>
				<li class="home"><a href="<?php displayDomain(); ?>">HOME</a><span>&gt;</span></li>
				<li>404 ページが見つかりません</li>
			</ul>

		<?php }


		// Post Type Arvhive
		elseif (is_post_type_archive()) {
			$post_type = get_post_type_object(get_post_type($post)); ?>
			<ul>
				<li class="home"><a href="<?php displayDomain(); ?>">HOME</a><span>&gt;</span></li>
				<li><?php echo $post_type->label; ?></li>
			</ul>
		<?php } ?>



	</div>
</div>