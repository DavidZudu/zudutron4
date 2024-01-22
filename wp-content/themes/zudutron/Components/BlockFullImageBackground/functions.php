<?php

namespace Flynt\Components\BlockFullImageBackground;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockFullImageBackground', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'blockFullImageBackground',
        'label' => __('Block: Full Image Background', 'flynt'),
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
                'label' => __('Content Position', 'flynt'),
                'name' => 'contentPosition',
                'type' => 'button_group',
                'wrapper' => [
                    'width' => '50',
                ],
                'choices' => [
                    'content-left' => 'Left',
                    'content-right' => 'Right'
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
                    FieldVariables\setPadding(['']),
                    FieldVariables\setPaddingSize(),
                    // FieldVariables\setBackgroundPattern(),
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