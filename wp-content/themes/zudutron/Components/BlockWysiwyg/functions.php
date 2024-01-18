<?php

namespace Flynt\Components\BlockWysiwyg;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockWysiwyg', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'blockWysiwyg',
        'label' => __('Block: Wysiwyg', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Text', 'flynt'),
                'name' => 'contentHtml',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 1,
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