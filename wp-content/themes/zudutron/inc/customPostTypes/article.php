<?php

/**
 * This is an example file showcasing how you can add custom post types to your Flynt theme.
 *
 * For a full list of parameters see https://developer.wordpress.org/reference/functions/register_post_type/ or use https://generatewp.com/post-type/ to generate the code for you.
 */

// namespace Flynt\CustomPostTypes;

// add_action('init', function () {
//     $labels = [
//         'name'                  => _x('Articles', 'Article General Name', 'flynt'),
//         'singular_name'         => _x('Article', 'Article Singular Name', 'flynt'),
//         'menu_name'             => __('Articles', 'flynt'),
//         'name_admin_bar'        => __('Article', 'flynt'),
//         'archives'              => __('Article Archives', 'flynt'),
//         'attributes'            => __('Article Attributes', 'flynt'),
//         'parent_item_colon'     => __('Parent Article:', 'flynt'),
//         'all_items'             => __('All Articles', 'flynt'),
//         'add_new_item'          => __('Add New Article', 'flynt'),
//         'add_new'               => __('Add New', 'flynt'),
//         'new_item'              => __('New Article', 'flynt'),
//         'edit_item'             => __('Edit Article', 'flynt'),
//         'update_item'           => __('Update Article', 'flynt'),
//         'view_item'             => __('View Article', 'flynt'),
//         'view_items'            => __('View Articles', 'flynt'),
//         'search_items'          => __('Search Article', 'flynt'),
//         'not_found'             => __('Not found', 'flynt'),
//         'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
//         'featured_image'        => __('Featured Image', 'flynt'),
//         'set_featured_image'    => __('Set featured image', 'flynt'),
//         'remove_featured_image' => __('Remove featured image', 'flynt'),
//         'use_featured_image'    => __('Use as featured image', 'flynt'),
//         'insert_into_item'      => __('Insert into item', 'flynt'),
//         'uploaded_to_this_item' => __('Uploaded to this item', 'flynt'),
//         'items_list'            => __('Articles list', 'flynt'),
//         'items_list_navigation' => __('Articles list navigation', 'flynt'),
//         'filter_items_list'     => __('Filter items list', 'flynt'),
//     ];
//     $args = [
//         'label'                 => __('Article', 'flynt'),
//         'description'           => __('Article Description', 'flynt'),
//         'labels'                => $labels,
//         'supports'              => ['title', 'editor', 'revisions'],
//         'taxonomies'            => ['topic', 'post_tag'],
//         'hierarchical'          => false,
//         'public'                => true,
//         'show_ui'               => true,
//         'show_in_menu'          => true,
//         'menu_position'         => 5,
//         'show_in_admin_bar'     => true,
//         'show_in_nav_menus'     => true,
//         'can_export'            => true,
//         'has_archive'           => true,
//         'exclude_from_search'   => false,
//         'publicly_queryable'    => true,
//         'capability_type'       => 'page',
//         'rewrite'            => array( 'slug' => get_post(get_option( 'page_for_articles' ))->post_name),
//     ];
//     register_post_type('article', $args);
// });
// add_action('admin_init', function() {
//     add_settings_field('mytheme_reference_slug', __('References base', 'txtdomain'), 'mytest_reference_slug_output', 'permalink', 'optional');
// });