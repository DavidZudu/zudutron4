<?php

/**
 * This is an example file showcasing how you can add custom taxonomies to your Flynt theme.
 *
 * For a full list of parameters see https://developer.wordpress.org/reference/functions/register_taxonomy/ or use https://generatewp.com/taxonomy/ to generate the code for you.
 */

namespace Flynt\CustomTaxonomies;

add_action('init', function () {
    $labels = [
        'name'                       => _x('Subjects', 'Subject General Name', 'flynt'),
        'singular_name'              => _x('Subject', 'Subject Singular Name', 'flynt'),
        'menu_name'                  => __('Subject', 'flynt'),
        'all_items'                  => __('All Subjects', 'flynt'),
        'parent_item'                => __('Parent Subject', 'flynt'),
        'parent_item_colon'          => __('Parent Subject:', 'flynt'),
        'new_item_name'              => __('New Subject Name', 'flynt'),
        'add_new_item'               => __('Add New Subject', 'flynt'),
        'edit_item'                  => __('Edit Subject', 'flynt'),
        'update_item'                => __('Update Subject', 'flynt'),
        'view_item'                  => __('View Subject', 'flynt'),
        'separate_items_with_commas' => __('Separate items with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove items', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Subjects', 'flynt'),
        'search_items'               => __('Search Subjects', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No items', 'flynt'),
        'items_list'                 => __('Subjects list', 'flynt'),
        'items_list_navigation'      => __('Subjects list navigation', 'flynt'),
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

    register_taxonomy('subject', ['article'], $args);
});
