<?php

if (class_exists('kirki')) {

	// Modify Customizer Sections
	function gutenkind_customizer_modify( $wp_customize ) {
		$wp_customize->get_section( 'title_tagline' )->priority  = 1;
		$wp_customize->get_section( 'static_front_page' )->priority  = 1;
		$wp_customize->remove_control('custom_logo');
	}
	add_action( 'customize_register', 'gutenkind_customizer_modify' );

	// Remove Kirki Userdata Notice
	update_option('kirki_telemetry_no_consent', 'no');

	// Register Kirki Theme Mods
	Kirki::add_config( 'theme_mod', array(
	  'capability'    => 'edit_theme_options',
	  'option_type'   => 'theme_mod',
	));
	
	/*--------------------------------------------------------------
	# Homepage
	--------------------------------------------------------------*/
	
	// Settings
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'home-carousel',
		'label'       => esc_html__( 'Show Top Carousel', 'gutenkind-lite' ),
		'section'     => 'static_front_page',
		'default'     => true,
	) );
	
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'home-trending',
		'label'       => esc_html__( 'Show Trending Posts', 'gutenkind-lite' ),
		'section'     => 'static_front_page',
		'default'     => true,
	) );
	
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'home-latest',
		'label'       => esc_html__( 'Show Latest Posts', 'gutenkind-lite' ),
		'section'     => 'static_front_page',
		'default'     => true,
	) );
	
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'home-popular',
		'label'       => esc_html__( 'Show Popular Posts', 'gutenkind-lite' ),
		'section'     => 'static_front_page',
		'default'     => true,
	) );
	

	/*--------------------------------------------------------------
	# Header & Logo
	--------------------------------------------------------------*/

	// Section
	Kirki::add_section( 'header_section', array(
		'title'          => esc_html__( 'Header & Logo', 'gutenkind-lite' ),
		'priority'       => 1,
	) );

	// Settings
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'header-adbar',
		'label'       => esc_html__( 'Show Ad Bar', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => false,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'radio',
		'settings'    => 'adbar-type',
		'label'       => esc_html__( 'Ad Type', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => 'image',
		'choices'     => array(
			'image'     => esc_html__( 'Image', 'gutenkind-lite' ),
			'code'      => esc_html__( 'Code', 'gutenkind-lite' ),
		),
		'required' => array(
			array(
				'setting'  => 'header-adbar',
				'value'    => true,
				'operator' => '=='
			),
		),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'            => 'editor',
		'settings'        => 'adbar-editor',
		'label'           => esc_html__( 'Ad Image', 'gutenkind-lite' ),
		'section'         => 'header_section',
		'default'         => '<img src="'. get_template_directory_uri() . '/dist/img/banner-long.jpg"/>',
		'active_callback' => array(
			array(
	            'setting'  => 'header-adbar',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'adbar-type',
	            'value'    => 'image',
	            'operator' => '=='
	        ),
		)
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'code',
		'settings'    => 'adbar-code',
		'label'       => esc_html__( 'Ad Code', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => '',
		'required' => array(
			array(
	            'setting'  => 'header-adbar',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'adbar-type',
	            'value'    => 'code',
	            'operator' => '=='
	        ),
	    ),
	) );

	// Logo
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'show_header_logo',
		'label'       => esc_html__( 'Header Logo', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'radio',
		'settings'    => 'header_logo_type',
		'label'       => esc_html__( 'Logo Type', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => 'text',
		'choices'     => array(
			'image'     => esc_html__( 'Image', 'gutenkind-lite' ),
			'text'     => esc_html__( 'Text', 'gutenkind-lite' ),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_header_logo',
	            'value'    => '1',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'image',
		'settings'    => 'header_logo_img',
		'label'       => esc_html__('Logo Image', 'gutenkind-lite'),
		'section'     => 'header_section',
		'default'     => get_template_directory_uri() .'/dist/img/logo-dark.png',
		'required' => array(
	        array(
	            'setting'  => 'show_header_logo',
	            'value'    => '1',
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_logo_type',
	            'value'    => 'image',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'header_enable_logo_width',
		'label'       => esc_html__( 'Adjust Logo Size', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => false,
		'required' => array(
			array(
	            'setting'  => 'show_header_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_logo_type',
	            'value'    => 'image',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings' => 'header_logo_width',
		'label'       => esc_html__( 'Logo Width', 'gutenkind-lite' ),
		'section'  => 'header_section',
		'default'  => '150',
		'choices'  => array(
			'min'  => 10,
			'max'  => 600,
			'step' => 1,
		),
		'output' => array(
			array(
				'element'     => '.header__logo img',
				'property'    => 'width',
				'units'       => 'px',
			),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_header_logo',
	            'value'    => '1',
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_logo_type',
	            'value'    => 'image',
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_enable_logo_width',
	            'value'    => '1',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'header_change_logo_size',
		'label'       => esc_html__( 'Adjust Logo Size', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => false,
		'required' => array(
			array(
	            'setting'  => 'show_header_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_logo_type',
	            'value'    => 'text',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings' => 'header_logo_text_size',
		'label'       => esc_html__( 'Logo Text Size', 'gutenkind-lite' ),
		'section'  => 'header_section',
		'default'  => '26',
		'choices'  => array(
			'min'  => 10,
			'max'  => 400,
			'step' => 1,
		),
		'output' => array(
			array(
				'element'     => '.header__logo h1',
				'property'    => 'font-size',
				'units'       => 'px !important',
				'media_query' => '@media (min-width: 992px)',
			),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_header_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_logo_type',
	            'value'    => 'text',
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_change_logo_size',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'header_change_logo_spacing',
		'label'       => esc_html__( 'Adjust Logo Spacing', 'gutenkind-lite' ),
		'section'     => 'header_section',
		'default'     => false,
		'required' => array(
			array(
	            'setting'  => 'show_header_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'spacing',
		'settings' => 'header_logo_spacing',
		'label'       => esc_html__( 'Logo spacing', 'gutenkind-lite' ),
		'section'  => 'header_section',
		'default' => array(
			'top'    => '0px',
			'bottom' => '0px',
			'left'	 => '0px',
			'right'  => '0px',
		),
		'output' => array(
			array(
				'element'  => '.header .header__logo, .header__logo.header--style-2-logo',
				'property' => 'margin',
				'media_query' => '@media (min-width: 992px)',
			),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_header_logo',
	            'value'    => '1',
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'header_change_logo_spacing',
	            'value'    => '1',
	            'operator' => '=='
	        ),
	    ),
	) );

	/*--------------------------------------------------------------
	# Archive Settings
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'archive_settings', array(
		'title'          => esc_html__( 'Archive Settings', 'gutenkind-lite' ),
		'panel'          => '',
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-cat-list',
		'label'       => esc_html__( 'Category List', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-tag-list',
		'label'       => esc_html__( 'Tag List', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-featured',
		'label'       => esc_html__( 'Show Featured Post', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-thumb',
		'label'       => esc_html__( 'Post Thumbnail', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-cat-link',
		'label'       => esc_html__( 'Post Category Link', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-excerpt',
		'label'       => esc_html__( 'Post Excerpt', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings' => 'archive-page-excerpt-length',
		'label'       => esc_html__( 'Excerpt Length', 'gutenkind-lite' ),
		'section'  => 'archive_settings',
		'default'  => '5',
		'choices'  => array(
			'min'  => 1,
			'max'  => 200,
			'step' => 1,
		),
		'required' => array(
	        array(
	            'setting'  => 'archive-page-excerpt',
	            'value'    => '1',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'archive-page-more',
		'label'       => esc_html__( 'Read More Button', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'select',
		'settings'    => 'archive-page-nav',
		'label'       => esc_html__( 'Pagination', 'gutenkind-lite' ),
		'section'     => 'archive_settings',
		'default'     => 'load',
		'choices'     => array(
			'numeric' 		=> esc_html__( 'Numeric', 'gutenkind-lite' ),
			'links' 		=> esc_html__( 'Links', 'gutenkind-lite' ),
			'btn' 			=> esc_html__( 'Buttons', 'gutenkind-lite' ),
			'load' 			=> esc_html__( 'Load More Button', 'gutenkind-lite' ),
			'infinite' 		=> esc_html__( 'Infinite Scroll', 'gutenkind-lite' ),
		),
	) );

	/*--------------------------------------------------------------
	# Post Settings
	--------------------------------------------------------------*/

	// Section
	Kirki::add_section( 'post_settings', array(
		'title'          => esc_html__( 'Post Settings', 'gutenkind-lite' ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'radio-image',
		'settings'    => 'single-sidebar',
		'label'       => esc_html__( 'Post Sidebar', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => 'right',
		'choices'     => array(
			'left'   			=> get_template_directory_uri() . '/dist/img/layout/sidebar-left.png',
			'none' 		    	=> get_template_directory_uri() . '/dist/img/layout/sidebar-none.png',
			'right' 		    => get_template_directory_uri() . '/dist/img/layout/sidebar-right.png',
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-cat-link',
		'label'       => esc_html__( 'Show Category Link', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-author',
		'label'       => esc_html__( 'Show Author', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-date',
		'label'       => esc_html__( 'Show Date', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-comments',
		'label'       => esc_html__( 'Show Comments Link', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-featured',
		'label'       => esc_html__( 'Show Featured Image', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-tags',
		'label'       => esc_html__( 'Show Tags', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-nav',
		'label'       => esc_html__( 'Show Navigation', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-related',
		'label'       => esc_html__( 'Show Related Posts', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'single-comments-form',
		'label'       => esc_html__( 'Show Comments Form', 'gutenkind-lite' ),
		'section'     => 'post_settings',
		'default'     => true,
	) );

	/*--------------------------------------------------------------
	# Page Settings
	--------------------------------------------------------------*/

	// Section
	Kirki::add_section( 'page_settings', array(
		'title'          => esc_html__( 'Page Settings', 'gutenkind-lite' ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'page-header-title',
		'label'       => esc_html__('Page Title', 'gutenkind-lite'),
		'section'     => 'page_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'page-header-thumb',
		'label'       => esc_html__('Featured Image', 'gutenkind-lite'),
		'section'     => 'page_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings'    => 'page-pad-top',
		'label'       => esc_html__('Spacing Top', 'gutenkind-lite'),
		'section'     => 'page_settings',
		'default'  => 0,
		'choices'  => array(
			'min'  => 0,
			'max'  => 500,
			'step' => 1,
		),
		'output' => array(
			array(
				'element'  => '.page-container',
				'property' => 'margin-top',
				'units'       => 'px !important',
			),
		),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings'    => 'page-pad-bottom',
		'label'       => esc_html__( 'Spacing Bottom', 'gutenkind-lite' ),
		'section'     => 'page_settings',
		'default'  => 0,
		'choices'  => array(
			'min'  => 0,
			'max'  => 500,
			'step' => 1,
		),
		'output' => array(
			array(
				'element'  => '.page-container',
				'property' => 'margin-bottom',
				'units'       => 'px !important',
			),
		),
	) );

	/*--------------------------------------------------------------
	# Social Media Settings
	--------------------------------------------------------------*/

	// Section
	Kirki::add_section( 'social_media_settings', array(
		'title'          => esc_html__( 'Social Media Settings', 'gutenkind-lite' ),
		'panel'          => '', // Not typically needed.
		'description'    => 'Paste your social media URLs. Icons will be hidden if fields are left blank.',
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Facebook',
		),
		'default'	  => esc_url( 'https://facebook.com' ),
		'settings'    => 'social_facebook',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Twitter',
		),
		'default'	  => esc_url( 'https://twitter.com' ),
		'settings'    => 'social_twitter',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Instagram',
		),
		'default'	  => esc_url( 'https://instagram.com' ),
		'settings'    => 'social_instagram',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Pinterest',
		),
		'default'	  => esc_url( 'https://pinterest.com' ),
		'settings'    => 'social_pinterest',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Youtube',
		),
		'default'	  => esc_url( 'https://youtube.com' ),
		'settings'    => 'social_youtube',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Vimeo',
		),
		'settings'    => 'social_vimeo',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Tumblr',
		),
		'settings'    => 'social_tumblr',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Bloglovin',
		),
		'settings'    => 'social_bloglovin',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Linkedin',
		),
		'settings'    => 'social_linkedin',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Snapchat',
		),
		'settings'    => 'social_snapchat',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Google+',
		),
		'settings'    => 'social_googleplus',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'vk',
		),
		'settings'    => 'social_vk',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'generic',
		'choices'     => array(
			'element'     => 'input',
			'type'        => 'text',
			'placeholder' => 'Email',
		),
		'default'	  => esc_html('hello@yourdomain.com'),
		'settings'    => 'social_email',
		'section'     => 'social_media_settings',
		'priority'    => 1,
	) );

	/*--------------------------------------------------------------
	# Color Settings
	--------------------------------------------------------------*/
	// Panel
	Kirki::add_panel( 'color_settings', array(
		'priority'    => 2,
		'title'       => esc_html__( 'Color Settings', 'gutenkind-lite' ),
	));

	// Section
	Kirki::add_section( 'color_general', array(
		'priority'    => 1,
		'title'       => esc_html__( 'General', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_general_body',
		'label'       => esc_html__( 'Body Background', 'gutenkind-lite' ),
		'section'     => 'color_general',
		'default'     => '#fff',
		'priority'    => 1,
		'output' => array(
			array(
				'element'  => 'body, .voss-posts .post-meta li.hide-last-after',
				'property' => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_general_button',
		'label'       => esc_html__( 'Buttons Color', 'gutenkind-lite' ),
		'section'     => 'color_general',
		'priority'    => 1,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#000',
			'hover'     => '#3a3c3c',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.btn, button, .button, .btn[type="submit"], input.btn, input[type="submit"], .comments-show-btn .button, .woocommerce button.button, .woocommerce button.button.alt,button,.wpcf7-submit',
				'property'  => 'background',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.btn:hover, button:hover, .button:hover, .btn[type="submit"]:hover, input.btn:hover, input[type="submit"]:hover, .comments-show-btn .button:hover .woocommerce button.button:hover, .woocommerce button.button.alt:hover, button:hover,.wpcf7-submit:hover',
				'property'  => 'background',
			),
		),
	));

	/*--------------------------------------------------------------
	## Color Headings
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'color_headings', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Headings', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_h',
		'label'       => esc_html__( 'Headings Color', 'gutenkind-lite' ),
		'section'     => 'color_headings',
		'default'     => '#000',
		'priority'    => 1,
		'output' => array(
			array(
				'element'  => 'h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
				'property' => 'color',
			),
		),
	));

	/*--------------------------------------------------------------
	## Color Header
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'color_header', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Header', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_topbar_bg',
		'label'       => esc_html__( 'Topbar Background Color', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'default'     => '#efefef',
		'priority'    => 1,
		'output' => array(
			array(
				'element'  => '.header-placement',
				'property' => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_topbar',
		'label'       => esc_html__( 'Topbar Text Color', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'default'     => '#000',
		'priority'    => 1,
		'output' => array(
			array(
				'element'  => '.header-placement p, .header-placement a',
				'property' => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_header_bg',
		'label'       => esc_html__( 'Background Color', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'default'     => 'rgba(255, 255, 255, 0.97)',
		'choices'     => [
			'alpha' => true,
		],
		'priority'    => 1,
		'output' => array(
			array(
				'element'  => '.header, .main-navigation li ul',
				'property' => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_header_menu',
		'label'       => esc_html__( 'Menu Color', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'priority'    => 1,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#000',
			'hover'     => '#000',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.header .main-menu .menu > li > a, .header .header__logo h1',
				'property'  => 'color',
				'media_query' => '@media (min-width: 992px)',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.header .main-menu .menu > li > a:hover',
				'property'  => 'color',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_header_menu_stroke',
		'label'       => esc_html__( 'Menu Stroke', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'priority'    => 1,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => 'rgba(0, 0, 0, 0.4)',
			'hover'     => 'rgba(0, 0, 0, 0.4)',
		),
		'output'    => array(
			array(
				'choice'	=> 'default',
				'element'	=> '.header .main-menu .menu > li > a',
				'property'	=> '-webkit-text-stroke-color',
				'media_query' => '@media (min-width: 992px)',
			),
			array(
				'choice'	=> 'hover',
				'element'	=> '.header .main-menu .menu > li > a:hover',
				'property'	=> '-webkit-text-stroke-color',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_menu_arrow',
		'label'       => esc_html__( 'Menu Arrow Color', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'default'     => '#a9a9a9',
		'priority'    => 1,
		'output' => array(
			array(
				'element'  => '.header .menu-arrow',
				'property' => 'fill',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_header_icons_clr',
		'label'       => esc_html__( 'Icons Color', 'gutenkind-lite' ),
		'section'     => 'color_header',
		'priority'    => 1,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#000',
			'hover'     => '#bbbdbd',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.header__icons .social a',
				'property'  => 'color',
				'media_query' => '@media (min-width: 992px)',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.header__icons .social a:hover',
				'property'  => 'color',
				'media_query' => '@media (min-width: 992px)',
			),
			array(
				'choice'    => 'default',
				'element'   => '.header__icons svg',
				'property'  => 'fill',
			),
			array(
				'choice'    => 'default',
				'element'   => '.header__icons svg',
				'property'  => 'stroke',
			),
			
			array(
				'choice'    => 'hover',
				'element'   => '.header__icons svg:hover',
				'property'  => 'fill',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.header__icons svg:hover',
				'property'  => 'stroke',
			),
		),
	));

	/*--------------------------------------------------------------
	## Color Posts
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'color_posts', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Posts', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_posts_cat_bg',
		'label'       => esc_html__( 'Category Link Background', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'priority'    => 10,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#f5f5f5',
			'hover'     => '#efefef',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.meta-cat a',
				'property'  => 'background-color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.meta-cat a:hover',
				'property'  => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_posts_cat_text',
		'label'       => esc_html__( 'Category Link Text', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'priority'    => 10,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#000',
			'hover'     => '#000',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.meta-cat a',
				'property'  => 'color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.meta-cat a:hover',
				'property'  => 'color',
			),
		),
	));
	
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_posts_title',
		'label'       => esc_html__( 'Post Title', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'priority'    => 10,
		'default'     => '#000',
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.single .voss-posts .post-title, .single .voss-posts .post-title a',
				'property'  => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_posts_meta',
		'label'       => esc_html__( 'Post Meta', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'priority'    => 10,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#000',
			'hover'     => '#bbbdbd',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.entry-meta a',
				'property'  => 'color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.entry-meta a:hover',
				'property'  => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_posts_excerpt',
		'label'       => esc_html__( 'Excerpt', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'default'     => '#5f5f5f',
		'output' => array(
			array(
				'element'  => '.voss-posts .post-excerpt',
				'property' => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_posts_p',
		'label'       => esc_html__( 'Paragraphs', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'default'     => '#000',
		'output' => array(
			array(
				'element'  => '.single .entry-content p',
				'property' => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_posts_links',
		'label'       => esc_html__( 'Post Links', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'priority'    => 10,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#000',
			'hover'     => '#bbbdbd',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.single .entry-content p a',
				'property'  => 'color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.single .entry-content p a:hover',
				'property'  => 'color',
			),
		),
	));
	
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_posts_links_border',
		'label'       => esc_html__( 'Post Links Border', 'gutenkind-lite' ),
		'section'     => 'color_posts',
		'priority'    => 10,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => 'rgba(119, 119, 119, 0.1)',
			'hover'     => 'rgba(119, 119, 119, 0.1)',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.single .entry-content a',
				'property'  => 'border-color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.single .entry-content a:hover',
				'property'  => 'border-color',
			),
		),
	));

	/*--------------------------------------------------------------
	## Color Sidebar
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'color_sidebar', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Widgets', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_sidebar_title',
		'label'       => esc_html__( 'Widget Title', 'gutenkind-lite' ),
		'section'     => 'color_sidebar',
		'default'     => '#000',
		'output' => array(
			array(
				'element'  => '.widget-title',
				'property' => 'color',
			),
		),
	));

	/*--------------------------------------------------------------
	## Color Sliders
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'color_sliders', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Slider', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_sliders_nav',
		'label'       => esc_html__('Slider Navigation', 'gutenkind-lite'),
		'section'     => 'color_sliders',
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => 'rgba(0, 0, 0, 0.25)',
			'hover'     => 'rgba(0, 0, 0, 1)',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.swiper-button-prev, .swiper-button-next',
				'property'  => 'background-color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.swiper-button-prev:hover, .swiper-button-next:hover',
				'property'  => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_sliders_pag',
		'label'       => esc_html__( 'Slider Pagination', 'gutenkind-lite' ),
		'section'     => 'color_sliders',
		'default'     => '#000',
		'output' => array(
			array(
				'element'  => '.swiper-pagination-bullet > div',
				'property' => 'background-color',
			),
		),
	));

	/*--------------------------------------------------------------
	## Color Footer
	--------------------------------------------------------------*/
	// Section
	Kirki::add_section( 'color_footer', array(
		'priority'    => 1,
		'title'       => esc_html__( 'Footer', 'gutenkind-lite' ),
		'panel'       => 'color_settings',
	));

	// Field
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_footer_bg',
		'label'       => esc_html__( 'Background Color', 'gutenkind-lite' ),
		'section'     => 'color_footer',
		'default'     => '#000',
		'output' => array(
			array(
				'element'  => '.footer',
				'property' => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'multicolor',
		'settings'    => 'color_footer_links',
		'label'       => esc_html__( 'Social Icons', 'gutenkind-lite' ),
		'section'     => 'color_footer',
		'priority'    => 10,
		'choices'     => array(
			'default'   => esc_html__( 'Default', 'gutenkind-lite' ),
			'hover'     => esc_html__( 'Hover', 'gutenkind-lite' ),
		),
		'default'     => array(
			'default'   => '#fff',
			'hover'     => '#bbbdbd',
		),
		'output'    => array(
			array(
				'choice'    => 'default',
				'element'   => '.footer .social a',
				'property'  => 'color',
			),
			array(
				'choice'    => 'hover',
				'element'   => '.footer .social a:hover',
				'property'  => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_footer_text_color',
		'label'       => esc_html__( 'Text', 'gutenkind-lite' ),
		'section'     => 'color_footer',
		'default'     => '#e6e6e6',
		'output' => array(
			array(
				'element'  => '.footer p, .footer a, .footer label',
				'property' => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_footer_logo_color',
		'label'       => esc_html__( 'Logo Text', 'gutenkind-lite' ),
		'section'     => 'color_footer',
		'default'     => '#fff',
		'output' => array(
			array(
				'element'  => '.footer h2',
				'property' => 'color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_footer_to_top_bg',
		'label'       => esc_html__( '"To Top" Button', 'gutenkind-lite' ),
		'section'     => 'color_footer',
		'default'     => '#080808',
		'output' => array(
			array(
				'element'  => '.footer .scroll__top',
				'property' => 'background-color',
			),
		),
	));

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'color',
		'settings'    => 'color_footer_to_top_arrow',
		'label'       => esc_html__( '"To Top" Arrow', 'gutenkind-lite' ),
		'section'     => 'color_footer',
		'default'     => '#fff',
		'output' => array(
			array(
				'element'  => '.footer .scroll__top svg',
				'property' => 'fill',
			),
		),
	));


	/*--------------------------------------------------------------
	# Footer Settings
	--------------------------------------------------------------*/

	// Section
	Kirki::add_section( 'footer_settings', array(
		'title'          => esc_html__( 'Footer Settings', 'gutenkind-lite' ),
		'panel'          => '',
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
	) );

	// Settings
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_newsletter',
		'label'       => esc_html__( 'Newsletter Form', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'text',
		'settings'    => 'footer_newsletter_heading',
		'label'       => esc_html__( 'Newsletter Heading', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => esc_html__( 'Subscribe to our weekly newsletter', 'gutenkind-lite' ),
		'required' => array(
	        array(
	            'setting'  => 'footer_newsletter',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_instagram',
		'label'       => esc_html__( 'Instagram Feed', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'text',
		'settings'    => 'footer_instagram_user',
		'label'       => esc_html__( 'Instagram Username', 'gutenkind-lite' ),
		'description' => esc_html__('Make sure your Instagram account is set on "Public" in order for feed to display.', 'gutenkind-lite'),
		'section'     => 'footer_settings',
		'default'     => esc_html__( 'mija_mija', 'gutenkind-lite' ),
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_instagram_likes',
		'label'       => esc_html__( 'Instagram Likes', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_instagram_comments',
		'label'       => esc_html__( 'Instagram Comments', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_instagram_description',
		'label'       => esc_html__( 'Instagram Description', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => false,
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings' => 'footer_instagram_number',
		'label'       => esc_html__( 'Number of Photos: ', 'gutenkind-lite' ),
		'section'  => 'footer_settings',
		'default'  => 6,
		'choices'  => array(
			'min'  => 5,
			'max'  => 9,
			'step' => 1,
		),
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'text',
		'settings'    => 'footer_instagram_link_text',
		'label'       => esc_html__( 'Instagram Link Text', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => esc_html__( '@thegutenkind', 'gutenkind-lite' ),
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'link',
		'settings'    => 'footer_instagram_link',
		'label'       => esc_html__( 'Instagram Profile Link', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => esc_html__( 'https://instagram.com/', 'gutenkind-lite' ),
		'required' => array(
	        array(
	            'setting'  => 'footer_instagram',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	// Settings
	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'show_footer_logo',
		'label'       => esc_html__( 'Footer Logo', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
		'output'      => array(
			array(
				'element'       => '.footer__logo',
				'property'      => 'display',
				'exclude'       => array( true, 1, '1' ),
				'value_pattern' => 'none',
			),
		),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'radio',
		'settings'    => 'footer_logo_type',
		'label'       => esc_html__( 'Logo Type', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => 'text',
		'choices'     => array(
			'image'     => esc_html__( 'Image', 'gutenkind-lite' ),
			'text'     => esc_html__( 'Text', 'gutenkind-lite' ),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_footer_logo',
	            'value'    => '1',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'image',
		'settings'    => 'footer_logo',
		'label'       => esc_html__( 'Logo Image', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => '',
		'required' => array(
	        array(
	            'setting'  => 'show_footer_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'footer_logo_type',
	            'value'    => 'image',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings' => 'footer_logo_img_size',
		'label'       => esc_html__( 'Logo Max Width', 'gutenkind-lite' ),
		'section'  => 'footer_settings',
		'default'  => 134,
		'choices'  => array(
			'min'  => 40,
			'max'  => 1140,
			'step' => 1,
		),
		'output' => array(
			array(
				'element'  => '.footer .footer__logo img',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_footer_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'footer_logo_type',
	            'value'    => 'image',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_show_tagline',
		'label'       => esc_html__('Tagline', 'gutenkind-lite'),
		'description' => esc_html__('To change your Site Title and Tagline, navigate to Customizer > Site Indentity section.', 'gutenkind-lite'),
		'section'     => 'footer_settings',
		'default'     => false,
		'required' => array(
			array(
	            'setting'  => 'show_footer_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'footer_logo_type',
	            'value'    => 'text',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'slider',
		'settings' => 'footer_logo_text_size',
		'label'       => esc_html__( 'Logo Text Size', 'gutenkind-lite' ),
		'section'  => 'footer_settings',
		'default'  => '34',
		'choices'  => array(
			'min'  => 10,
			'max'  => 400,
			'step' => 1,
		),
		'output' => array(
			array(
				'element'     => '.footer .footer__logo h2',
				'property'    => 'font-size',
				'units'       => 'px',
				'media_query' => '@media (min-width: 992px)',
			),
		),
		'required' => array(
	        array(
	            'setting'  => 'show_footer_logo',
	            'value'    => true,
	            'operator' => '=='
	        ),
			array(
	            'setting'  => 'footer_logo_type',
	            'value'    => 'text',
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_social',
		'label'       => esc_html__( 'Social Media', 'gutenkind-lite' ),
		'description' => esc_html__( 'To change social media links, navigate to Customizer > Social Media Settings section.', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'     => 'spacing',
		'settings' => 'footer_spacing',
		'label'       => esc_html__( 'Footer Spacing', 'gutenkind-lite' ),
		'section'  => 'footer_settings',
		'default' => array(
			'top'    => '100px',
			'bottom' => '78px',
			'left'	 => '0px',
			'right'  => '0px',
		),
		'output' => array(
			array(
				'element'  => '.footer .footer__mid',
				'property' => 'margin',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'editor',
		'media_buttons' => false,
		'settings'    => 'footer_disclaimer',
		'label'       => esc_html__( 'Copyright', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'sanitize_callback' => 'wp_kses_post',
		'default'	  => '<p>&copy;'. date(' Y ') .'<a href="'. get_home_url('/') .'">'. get_bloginfo( 'name' ) .'</a>'. esc_html__( ' - All Rights Reserved.', 'gutenkind-lite' ) .'</p>',
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'footer_menu',
		'label'       => esc_html__( 'Footer Menu', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'scroll-top',
		'label'       => esc_html__( 'Scroll to Top Button', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'toggle',
		'settings'    => 'cookie_notice',
		'label'       => esc_html__( 'Cookie Notice', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'     => true,
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'editor',
		'media_buttons' => false,
		'settings'    => 'cookie_text',
		'label'       => esc_html__( 'Cookie Notice Text', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'sanitize_callback' => 'wp_kses_post',
		'default'	  => '<p>'.esc_html__('Like most sites, we use cookies to ensure we provide you with the best experience. By clicking Accept, you are agreeing to our use of cookies.', 'gutenkind-lite').'</p>',
		'required' => array(
	        array(
	            'setting'  => 'cookie_notice',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

	Kirki::add_field( 'theme_mod', array(
		'type'        => 'text',
		'settings'    => 'cookie_btn',
		'label'       => esc_html__( 'Cookie Notice Button', 'gutenkind-lite' ),
		'section'     => 'footer_settings',
		'default'	  => esc_html__( 'I accept use of cookies', 'gutenkind-lite' ),
		'required' => array(
	        array(
	            'setting'  => 'cookie_notice',
	            'value'    => true,
	            'operator' => '=='
	        ),
	    ),
	) );

}
