<?php

/**
 * Defines field variables to be used across multiple components.
 */

namespace Flynt\FieldVariables;

function getTheme($default = '')
{
    return [
        'label' => __('Theme', 'flynt'),
        'name' => 'theme',
        'type' => 'select',
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 0,
        'ajax' => 0,
        'choices' => [
            '' => __('(none)', 'flynt'),
            'light' => __('Light', 'flynt'),
            'dark' => __('Dark', 'flynt'),
        ],
        'default_value' => $default,
    ];
}


function getSize($default = 'medium')
{
    return [
        'label' => __('Size', 'flynt'),
        'name' => 'size',
        'type' => 'radio',
        'other_choice' => 0,
        'save_other_choice' => 0,
        'layout' => 'horizontal',
        'choices' => [
            'medium' => __('Medium', 'flynt'),
            'wide' => __('Wide', 'flynt'),
            'full' => __('Full', 'flynt'),
        ],
        'default_value' => $default
    ];
}

function getContainerSize()
{
    return [
        'label' => __('Container Size', 'flynt'),
        'name' => 'containerSize',
        'type' => 'select',
        'default_value' => 'container',
        'choices' => [
            'container-none' => 'None',
            'container sm' => 'Small',
            'container' => 'Regular',
            'container lg' => 'Large'
        ],
        'instructions' => __('Select the size of the content container', 'flynt'),
        'required' => 1
    ];
}
function getCTAFields()
{
    return [
        'label' => __('Calls To Action', 'flynt'),
        'name' => 'ctas',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Add Link',
        'sub_fields' => [
            [
                'label' => __('CTA', 'flynt'),
                'name' => 'cta',
                'type' => 'link',                
            ],
        ],
    ];    
}