<?php
/**
 * Custom Post Types : course & quiz
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'learnsphere_register_cpt_course');
function learnsphere_register_cpt_course() {
    register_post_type('course', [
        'labels' => [
            'name'               => 'Cours',
            'singular_name'      => 'Cours',
            'menu_name'          => 'Cours',
            'add_new'            => 'Ajouter',
            'add_new_item'       => 'Ajouter un cours',
            'edit_item'          => 'Modifier le cours',
            'new_item'           => 'Nouveau cours',
            'view_item'          => 'Voir le cours',
            'search_items'       => 'Rechercher un cours',
            'not_found'          => 'Aucun cours trouvé',
            'not_found_in_trash' => 'Aucun cours dans la corbeille',
            'all_items'          => 'Tous les cours',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'comments'],
        'menu_icon'    => 'dashicons-welcome-learn-more',
        'rewrite'      => ['slug' => 'cours'],
        'taxonomies'   => ['ls_category', 'ls_difficulty'],
    ]);
}

add_action('init', 'learnsphere_register_cpt_quiz');
function learnsphere_register_cpt_quiz() {
    register_post_type('quiz', [
        'labels' => [
            'name'               => 'Quiz',
            'singular_name'      => 'Quiz',
            'menu_name'          => 'Quiz',
            'add_new'            => 'Ajouter',
            'add_new_item'       => 'Ajouter un quiz',
            'edit_item'          => 'Modifier le quiz',
            'new_item'           => 'Nouveau quiz',
            'view_item'          => 'Voir le quiz',
            'search_items'       => 'Rechercher un quiz',
            'not_found'          => 'Aucun quiz trouvé',
            'not_found_in_trash' => 'Aucun quiz dans la corbeille',
            'all_items'          => 'Tous les quiz',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => ['title', 'thumbnail', 'excerpt'],
        'menu_icon'    => 'dashicons-forms',
        'rewrite'      => ['slug' => 'quiz'],
        'taxonomies'   => ['ls_category', 'ls_difficulty'],
    ]);
}
