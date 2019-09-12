<article id="post-<?php the_ID(); ?>" <?php post_class('sticky-post'); ?>>
	<div class="sticky-post-wrap" data-bg="<?php echo gutenkind_thumb_url('fullscreen'); ?>">
		<?php gutenkind_post_icon(); ?>
		<div class="post-content">
			<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="entry-meta">
				<?php
					if (function_exists('gutenkind_meta_author')) gutenkind_meta_author();
					if (function_exists('gutenkind_meta_date')) gutenkind_meta_date();
					if (function_exists('vossen_meta_views') && in_array(true, $views)) vossen_meta_views();
					if (function_exists('vossen_meta_read') && in_array(true, $read_time)) vossen_meta_read();
					if (function_exists('gutenkind_meta_comments') && in_array(true, $comments)) gutenkind_meta_comments();
				?>
			</div>
			<div class="post-more-wrap">
				<a class="post-more button" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('View Post', 'gutenkind-lite'); ?></a>
			</div>
		</div>
	</div>
</article>
