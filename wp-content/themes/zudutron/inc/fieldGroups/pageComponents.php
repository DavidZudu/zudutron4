<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageComponents',
        'title' => __('Page Components', 'flynt'),
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageComponents',
                'label' => __('Page Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BlockTitleBar\getACFLayout(),
                    Components\BlockPageNav\getACFLayout(),
                    Components\BlockAccordions\getACFLayout(),
                    Components\BlockSplitContent\getACFLayout(),
                    Components\BlockWysiwyg\getACFLayout(),
                    Components\BlockCTABar\getACFLayout(),
                    Components\BlockFullImageBackground\getACFLayout(),
                    Components\BlockPostsArchive\getACFLayout(),
                    Components\BlockTabs\getACFLayout(),
                    Components\BlockPostCarousel\getACFLayout(),
                    // Components\ReusableComponent\getACFLayout(),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ]
            ],
        ],
    ]);
});
