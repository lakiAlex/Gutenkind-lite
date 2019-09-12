<?php

// Query
global $wp_query;
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

// Latest posts query
$args = array(
    'posts_per_page' 			=> '12',
    'post_type'					=> 'post',
    'post_status'				=> 'publish',
    'orderby'					=> 'date',
    'paged'                     => $paged,
);

$posts = new WP_Query( $args );
$temp_query = $wp_query;
$wp_query = $posts;
$i = 0;

?>

<div class="block__posts voss-posts voss-ajax-load">
    <div class="voss-posts-content">

        <div class="block__title text-center">
            <h3><?php esc_html_e('Latest Stories', 'gutenkind-lite'); ?></h3>
            <a class="block__link link" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">
                <?php esc_html_e('View All', 'gutenkind-lite'); ?>
            </a>
        </div>

        <div class="voss-layout voss-layout-masonry" data-col="3"> <?php

            if ($posts->have_posts()) {
                $i = 0;
                while ($posts->have_posts()) { $posts->the_post();

                    if (is_sticky()) {
                        get_template_part('parts/content/content', 'sticky');
                    } else {
                        if (in_array($i, array(1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21))) {
                            $thumb_size = 'landscape';
                        } else {
                            $thumb_size = 'portrait';
                        } ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-post'); ?>>
                    		<?php
                                if( has_post_thumbnail() ) { ?>
                        			<div class="post-media">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        				    <?php the_post_thumbnail($thumb_size); ?>
                                        </a>
                        			</div> <?php
                        		}
                            ?>
                            <div class="post-content">
                            	<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
                            	<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            	<div class="entry-meta">
                            		<?php
                            			if (function_exists('gutenkind_meta_author')) gutenkind_meta_author();
                            			if (function_exists('gutenkind_meta_date')) gutenkind_meta_date();
                            		?>
                            	</div>
                            </div>
                        </article><?php
                    }

                $i++;
                }
            } ?>

        </div>

        <?php gutenkind_pagination('load'); ?>

    </div>

</div><?php

// Reset
$wp_query = $temp_query;

wp_reset_query();
wp_reset_postdata();