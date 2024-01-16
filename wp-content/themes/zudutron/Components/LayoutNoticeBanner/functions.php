<?php

namespace Flynt\Components\LayoutNoticeBanner;

use Flynt\FieldVariables;
use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=LayoutNoticeBanner', function ($data) {
    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'layoutNoticeBanner',
        'label' => __('Layout: NoticeBanner', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('General', 'flynt'),
                'name' => 'generalTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
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
                    FieldVariables\getTheme()
                ],
            ],
        ]
    ];
}

Options::addGlobal('LayoutNoticeBanner', [
    [
        'label' => __('Toggle', 'flynt'),
        'name' => 'toggleNotice',
        'type' => 'true_false',
        'ui' => 1,
        'instructions' => 'Show the Notice banner?',
        'wrapper' => [
            'width'=>30,
        ],
    ],
    [
        'label' => __('Link', 'flynt'),
        'name' => 'noticeLink',
        'type' => 'link',
        'instructions' => 'Set the link and label',
        'wrapper' => [
            'width'=>70,
        ],
    ],
]);
