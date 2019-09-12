<?php get_header(); 

$carousel = get_theme_mod('home-carousel', true);
$trending = get_theme_mod('home-trending', true);
$latest = get_theme_mod('home-latest', true);
$popular = get_theme_mod('home-popular', true);

?>

    <main class="site-main">
        <div class="container entry-content">
        	
        	<?php  
        	   if ($carousel == true) get_template_part('/parts/content/content', 'carousel');
        	   if ($trending == true) get_template_part('/parts/content/content', 'trending');
        	   if ($latest == true) get_template_part('/parts/content/content', 'latest');
        	?>
        	<hr class="wp-block-separator is-style-wide alignfull">
            <?php if ($popular == true) get_template_part('/parts/content/content', 'popular'); ?>
        	
        </div>
    </main>

<?php get_footer();
