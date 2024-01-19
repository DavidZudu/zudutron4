<?php

namespace Flynt\Components\BlockPostsArchive;

use Flynt\FieldVariables;
use Flynt\Utils\Options;
use Timber\Term;
use Timber\Timber;

const POST_TYPE = 'post';
const FILTER_BY_TAXONOMY = 'category';

add_filter('Flynt/addComponentData?name=BlockPostsArchive', function ($data) {
    global $wp_query;
    $postType = POST_TYPE;
    $taxonomy = FILTER_BY_TAXONOMY;
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    $ppp = get_option('posts_per_page') ? get_option('posts_per_page') : 12;
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $skip = isset($data['options']['skipPosts'])
        ? $data['options']['skipPosts']
        : 0;
    $orderby = isset($data['options']['orderBy'])
        ? $data['options']['orderBy']
        : 'date';
    $order = isset($data['options']['order'])
        ? $data['options']['order']
        : 'DESC';

    if (isset($data['postTypeSelect'])) {
        $postType = $data['postTypeSelect'];
        $queriedObject = Timber::get_posts([
            'post_status' => 'publish',
            'post_type' => $postType,
            'posts_per_page' => $ppp,
            'ignore_sticky_posts' => 1,
            // 'offset' => $skip,
            'paged' => $paged,
            'orderby' => $orderby,
            'order' => $order,
        ]);
        $data['posts'] = $queriedObject;
    } else {
        $queriedObject = get_queried_object();
        $postType = get_taxonomy(get_queried_object()->taxonomy)
            ->object_type[0];
    }

    if ($postType == 'post') {
        $taxonomy = 'category';
    } else {
        $postTypeObj = get_post_type_object($postType);
        // for just the first tax, use taxonomies[0];
        $taxonomy = $postTypeObj->taxonomies;
    }
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
        'orderby' => 'count',
        'order' => 'DESC',
    ]);

    foreach ($terms as $key => $value) {
        $result[$value->taxonomy][] = $value;
    }

    foreach ($result as $key => $value) {
        
        if (count($value) > 1) {
            $data['taxs'][$key] = array_map(function ($term) use ($queriedObject) {
                $timberTerm = Timber::get_term($term);
                if ($queriedObject && isset($queriedObject->taxonomy)) {
                    $timberTerm->isActive =
                        $queriedObject->taxonomy === $term->taxonomy &&
                        $queriedObject->term_id === $term->term_id;
                }
                return $timberTerm;
            }, $value);
            // Add item for all posts
            array_unshift($data['taxs'][$key], [
                'link' => get_post_type_archive_link($postType),
                'title' => $data['labels']['allPosts'],
                'isActive' => is_home() || is_post_type_archive($postType),
            ]);
        }
    }
    
    

    $data['taxonomy'] = $taxonomy;

    // var_dump($queriedObject);
    if (count($terms) > 1) {
        $data['terms'] = array_map(function ($term) use ($queriedObject) {
            $timberTerm = Timber::get_term($term);
            if ($queriedObject && isset($queriedObject->taxonomy)) {
                $timberTerm->isActive =
                    $queriedObject->taxonomy === $term->taxonomy &&
                    $queriedObject->term_id === $term->term_id;
            }
            return $timberTerm;
        }, $terms);
        // Add item for all posts
        array_unshift($data['terms'], [
            'link' => get_post_type_archive_link($postType),
            'title' => $data['labels']['allPosts'],
            'isActive' => is_home() || is_post_type_archive($postType),
        ]);
    }

    if (is_home()) {
        $data['isHome'] = true;
        $data['title'] = $queriedObject->post_title ?? get_bloginfo('name');
    } else {
        $data['title'] = get_the_archive_title();
        $data['description'] = get_the_archive_description();
    }

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'BlockPostsArchive',
        'label' => 'BlockPostsArchive',
        'sub_fields' => [
            [
                'label' => __('General', 'flynt'),
                'name' => 'generalTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Post Type', 'flynt'),
                'name' => 'postTypeSelect',
                'type' => 'select',
                // Populated dynamically in ../../inc/populateFields.php
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Post Shape', 'flynt'),
                'name' => 'postShape',
                'type' => 'select',
                'choices' => [
                    'square' => 'Square',
                    'portrait' => 'Portrait',
                    'landscape' => 'Landscape',
                ],
                'wrapper' => [
                    'width' => '50',
                ],
            ],

            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\setContainerSize(),
                    [
                        'label' => __('Max Columns', 'flynt'),
                        'name' => 'maxColumns',
                        'type' => 'select',
                        'choices' => [
                            'one' => 'one',
                            'two' => 'two',
                            'three' => 'three',
                        ],
                        'default_value' => 'two',
                        'wrapper' => [
                            'width' => '50',
                        ],
                    ],
                    // [
                    //     'label' => __('Skip Posts', 'flynt'),
                    //     'name' => 'skipPosts',
                    //     'type' => 'number',
                    //     'default_value' => '0',
                    //     'wrapper' => [
                    //         'width' => '33',
                    //     ],
                    // ],
                    [
                        'label' => __('Live Filters?', 'flynt'),
                        'name' => 'liveFilters',
                        'type' => 'true_false',
                        'wrapper' => [
                            'width' => '33',
                        ],
                    ],
                    [
                        'label' => __('Order By...', 'flynt'),
                        'name' => 'orderBy',
                        'type' => 'select',
                        'choices' => [
                            'date' => 'Post Date',
                            'title' => 'Title',
                            'menu_order' => 'Menu Order',
                        ],
                        'default_value' => 'date',
                        'wrapper' => [
                            'width' => '50',
                        ],
                    ],
                    [
                        'label' => __('Order', 'flynt'),
                        'name' => 'order',
                        'type' => 'radio',
                        'layout' => 'horizontal',
                        'choices' => [
                            'ASC' => 'Ascending',
                            'DESC' => 'Descending',
                        ],
                        'default_value' => 'DESC',
                        'wrapper' => [
                            'width' => '50',
                        ],
                    ],
                ],
            ],
        ],
    ];
}

Options::addGlobal('BlockPostsArchive', [
    [
        'label' => __('Load More Button?', 'flynt'),
        'name' => 'loadMore',
        'type' => 'true_false',
        'default_value' => 0,
        'ui' => 1,
    ],
    [
        'label' => __('Default Max Columns', 'flynt'),
        'name' => 'defaultMaxColumns',
        'type' => 'select',
        'choices' => [1, 2, 3],
    ],
    [
        'label' => __('Labels', 'flynt'),
        'name' => 'labelsTab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
    ],
    [
        'label' => '',
        'name' => 'labels',
        'type' => 'group',
        'sub_fields' => [
            [
                'label' => __('Previous', 'flynt'),
                'name' => 'previous',
                'type' => 'text',
                'default_value' => 'Prev',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Next', 'flynt'),
                'name' => 'next',
                'type' => 'text',
                'default_value' => 'Next',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Load More', 'flynt'),
                'name' => 'loadMore',
                'type' => 'text',
                'default_value' => 'Load more',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('No Posts Found Text', 'flynt'),
                'name' => 'noPostsFound',
                'type' => 'text',
                'default_value' => 'No posts found.',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('All Posts', 'flynt'),
                'name' => 'allPosts',
                'type' => 'text',
                'default_value' => 'All',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Read More', 'flynt'),
                'name' => 'readMore',
                'type' => 'text',
                'default_value' => 'Read More',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [FieldVariables\setContainerSize()],
            ],
        ],
    ],
]);

// Options::addTranslatable('BlockPostsArchive', [

// ]);
