<?php

/**
 * Plugin activation : register CPT + taxonomies, seed terms, flush rewrites
 */
register_activation_hook(
	dirname( __DIR__ ) . '/learnsphere-plugin.php',
	'learnsphere_plugin_activate'
);
function learnsphere_plugin_activate() {
	learnsphere_register_cpt_course();
	learnsphere_register_cpt_quiz();
	learnsphere_register_taxonomies();

	$categories = [
		'it'        => 'Informatique',
		'language'  => 'Langue',
		'marketing' => 'Marketing',
		'design'    => 'Design',
		'business'  => 'Entreprise',
	];
	foreach ( $categories as $slug => $name ) {
		if ( ! term_exists( $slug, 'ls_category' ) ) {
			wp_insert_term( $name, 'ls_category', [ 'slug' => $slug ] );
		}
	}

	$difficulties = [
		'easy'   => 'Facile',
		'medium' => 'Moyen',
		'hard'   => 'Difficile',
	];
	foreach ( $difficulties as $slug => $name ) {
		if ( ! term_exists( $slug, 'ls_difficulty' ) ) {
			wp_insert_term( $name, 'ls_difficulty', [ 'slug' => $slug ] );
		}
	}

	learnsphere_seed_fieldsets();

	flush_rewrite_rules();
}

