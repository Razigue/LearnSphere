<?php
/**
 * Taxonomy filter shortcode for archive Query Loop filters.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_shortcode( 'learnsphere_tax_filter', 'learnsphere_render_taxonomy_filter_shortcode' );

/**
 * Render taxonomy terms as filter chips that target the Query Loop filter URL params.
 *
 * @param array<string,string> $atts Shortcode attributes.
 * @return string
 */
function learnsphere_render_taxonomy_filter_shortcode( $atts ) {
	$atts = shortcode_atts(
		[
			'all_label' => 'Tous',
			'base'      => '/',
			'taxonomy'  => 'ls_category',
		],
		$atts,
		'learnsphere_tax_filter'
	);

	$taxonomy = sanitize_key( $atts['taxonomy'] );

	if ( ! in_array( $taxonomy, [ 'ls_category', 'ls_difficulty' ], true ) ) {
		return '';
	}

	$terms = get_terms(
		[
			'hide_empty' => false,
			'taxonomy'   => $taxonomy,
		]
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return '';
	}

	$base     = esc_url_raw( $atts['base'] );
	$current  = learnsphere_get_current_taxonomy_filter_slug( $taxonomy );
	$base_url = learnsphere_get_taxonomy_filter_url( $base, $taxonomy, '' );
	$output   = '<div class="ls-filter-chips">';

	$output .= sprintf(
		'<a class="ls-chip%s" href="%s"%s>%s</a>',
		'' === $current ? ' is-active' : '',
		esc_url( $base_url ),
		'' === $current ? ' aria-current="true"' : '',
		esc_html( $atts['all_label'] )
	);

	foreach ( $terms as $term ) {
		$url       = learnsphere_get_taxonomy_filter_url( $base, $taxonomy, $term->slug );
		$is_active = $current === $term->slug;

		$output .= sprintf(
			'<a class="ls-chip%s" href="%s"%s>%s</a>',
			$is_active ? ' is-active' : '',
			esc_url( $url ),
			$is_active ? ' aria-current="true"' : '',
			esc_html( $term->name )
		);
	}

	$output .= '</div>';

	return $output;
}

/**
 * Return the active term slug for a supported taxonomy query parameter.
 *
 * @param string $taxonomy Taxonomy name and matching URL query parameter.
 * @return string
 */
function learnsphere_get_current_taxonomy_filter_slug( $taxonomy ) {
	if ( empty( $_GET[ $taxonomy ] ) ) {
		return '';
	}

	$value = wp_unslash( $_GET[ $taxonomy ] );

	if ( ! is_scalar( $value ) ) {
		return '';
	}

	return sanitize_title( (string) $value );
}

/**
 * Build a filter URL while preserving the other supported taxonomy filter.
 *
 * @param string $base Base archive URL.
 * @param string $taxonomy Taxonomy query parameter to change.
 * @param string $slug Term slug, or empty string to clear this taxonomy filter.
 * @return string
 */
function learnsphere_get_taxonomy_filter_url( $base, $taxonomy, $slug ) {
	$args = [];

	foreach ( [ 'ls_category', 'ls_difficulty' ] as $param ) {
		if ( $param === $taxonomy ) {
			continue;
		}

		$current = learnsphere_get_current_taxonomy_filter_slug( $param );

		if ( '' !== $current && term_exists( $current, $param ) ) {
			$args[ $param ] = $current;
		}
	}

	if ( '' !== $slug ) {
		$args[ $taxonomy ] = $slug;
	}

	if ( empty( $args ) ) {
		return $base;
	}

	return add_query_arg( $args, $base );
}
