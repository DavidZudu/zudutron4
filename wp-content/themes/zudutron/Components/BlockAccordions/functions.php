<?php

namespace Flynt\Components\BlockAccordions;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockAccordions', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'blockAccordions',
        'label' => __('Block: Accordions', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            FieldVariables\setIntro(),
            [
                'label' => __('Accordions', 'flynt'),
                'name' => 'accordions',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Accordion',
                'sub_fields' => [
                    [
                        'label' => __('Title', 'flynt'),
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => [
                            'width' => '70'
                        ],
                    ],                    
                    [
                        'label' => __('Load Open?', 'flynt'),
                        'name' => 'isOpen',
                        'type' => 'true_false',
                        'wrapper' => [
                            'width' => '30'
                        ],
                    ],
                    [
                        'label' => __('Content', 'flynt'),
                        'name' => 'content',
                        'type' => 'wysiwyg',
                    ],
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
                    FieldVariables\setContainerSize(),
                    FieldVariables\setBackgroundColor(),
                    FieldVariables\setPadding(),
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