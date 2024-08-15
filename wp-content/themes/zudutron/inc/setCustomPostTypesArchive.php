<?php
/**
 * Adds a custom field: "Articles page"; on the "Settings > Reading" page.
 */
add_action( 'admin_init', function () {
    $id = 'page_for_articles';
    // add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
    add_settings_field( $id, 'Articles page:', 'settings_field_page_for_articles', 'reading', 'default', array(
        'label_for' => 'field-' . $id, // A unique ID for the field. Optional.
        'class'     => 'row-' . $id,   // A unique class for the TR. Optional.
    ) );
} );

/**
 * Renders the custom "Articles page" field.
 *
 * @param array $args
 */
function settings_field_page_for_articles( $args ) {
    $id = 'page_for_articles';
    wp_dropdown_pages( array(
        'name'              => $id,
        'show_option_none'  => '&mdash; Select &mdash;',
        'option_none_value' => '0',
        'selected'          => get_option( $id ),
    ) );
}

/**
 * Adds page_for_articles to the white-listed options, which are automatically
 * updated by WordPress.
 *
 * @param array $options
 */
add_filter( 'whitelist_options', function ( $options ) {
    $options['reading'][] = 'page_for_articles';

    return $options;
} );

/**
 * Filters the post states on the "Pages" edit page. Displays "Projects Page"
 * after the post/page title, if the current page is the Projects static page.
 *
 * @param array $states
 * @param WP_Post $post
 */
add_filter( 'display_post_states', function ( $states, $post ) {
    if ( intval( get_option( 'page_for_articles' ) ) === $post->ID ) {
        $states['page_for_articles'] = __( 'Articles Page' );
    }

    return $states;
}, 10, 2 );