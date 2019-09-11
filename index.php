<?php get_header(); ?>

    <main class="site-main">
        <div class="container entry-content">
        	
        	<?php  
        	   get_template_part('/parts/content/content', 'carousel');
        	   get_template_part('/parts/content/content', 'trending');
        	   get_template_part('/parts/content/content', 'latest');
        	?>
        	<hr class="wp-block-separator is-style-wide alignfull">
            <?php get_template_part('/parts/content/content', 'popular'); ?>
        	
        </div>
    </main>

<?php get_footer();
