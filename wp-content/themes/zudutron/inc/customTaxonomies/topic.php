<?php

/**
 * This is an example file showcasing how you can add custom taxonomies to your Flynt theme.
 *
 * For a full list of parameters see https://developer.wordpress.org/reference/functions/register_taxonomy/ or use https://generatewp.com/taxonomy/ to generate the code for you.
 */

namespace Flynt\CustomTaxonomies;

add_action('init', function () {
    $labels = [
        'name'                       => _x('Topics', 'Topic General Name', 'flynt'),
        'singular_name'              => _x('Topic', 'Topic Singular Name', 'flynt'),
        'menu_name'                  => __('Topic', 'flynt'),
        'all_items'                  => __('All Topics', 'flynt'),
        'parent_item'                => __('Parent Topic', 'flynt'),
        'parent_item_colon'          => __('Parent Topic:', 'flynt'),
        'new_item_name'              => __('New Topic Name', 'flynt'),
        'add_new_item'               => __('Add New Topic', 'flynt'),
        'edit_item'                  => __('Edit Topic', 'flynt'),
        'update_item'                => __('Update Topic', 'flynt'),
        'view_item'                  => __('View Topic', 'flynt'),
        'separate_items_with_commas' => __('Separate items with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove items', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Topics', 'flynt'),
        'search_items'               => __('Search Topics', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No items', 'flynt'),
        'items_list'                 => __('Topics list', 'flynt'),
        'items_list_navigation'      => __('Topics list navigation', 'flynt'),
    ];
    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    ];

    register_taxonomy('topic', ['article'], $args);
});
