<?php
/**
 * Taxonomies : ls_category (hiérarchique) & ls_difficulty (plate)
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'learnsphere_register_taxonomies');
function learnsphere_register_taxonomies() {

    register_taxonomy('ls_category', ['course', 'quiz'], [
        'labels' => [
            'name'          => 'Catégories',
            'singular_name' => 'Catégorie',
            'menu_name'     => 'Catégories',
            'all_items'     => 'Toutes les catégories',
            'edit_item'     => 'Modifier la catégorie',
            'add_new_item'  => 'Ajouter une catégorie',
            'search_items'  => 'Rechercher une catégorie',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'categorie'],
    ]);

    register_taxonomy('ls_difficulty', ['course', 'quiz'], [
        'labels' => [
            'name'          => 'Difficultés',
            'singular_name' => 'Difficulté',
            'menu_name'     => 'Difficultés',
            'all_items'     => 'Toutes les difficultés',
            'edit_item'     => 'Modifier la difficulté',
            'add_new_item'  => 'Ajouter une difficulté',
            'search_items'  => 'Rechercher une difficulté',
        ],
        'public'            => true,
        'hierarchical'      => false,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'difficulte'],
    ]);
}


