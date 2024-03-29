<form class="search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search__inner">
    
        <p class="link"><?php esc_html_e('Search for:', 'gutenkind-lite'); ?></p>
        
        <div class="search__input-wrap">
            <input class="search__input" type="text" value="" name="s" placeholder="<?php esc_attr_e('What are you looking for?', 'gutenkind-lite'); ?>">
            <button class="search__submit" name="submit" type="submit">
                <?php get_template_part('/dist/svg/svg', 'search'); ?>
            </button>
        </div>
        
        <h5><?php esc_html_e('Input your search keywords and press enter.', 'gutenkind-lite'); ?></h5>
        
        <div class="search__close"></div>
        
    </div>
</form>
