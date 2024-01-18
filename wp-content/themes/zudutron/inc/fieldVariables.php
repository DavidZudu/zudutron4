<?php

/**
 * Defines field variables to be used across multiple components.
 */

namespace Flynt\FieldVariables;

function setContainerSize($default = 'container')
{
    return [
        'label' => __('Container Size', 'flynt'),
        'name' => 'containerSize',
        'type' => 'radio',
        'layout' => 'horizontal',
        'default_value' => $default,
        'choices' => [
            'container-none' => 'None',
            'container sm' => 'Small',
            'container' => 'Regular',
            'container lg' => 'Large',
        ],
        'instructions' => __(
            'Select the size of the content container',
            'flynt'
        ),
    ];
}

function setBackgroundColor()
{
    return [
        'label' => __('Background Color', 'flynt'),
        'name' => 'backgroundColor',
        'type' => 'radio',
        'layout' => 'horizontal',
        'default_value' => '',
        'choices' => [
            '' => 'None (white)',
            'bg-light' => 'Light Grey',
        ],
    ];
}
function setPaddingSize()
{
    return [
        'label' => __('Padding Size', 'flynt'),
        'name' => 'paddingSize',
        'type' => 'radio',
        'layout' => 'horizontal',
        'default_value' => 'componentSpacing',
        'choices' => [
            'componentSpacing-sm' => 'Small',
            'componentSpacing' => 'Regular',
            'componentSpacing-lg' => 'Large'
        ],
    ];
}
function setPadding($default = ['top','bottom'])
{
    return [
        'label' => __('Padding', 'flynt'),
        'name' => 'padding',
        'type' => 'checkbox',
        'layout' => 'horizontal',
        'return_value' => 'value',
        'default_value' => $default,
        'choices' => [
            'top' => 'Top',
            'bottom' => 'Bottom',
        ],
    ];
}
function setBackgroundPattern()
{
    return [
        'label' => __('Background Pattern', 'flynt'),
        'name' => 'backgroundPattern',
        'type' => 'select',
        'default_value' => '',
        'choices' => [
            '' => 'None',
            'one' => 'One',
            'two' => 'Two',
        ],
    ];    
}

// Using BG Pattern
//     {% if options.patternSelect == 'one' %}
//       <img class="bg-pattern pattern-1"
//         src="{{ theme.link ~ '/assets/images/pattern-1' }}"
//         alt="" />
//     {% else %}
//       <img class="bg-pattern pattern-2"
//         src="{{ theme.link ~ '/assets/images/pattern-2l.png' }}"
//         alt="" />
//       <img class="bg-pattern pattern-2"
//         src="{{ theme.link ~ '/assets/images/pattern-2r.png' }}"
//         alt="" />
//     {% endif %}



function setCTAs()
{
    return [
        'label' => __('Calls To Action', 'flynt'),
        'name' => 'ctaLinks',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Add Button',
        'sub_fields' => [
            [
                'label' => __('CTA', 'flynt'),
                'name' => 'cta',
                'type' => 'link',
                'wrapper'=> [
                    'width'=>'60'
                ]
            ],
            [
                'label' => __('Button Style', 'flynt'),
                'name' => 'style',
                'type' => 'radio',
                'layout' => 'horizontal',
                'default_value' => '',
                'choices' => [
                    '' => 'Pink',
                    'purple' => 'Purple',
                    'white' => 'White',
                ],
                'wrapper'=> [
                    'width'=>'40'
                ]
            ],
        ],
    ];
}
function setIntro()
{
    return [
        'label' => __('Section Intro', 'flynt'),
        'name' => 'sectionIntro',
        'type' => 'wysiwyg',
        'default_value' => '<h2>Section Title Here</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac malesuada ex. Proin at sollicitudin magna. Cras elementum sapien sit amet elit porta, et tincidunt mi finibus.</p>',
        'wrapper' => array (
            'class' => 'sm',
        ),
    ];    
}
function setAnchor()
{
    return [
        'label' => __('Section Anchor', 'flynt'),
        'name' => 'sectionAnchor',
        'type' => 'text',
        'instructions' => 'Anchor'        
    ];    
}