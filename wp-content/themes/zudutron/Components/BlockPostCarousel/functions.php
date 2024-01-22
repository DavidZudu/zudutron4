<?php

namespace Flynt\Components\BlockPostCarousel;

use Flynt\FieldVariables;
use Flynt\Utils\Options;
use Timber\Term;
use Timber\Timber;

const POST_TYPE = 'post';
const FILTER_BY_TAXONOMY = 'category';

add_filter('Flynt/addComponentData?name=BlockPostCarousel', function ($data) {
    if ($data['streamType'] == 'type') {
        $postType = $data['postTypeSelect'];
    } elseif ($data['streamType'] == 'term') {
        $postType = '';
    }

    if ($data['streamType'] == 'term') {
        if ($data['postTermSelect'] != 'all') {
            $term = get_term($data['postTermSelect']);
            // var_dump($data['postTermSelect']);
            $termQuery = [
                'taxonomy' => $term->taxonomy,
                'field' => 'id',
                'terms' => $term->term_id, // Where term_id of Term 1 is "1".
            ];
        } else {
            $termQuery = '';
        }
    } else {
        $termQuery = '';
    }

    $ppp = isset($data['options']['numberPosts'])
        ? $data['options']['numberPosts']
        : 6;
    $skip = isset($data['options']['skipPosts'])
        ? $data['options']['skipPosts']
        : 0;
    $orderby = isset($data['options']['orderBy'])
        ? $data['options']['orderBy']
        : 'date';
    $order = isset($data['options']['order'])
        ? $data['options']['order']
        : 'DESC';

    if ($data['streamType'] == 'manual') {
        $data['posts'] = $data['manualSelect'];
    } else {
        $queriedObject = Timber::get_posts([
            'post_status' => 'publish',
            'post_type' => $postType,
            'posts_per_page' => $ppp,
            'ignore_sticky_posts' => 1,
            'offset' => $skip,
            'paged' => 0,
            'orderby' => $orderby,
            'order' => $order,
            'tax_query' => [$termQuery],
        ]);
        $data['posts'] = $queriedObject;
    }

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'BlockPostCarousel',
        'label' => 'Block: Post Carousel',
        'sub_fields' => [
            [
                'label' => __('General', 'flynt'),
                'name' => 'generalTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Stream Type', 'flynt'),
                'name' => 'streamType',
                'type' => 'radio',
                'layout' => 'horizontal',
                'choices' => [
                    'type' => 'By Post Type',
                    'term' => 'By Term',
                    'manual' => 'Manual Select',
                ],
            ],
            [
                'label' => __('Post Type', 'flynt'),
                'name' => 'postTypeSelect',
                'type' => 'select',
                // Populated dynamically in ../../inc/populateFields.php
                'wrapper' => [
                    'width' => '50',
                ],
                'conditional_logic' => [
                    [
                        [
                            'fieldPath' => 'streamType',
                            'operator' => '==',
                            'value' => 'type',
                        ],
                    ],
                ],
            ],
            [
                'label' => __('Post Taxonomy', 'flynt'),
                'name' => 'postTermSelect',
                'type' => 'select',
                // Populated dynamically in ../../inc/populateFields.php
                'wrapper' => [
                    'width' => '50',
                ],
                'conditional_logic' => [
                    [
                        [
                            'fieldPath' => 'streamType',
                            'operator' => '==',
                            'value' => 'term',
                        ],
                    ],
                ],
            ],
            [
                'label' => __('Manual Select', 'flynt'),
                'name' => 'manualSelect',
                'type' => 'relationship',
                'conditional_logic' => [
                    [
                        [
                            'fieldPath' => 'streamType',
                            'operator' => '==',
                            'value' => 'manual',
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
                'sub_fields' => [
                    FieldVariables\setContainerSize(),
                    FieldVariables\setBackgroundColor(),
                    FieldVariables\setPadding(),
                    FieldVariables\setPaddingSize(),
                    // FieldVariables\setBackgroundPattern(),
                    FieldVariables\setAnchor(),
                    [
                        'label' => __('Max Columns', 'flynt'),
                        'name' => 'maxColumns',
                        'type' => 'select',
                        'choices' => [
                            '1' => 'one',
                            '2' => 'two',
                            '3' => 'three',
                            '4' => 'four',
                        ],
                        'default_value' => 'two',
                        'wrapper' => [
                            'width' => '50',
                        ],
                    ],
                    [
                        'label' => __('Skip Posts', 'flynt'),
                        'name' => 'skipPosts',
                        'type' => 'number',
                        'default_value' => '0',
                        'wrapper' => [
                            'width' => '33',
                        ],
                    ],
                    [
                        'label' => __('Max Number of Posts', 'flynt'),
                        'name' => 'numberPosts',
                        'type' => 'number',
                        'default_value' => 6,
                        'min' => '1',
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

// Options::addTranslatable('BlockPostCarousel', [

// ]);

// Options::addGlobal('BlockPostCarousel', [

// ]);
