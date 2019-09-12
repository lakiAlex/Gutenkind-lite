<?php

$sidebar        = get_theme_mod('single-sidebar', 'right');
$cat_link		= get_theme_mod('single-cat-link', true);
$author         = get_theme_mod('single-author', true);
$date           = get_theme_mod('single-date', true);
$comments       = get_theme_mod('single-comments', true);
$thumb          = get_theme_mod('single-featured', true);
$format         = get_post_format() ? : 'standard';
$tags			= get_theme_mod('single-tags', true);
$comments		= get_theme_mod('single-comments-form', true);
$nav			= get_theme_mod('single-nav', true);
$related		= get_theme_mod('single-related', true);

?>

<div class="container voss-posts voss-sidebar-<?php echo esc_html($sidebar); ?>">
	<div class="voss-posts-content">
		<?php while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-header voss-single-header-standard">
					<div class="post-header">
						<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-meta">
							<?php
								if (function_exists('gutenkind_meta_author') && $author == true) gutenkind_meta_author();
								if (function_exists('gutenkind_meta_date') && $date == true) gutenkind_meta_date();
								if (function_exists('gutenkind_meta_comments') && $comments == true) gutenkind_meta_comments();
							?>
						</div>
						<?php if (has_post_thumbnail() && $thumb == true && $format == 'standard') { ?>
							<div class="post-media">
								<?php the_post_thumbnail('single'); ?>
							</div>
						<?php } ?>
					</div>
				</div>

				<div class="entry-content">
					<?php
						the_content();
						wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'gutenkind'),'after'  => '</div>',));
						if ($tags == true && function_exists('gutenkind_tags')) gutenkind_tags();
					?>
				</div>

				<div class="entry-footer">
					<?php
						if (function_exists('vossen_social_share')) vossen_social_share();
						if ($comments == true) if (comments_open() || get_comments_number()) comments_template();
						if ($nav == true) get_template_part( 'parts/post/post', 'nav' );
						if ($related == true) get_template_part( 'parts/post/post', 'related' );
					?>
				</div>
			</article>

		<?php endwhile; ?>
	</div>

	<?php if ($sidebar !== 'none') get_sidebar(); ?>

</div>
