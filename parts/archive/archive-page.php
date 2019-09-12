<?php

$layout         = get_theme_mod('archive-page-layout', 'masonry');
$sidebar 		= get_theme_mod('archive-page-sidebar', 'none');
$nav 			= get_theme_mod('archive-page-nav', 'load');

$featured 		= get_theme_mod('archive-page-featured', true);
$thumb 			= get_theme_mod('archive-page-thumb', true);
$cat_link 		= get_theme_mod('archive-page-cat-link', true);
$excerpt 		= get_theme_mod('archive-page-excerpt', true);
$excerpt_length = get_theme_mod('archive-page-excerpt-length', '6');
$more 			= get_theme_mod('archive-page-more', true);

$classes[] = 'voss-ajax-'.$nav;
$classes[] = 'voss-sidebar-'.$sidebar;

$i = 0;

?>

<div class="container">

	<?php
		if (is_archive()) {
			get_template_part('parts/archive/archive', 'header');
			if (is_author()) get_template_part('parts/post/post', 'author');
			if ($featured == true) get_template_part('parts/archive/archive', 'featured');
		}
	?>

	<div class="voss-posts <?php echo esc_html(implode(' ', $classes)); ?>">
	    <div class="voss-posts-content">
	        <div class="voss-layout voss-layout-<?php echo esc_html($layout); ?>" <?php if ($layout == 'masonry') { ?>data-col="3"<?php } ?>> <?php

	            if (have_posts()) {

	                while (have_posts()) : the_post();

						if (is_sticky()) {
							get_template_part('parts/content/content', 'sticky');
						} else { ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-post grid-post'); ?>>
	                    		<?php 
	                    		    $thumb_size = in_array($i, array(1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21)) ? $thumb_size = 'landscape' : 'portrait';
									 
	                                if (has_post_thumbnail() && $thumb == true) { ?>
	                        			<div class="post-media">
	                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	                        				    <?php
													gutenkind_post_icon();
													the_post_thumbnail($thumb_size, array('alt' => get_the_title()));
												?>
	                                        </a>
	                        			</div> <?php
	                        		}
	                            ?>
								<div class="post-content">
									<?php if (function_exists('gutenkind_meta_cat') && $cat_link == true) gutenkind_meta_cat(); ?>
									<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php 
										if ($excerpt == true) gutenkind_excerpt($excerpt_length); 
										if ($more == true) { ?>
											<a class="post-more link" href="<?php echo esc_url(get_permalink()); ?>">
												<?php esc_html_e('Read More', 'gutenkind'); ?>
											</a><?php
										}
									?>
								</div>
	                        </article><?php

							
						}

					$i++;
	                endwhile;
	            } else {
                    get_template_part( 'parts/content/content', 'none' );
                } ?>

	        </div>

	        <?php gutenkind_pagination($nav); ?>

	    </div>

	    <?php if ($sidebar == 'left' || $sidebar == 'right') get_template_part('sidebar'); ?>

	</div>

</div> <?php