function learnsphere_seed_fieldsets() {
	global $wpdb;

	$required_tables = [ 'cofld_fieldsets', 'cofld_fields', 'cofld_locations' ];
	foreach ( $required_tables as $table ) {
		$full = $wpdb->prefix . $table;
		if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $full ) ) !== $full ) {
			return;
		}
	}

	$now = current_time( 'mysql' );

	$fieldsets = [
		[
			'key'      => 'ls_course',
			'title'    => 'Cours',
			'location' => 'course',
			'fields'   => [
				[
					'parent_key'   => null,
					'label'        => 'Durée estimée',
					'name'         => 'ls_course_duration',
					'field_key'    => 'field_ls_course_duration',
					'type'         => 'text',
					'required'     => 0,
					'field_config' => '{}',
					'menu_order'   => 0,
				],
				[
					'parent_key'   => null,
					'label'        => 'URL de la vidéo',
					'name'         => 'ls_course_video_url',
					'field_key'    => 'field_ls_course_video_url',
					'type'         => 'text',
					'required'     => 0,
					'field_config' => '{}',
					'menu_order'   => 1,
				],
				[
					'parent_key'   => null,
					'label'        => 'Objectifs pédagogiques',
					'name'         => 'ls_course_objectives',
					'field_key'    => 'field_ls_course_objectives',
					'type'         => 'textarea',
					'required'     => 0,
					'field_config' => '{}',
					'menu_order'   => 2,
				],
			],
		],
		[
			'key'      => 'ls_quiz',
			'title'    => 'Quiz',
			'location' => 'quiz',
			'fields'   => [
				[
					'parent_key'   => null,
					'label'        => 'Questions',
					'name'         => 'ls_quiz_questions',
					'field_key'    => 'field_ls_quiz_questions',
					'type'         => 'repeater',
					'required'     => 0,
					'field_config' => '{"layout":"block","min":1,"max":5,"button_label":"Add Questions"}',
					'menu_order'   => 0,
				],
				[
					'parent_key'   => 'field_ls_quiz_questions',
					'label'        => 'Texte de la question',
					'name'         => 'question_text',
					'field_key'    => 'field_ls_question_text',
					'type'         => 'textarea',
					'required'     => 1,
					'field_config' => '{}',
					'menu_order'   => 0,
				],
				[
					'parent_key'   => 'field_ls_quiz_questions',
					'label'        => 'Image (optionnelle)',
					'name'         => 'question_image',
					'field_key'    => 'field_ls_question_image',
					'type'         => 'image',
					'required'     => 0,
					'field_config' => '{}',
					'menu_order'   => 1,
				],
				[
					'parent_key'   => 'field_ls_quiz_questions',
					'label'        => 'Réponses',
					'name'         => 'question_answers',
					'field_key'    => 'field_ls_question_answers',
					'type'         => 'repeater',
					'required'     => 1,
					'field_config' => '{"min":2,"max":5,"layout":"block","button_label":"Add Response"}',
					'menu_order'   => 2,
				],
				[
					'parent_key'   => 'field_ls_question_answers',
					'label'        => 'Texte de la réponse',
					'name'         => 'answer_text',
					'field_key'    => 'field_ls_answer_text',
					'type'         => 'text',
					'required'     => 1,
					'field_config' => '{}',
					'menu_order'   => 0,
				],
				[
					'parent_key'   => 'field_ls_question_answers',
					'label'        => 'Bonne réponse',
					'name'         => 'answer_is_correct',
					'field_key'    => 'field_ls_answer_is_correct',
					'type'         => 'switch',
					'required'     => 1,
					'field_config' => '{}',
					'menu_order'   => 1,
				],
			],
		],
	];

	foreach ( $fieldsets as $fs ) {
		$exists = $wpdb->get_var(
			$wpdb->prepare( "SELECT id FROM {$wpdb->prefix}cofld_fieldsets WHERE field_key = %s", $fs['key'] )
		);
		if ( $exists ) {
			continue;
		}

		$wpdb->insert( "{$wpdb->prefix}cofld_fieldsets", [
			'title'       => $fs['title'],
			'field_key'   => $fs['key'],
			'description' => '',
			'status'      => 'active',
			'custom_css'  => '',
			'settings'    => json_encode( [
				'location_groups' => [
					[
						'id'    => '1',
						'rules' => [
							[
								'type'     => 'post_type',
								'operator' => '==',
								'value'    => $fs['location'],
							]
						],
					]
				],
			] ),
			'menu_order'  => 0,
			'created_at'  => $now,
			'updated_at'  => $now,
		] );

		$fieldset_id = $wpdb->insert_id;

		$wpdb->insert( "{$wpdb->prefix}cofld_locations", [
			'fieldset_id' => $fieldset_id,
			'param'       => 'post_type',
			'operator'    => '==',
			'value'       => $fs['location'],
			'group_id'    => 0,
		] );

		// First pass: insert top-level fields, collect field_key → DB id map
		$key_to_id = [];
		foreach ( $fs['fields'] as $field ) {
			if ( $field['parent_key'] !== null ) {
				continue;
			}
			$wpdb->insert( "{$wpdb->prefix}cofld_fields", [
				'fieldset_id'       => $fieldset_id,
				'parent_id'         => null,
				'label'             => $field['label'],
				'name'              => $field['name'],
				'field_key'         => $field['field_key'],
				'type'              => $field['type'],
				'instructions'      => '',
				'required'          => $field['required'],
				'default_value'     => '',
				'placeholder'       => '',
				'conditional_logic' => '[]',
				'wrapper_config'    => '[]',
				'field_config'      => $field['field_config'],
				'menu_order'        => $field['menu_order'],
				'created_at'        => $now,
				'updated_at'        => $now,
			] );
			$key_to_id[ $field['field_key'] ] = $wpdb->insert_id;
		}

		// Insert child fields once their parent field has been inserted.
		$pending_fields = array_filter(
			$fs['fields'],
			static fn( $field ) => $field['parent_key'] !== null
		);

		while ( ! empty( $pending_fields ) ) {
			$inserted = false;

			foreach ( $pending_fields as $index => $field ) {
				if ( ! isset( $key_to_id[ $field['parent_key'] ] ) ) {
					continue;
				}

				$wpdb->insert( "{$wpdb->prefix}cofld_fields", [
					'fieldset_id'       => $fieldset_id,
					'parent_id'         => $key_to_id[ $field['parent_key'] ],
					'label'             => $field['label'],
					'name'              => $field['name'],
					'field_key'         => $field['field_key'],
					'type'              => $field['type'],
					'instructions'      => '',
					'required'          => $field['required'],
					'default_value'     => '',
					'placeholder'       => '',
					'conditional_logic' => '[]',
					'wrapper_config'    => '[]',
					'field_config'      => $field['field_config'],
					'menu_order'        => $field['menu_order'],
					'created_at'        => $now,
					'updated_at'        => $now,
				] );

				$key_to_id[ $field['field_key'] ] = $wpdb->insert_id;
				unset( $pending_fields[ $index ] );
				$inserted = true;
			}

			if ( ! $inserted ) {
				break;
			}
		}
	}
}