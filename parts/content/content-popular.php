<?php

$args = array(
    'posts_per_page' 			=> '7',
    'post_type'					=> 'post',
    'post_status'				=> 'publish',
    'orderby'					=> 'date',
);
$query = new WP_Query($args);

// Swiper slider JS settings
$attr[] = 'data-style="9"';
$attr[] = 'data-columns="4"';
$attr[] = 'data-columns-md="2"';
$attr[] = 'data-columns-xs="1"';
$attr[] = 'data-autoplay="0"';
$attr[] = 'data-delay="6000"';
$attr[] = 'data-loop="1"';
$attr[] = 'data-centered="false"';
$attr[] = 'data-pagination="1"';
$attr[] = 'data-dynamic-bullets="true"';
$attr[] = 'data-navigation="false"';
$attr[] = 'data-spacebetween="30"';
$attr[] = 'data-parallax="false"';
$attr[] = 'data-overlay=0.5';

if ($query->have_posts()) { ?>

    <div class="block__popular">
        <div class="vslider" <?php echo implode(' ', $attr); ?>>
        
            <div class="block__title text-center">
                <h3><?php esc_html_e('Popular This Week', 'gutenkind-lite'); ?></h3>
                <a class="block__link link" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">
                    <?php esc_html_e('View All', 'gutenkind-lite'); ?>
                </a>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            
            <div class="swiper-wrapper"><?php 
            
                while ($query->have_posts()) { $query->the_post();
                    if (has_post_thumbnail()) { ?>
                        
                        <div class="swiper-slide voss-slide">
                        	<div class="voss-slide-container" data-swiper-parallax="-450">
                        
                        		<div class="voss-slide-img">
                        			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        				<?php the_post_thumbnail('landscape-sm'); ?>
                        			</a>
                        		</div>
                        
                        		<div class="voss-slide-content">
                        			<?php if (function_exists('gutenkind_meta_cat')) gutenkind_meta_cat(); ?>
                        			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        		</div>
                        		
                        	</div>
                        </div><?php
                        
                    }
                } ?>
            </div>
            
            <div class="swiper-pagination"></div>
        </div>
    </div><?php
}

wp_reset_query();
wp_reset_postdata();
