<?php

// Query
global $wp_query;
$args = array(
    'posts_per_page' 			=> '12',
    'post_type'					=> 'post',
    'post_status'				=> 'publish',
    'orderby'					=> 'date',
);
$posts = new WP_Query( $args );
$temp_query = $wp_query;
$wp_query = $posts;
$i = 0;

// Loop
if ($posts->have_posts()) : ?>

<div class="block__post-box" data-style="3">

    <div class="block__title-sm">
        <h4><?php esc_html_e('Trending Posts', 'gutenkind-lite'); ?></h4>
    </div>
            
    <div class="block__post-box-wrap">
        <div>
        <?php
            while ($posts->have_posts()) { $posts->the_post();
            
                if ($i == 0) { ?>
                    <article>
                        
                        <div class="post-content">
                            <?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php gutenkind_excerpt(15); ?>
                            <a class="post-more link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'gutenkind-lite'); ?></a>
                        </div>

                        <div class="post-media" data-bg="<?php echo esc_url(gutenkind_thumb_url('single')); ?>" title="<?php echo esc_html(get_the_title()); ?>">
                            <a class="post-image" href="<?php echo esc_url(get_permalink()); ?>"></a>
                        </div>
                    </article><?php
                    if ($i == 0) { ?></div><div><?php }
                } else { ?>
                    <article>
                        <div class="post-media">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                               <?php the_post_thumbnail('square'); ?>
                           </a>
                        </div>
                        <div class="post-content">
                            <?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
                            <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </article><?php
                }

                $i++;
            } ?>
        </div>
    </div>
</div>

<?php endif;

// Reset
$wp_query = $temp_query;

wp_reset_query();
wp_reset_postdata();
