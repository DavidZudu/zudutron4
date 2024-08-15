<?php

namespace Flynt\Components\BlockPostsArchive;

use Flynt\FieldVariables;
use Flynt\Utils\Options;
use Timber\Timber;

const POST_TYPE = 'post';
const FILTER_BY_TAXONOMY = 'category';

add_filter('Flynt/addComponentData?name=BlockPostsArchive', function ($data) {

    if (is_home() || is_archive() || is_single() || is_search() || is_post_type_archive()) {

        global $wp_query;

        // Create an object from the global WP_Query
        $query_object = (object) array(
            'posts' => $wp_query->posts,
            'post_count' => $wp_query->post_count,
            'max_num_pages' => $wp_query->max_num_pages,
            'found_posts' => $wp_query->found_posts,
            'current_page' => $wp_query->get('paged'),
            'query_vars' => $wp_query->query_vars,
        );

        $first_post = $query_object->posts[0];

        // Get the post type
        $postType = get_post_type($first_post);

    } else {
        // Set default query parameters
        $defaultPostsPerPage = 12;
        $defaultOrderBy = 'date';
        $defaultOrder = 'DESC';

        // Determine pagination and query variables
        $postsPerPage = get_option('posts_per_page', $defaultPostsPerPage);
        $paged = max(1, get_query_var('paged', 1));
        $orderBy = $data['options']['orderBy'] ?? $defaultOrderBy;
        $order = $data['options']['order'] ?? $defaultOrder;

        // Determine the post type from data or use 'post' as fallback
        $postType = $data['postTypeSelect'] ?? 'post';

        // Standard post type query
        $queryArgs = [
            'post_status' => 'publish',
            'post_type' => $postType,
            'posts_per_page' => $postsPerPage,
            'paged' => $paged,
            'orderby' => $orderBy,
            'order' => $order,
            'ignore_sticky_posts' => 1,
        ];

        // Query the posts using Timber
        $data['posts'] = Timber::get_posts($queryArgs);
    }

    // Get taxonomies related to the post type
    $data['taxs'] = get_taxonomies_for_post_type($postType, ['post_format']);

    // Return the modified data array
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
            // [
            //     'label' => __('Post Taxonomy', 'flynt'),
            //     'name' => 'postTermSelect',
            //     'type' => 'select',
            //     // Populated dynamically in ../../inc/populateFields.php
            //     'wrapper' => [
            //         'width' => '50',
            //     ],
            // ],
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
