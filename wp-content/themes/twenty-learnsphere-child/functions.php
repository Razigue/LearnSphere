<?php

/**
 * Remove core block patterns
 */
add_action( 'after_setup_theme', function () {
	remove_theme_support( 'core-block-patterns' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'build/index.css' );
} );

/**
 * Enqueue theme styles and scripts
 */

add_action( 'wp_enqueue_scripts', function () {
	$asset_path = get_stylesheet_directory() . '/build/index.asset.php';

	if ( ! file_exists( $asset_path ) ) {
		return;
	}

	$script_asset = require $asset_path;

	wp_enqueue_script(
		'twenty-learnsphere-child-script',
		get_stylesheet_directory_uri() . '/build/index.js',
		$script_asset['dependencies'],
		$script_asset['version'],
		true
	);

	wp_enqueue_style(
		'twenty-learnsphere-child-style',
		get_stylesheet_directory_uri() . '/build/index.css',
		[],
		$script_asset['version']
	);
} );

/**
 * Allow SVG uploads
 */
add_filter( 'upload_mimes', function ( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
} );
