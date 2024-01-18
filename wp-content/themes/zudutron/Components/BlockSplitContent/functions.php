<?php

namespace Flynt\Components\BlockSplitContent;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockSplitContent', function ($data) {
     
    return $data;

});

function getACFLayout()
{
    return [
        'name' => 'blockSplitContent',
        'label' => __('Block: Split Content', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            
            [
                'label' => __('Image', 'flynt'),
                'name' => 'image',
                'type' => 'image',                
                'preview_size' => 'thumbnail',
                'wrapper' => [
                    'width' => '50',
                ]
            ],
            [
                'label' => __('Image Position', 'flynt'),
                'name' => 'imagePosition',
                'type' => 'button_group',
                'wrapper' => [
                    'width' => '50',
                ],
                'choices' => [
                    'image-left' => '<i class=\'dashicons dashicons-align-left\' title=\'Image on the left\'></i>',
                    'image-right' => '<i class=\'dashicons dashicons-align-right\' title=\'Image on the right\'></i>'
                ],                
            ],
            [
                'label' => __('Content', 'flynt'),
                'name' => 'content',
                'type' => 'wysiwyg',                
            ],
            FieldVariables\setCTAs(),
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
                    FieldVariables\setContainerSize(),
                    FieldVariables\setBackgroundColor(),
                    FieldVariables\setPadding([]),
                    FieldVariables\setPaddingSize(),
                    FieldVariables\setBackgroundPattern(),
                    FieldVariables\setAnchor()
                ]
            ]
        ]
    ];
}


// Options::addTranslatable('NavigationJs', [

// ]);

// Options::addGlobal('NavigationJs', [
   
// ]);