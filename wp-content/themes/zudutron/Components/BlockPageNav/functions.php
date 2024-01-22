<?php

namespace Flynt\Components\BlockPageNav;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockPageNav', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'blockPageNav',
        'label' => __('Block: Page Nav', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            // FieldVariables\setIntro(),
           
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
                    // FieldVariables\setAnchor()
                ]
            ]
        ]
    ];
}


// Options::addTranslatable('NavigationJs', [

// ]);

// Options::addGlobal('NavigationJs', [
   
// ]);