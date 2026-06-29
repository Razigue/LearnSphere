<?php

/**
 * Plugin Name:       LearnSphere Plugin Customizations
 * Description:       Customizations for the LearnSphere Site.
 * Version:           1.0
 * Author:            Sofian-bll
 * Text Domain:       learnsphere-plugin
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue theme styles and scripts
 */
add_action('wp_enqueue_scripts', function () {

    // Enqueue theme JavaScript
    $script_asset = require(plugin_dir_path(__FILE__) . 'build/plugin.asset.php');

    wp_enqueue_script(
        'learnsphere-plugin-script',
        plugin_dir_url(__FILE__) . 'build/plugin.js',
        $script_asset['dependencies'],
        $script_asset['version'],
        true
    );

    wp_enqueue_style(
        'learnsphere-plugin-style',
        plugin_dir_url(__FILE__) . 'build/plugin.css',
        [],
        $script_asset['version'],
    );
});

/**
 * Register Custom Blocks
 */
add_action('init', function () {
    if (!file_exists(__DIR__ . '/build/blocks-manifest.php')) {
        return;
    }
    $manifest_data = require __DIR__ . '/build/blocks-manifest.php';
    foreach (array_keys($manifest_data) as $block_type) {
        register_block_type(__DIR__ . "/build/blocks/{$block_type}");
    }
});


/**
 * Load plugin modules
 */
require_once __DIR__ . '/includes/cpt.php';
require_once __DIR__ . '/includes/taxonomies.php';
require_once __DIR__ . '/includes/query-filters.php';
require_once __DIR__ . '/includes/taxonomy-filter-shortcode.php';
require_once __DIR__ . '/includes/quiz-render.php';
require_once __DIR__ . '/includes/activation.php';
