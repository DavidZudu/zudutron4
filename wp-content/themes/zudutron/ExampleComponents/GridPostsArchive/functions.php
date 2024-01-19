<?php

namespace Flynt\Components\GridPostsArchive;

use Flynt\FieldVariables;
use Flynt\Utils\Options;
use Timber\Timber;

const POST_TYPE = 'post';
const FILTER_BY_TAXONOMY = 'category';

add_filter('Flynt/addComponentData?name=GridPostsArchive', function ($data) {
    $data['uuid'] = $data['uuid'] ?? wp_generate_uuid4();
    $postType = POST_TYPE;
    $taxonomy = FILTER_BY_TAXONOMY;    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $ppp = get_option( 'posts_per_page' ) ? get_option( 'posts_per_page' ) : 12;    
    $orderby = isset($data['options']['orderBy']) ? $data['options']['orderBy'] : 'date';
    $order = isset($data['options']['order']) ? $data['options']['order'] : 'DESC';  

    /// IF NOT ARCHIVE
    /// gets postType and Taxonomy from Custom Field instead
    if (!is_archive()) {
        $postType = isset($data['postTypeSelect'])
            ? $data['postTypeSelect']
            : POST_TYPE;
        $data['posts'] = Timber::get_posts([
            'post_status' => 'publish',
            'post_type' => $postType,
            'posts_per_page' => $ppp,
            // 'offset' => $skip,
            'paged' => $paged,  
            'orderby'          => $orderby,
            'order'            => $order,   
        ]);    
        switch ($postType) {
                case 'post':
                    $taxonomy = 'category';
                    break;
                case 'article':
                    $taxonomy = 'topic';
                    break;
                default:
                    $taxonomy = 'category';
            }    
    }    
    //////////////////

    $queriedObject = get_queried_object();

    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    /// IF TAXONOMY PAGE ARCHIVE
    if (is_tax()){
        $terms = get_terms([
            'taxonomy' => get_queried_object()->taxonomy,
            'hide_empty' => true,
        ]);
        $postType = get_taxonomy($queriedObject->taxonomy)->object_type[0];
    }   

    if (count($terms) > 1) {
        $data['terms'] = array_map(function ($term) use ($queriedObject) {
            $timberTerm = Timber::get_term($term);
            if ($queriedObject->taxonomy ?? null) {
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
        'name' => 'gridPostsArchive',
        'label' => __('Grid: Posts Archive', 'flynt'),
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
                'label' => __('Post Taxonomy', 'flynt'),
                'name' => 'postTaxSelect',
                'type' => 'select',
                // Populated dynamically in ../../inc/populateFields.php
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                   
                    [
                        'label' => __('Max Columns', 'flynt'),
                        'name' => 'maxColumns',
                        'type' => 'select',
                        'choices' => [
                            'one'=>'one',
                            'two'=>'two',
                            'three'=>'three'
                        ],
                        'default_value' => 'two',
                        'wrapper' => [
                            'width' => '50',
                        ],  
                    ],                      
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

Options::addGlobal('GridPostsArchive', [
    [
        'label' => __('Load More Button?', 'flynt'),
        'name' => 'loadMore',
        'type' => 'true_false',
        'default_value' => 0,
        'ui' => 1,
    ],
]);

Options::addTranslatable('GridPostsArchive', [
    [
        'label' => __('Content', 'flynt'),
        'name' => 'general',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
    ],
    [
        'label' => __('Title', 'flynt'),
        'instructions' => __(
            'Want to add a headline? And a paragraph? Go ahead! Or just leave it empty and nothing will be shown.',
            'flynt'
        ),
        'name' => 'preContentHtml',
        'type' => 'wysiwyg',
        'tabs' => 'visual,text',
        'media_upload' => 0,
        'delay' => 0,
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
                'label' => __('Filter by', 'flynt'),
                'name' => 'filterBy',
                'type' => 'text',
                'default_value' => __('Filter by', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Previous', 'flynt'),
                'name' => 'previous',
                'type' => 'text',
                'default_value' => __('Prev', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Next', 'flynt'),
                'name' => 'next',
                'type' => 'text',
                'default_value' => __('Next', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Load More', 'flynt'),
                'name' => 'loadMore',
                'type' => 'text',
                'default_value' => __('Load More', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('No Posts Found Text', 'flynt'),
                'name' => 'noPostsFound',
                'type' => 'text',
                'default_value' => __('No post found.', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('All Posts', 'flynt'),
                'name' => 'allPosts',
                'type' => 'text',
                'default_value' => __('All', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
            [
                'label' => __('Reading Time - (20) min read', 'flynt'),
                'instructions' => __(
                    '%d is placeholder for number of minutes',
                    'flynt'
                ),
                'name' => 'readingTime',
                'type' => 'text',
                'default_value' => __('%d min read', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => 50,
                ],
            ],
            [
                'label' => __('Read More', 'flynt'),
                'name' => 'readMore',
                'type' => 'text',
                'default_value' => __('Read More', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
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
        'sub_fields' => [FieldVariables\getTheme()],
    ],
]);
