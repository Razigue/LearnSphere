<?php
/**
 * Front-end taxonomy filters for Query Loop blocks.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'query_loop_block_query_vars', 'learnsphere_filter_query_loop_taxonomies', 10, 2 );

/**
 * Apply supported taxonomy filters from URL query parameters to course/quiz loops.
 *
 * @param array $query Query vars prepared by the Query Loop block.
 * @return array
 */
function learnsphere_filter_query_loop_taxonomies( $query ) {
	$post_type = $query['post_type'] ?? '';

	if ( ! in_array( $post_type, [ 'course', 'quiz' ], true ) ) {
		return $query;
	}

	$tax_query = [ 'relation' => 'AND' ];
	$filters   = [
		'ls_category'   => 'ls_category',
		'ls_difficulty' => 'ls_difficulty',
	];

	foreach ( $filters as $param => $taxonomy ) {
		if ( empty( $_GET[ $param ] ) ) {
			continue;
		}

		$raw_value = wp_unslash( $_GET[ $param ] );

		if ( ! is_scalar( $raw_value ) ) {
			continue;
		}

		$slug = sanitize_title( (string) $raw_value );

		if ( ! term_exists( $slug, $taxonomy ) ) {
			continue;
		}

		$tax_query[] = [
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $slug,
		];
	}

	if ( count( $tax_query ) > 1 ) {
		$query['tax_query'] = $tax_query;
	}

	return $query;
}
