<?php

use ACFComposer\ACFComposer;
use Flynt\Components;
use Flynt\FieldVariables;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'navFields',
        'title' => 'Nav Fields',
        'style' => 'seamless',
        'fields' => [
          [
            'label' => __('Link Style', 'flynt'),
            'name' => 'style',
            'type' => 'radio',
            'default_value' => 'first-level',
            'layout' => 'horizontal',
            'choices' => [
                'first-level' => 'First level',
                'second-level' => 'Second Level',
                'third-level' => 'Third Level',
            ],
        ],
        [
          'name' => 'icon',
          'label' => __('Nav Icon', 'flynt'),
          'type' => 'font-awesome',
          'instructions' => 'Use an icon instead of the text label.',
          'icon_sets' => ['fas', 'far', 'fab'],
          'save_format' => 'class'
        ],  
            [
                'label' => __('Description', 'flynt'),               
                'name' => 'description',
                'type' => 'textarea',
                'rows' => '2',
            ],
            
            FieldVariables\setCTAs(),
        ],
        'location' => [
            [
                [
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
                ],
            ],
        ],
    ]);
});
