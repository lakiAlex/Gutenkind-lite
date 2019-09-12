<?php

require get_parent_theme_file_path('/inc/theme-setup/tgm/class-tgm-plugin-activation.php');

function gutenkind_register_plugins() {

	$plugins = array(
		array(
			'name'          	=> esc_html__('Theme Options', 'gutenkind-lite'),
			'slug'          	=> 'kirki',
			'required'      	=> true,
		)
	);

	$config = array(
		'id'           => 'gutenkind-lite',             // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'gutenkind_register_plugins' );
