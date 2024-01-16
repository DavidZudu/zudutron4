<?php

namespace Flynt\Components\NavigationJs;

use Timber;
use Flynt\Utils\Asset;
use Flynt\FieldVariables;
use Flynt\Utils\Options;

add_action('init', function () {
    register_nav_menus([
      'navigation_primary' => __('Navigation Primary', 'flynt')            
    ]);   
    register_nav_menus([
      'navigation_primary_extras' => __('Navigation Primary Extras', 'flynt')            
    ]);   
  });

add_filter('Flynt/addComponentData?name=NavigationJs', function ($data) {
    $data['menu'] = Timber::get_menu('navigation_primary') ?? Timber::get_pages_menu();
    $data['menuExtras'] = Timber::get_menu('navigation_primary_extras') ?? Timber::get_pages_menu();
    $data['logo'] = [
        'src' => get_theme_mod('custom_header_logo') ? get_theme_mod('custom_header_logo') : Asset::requireUrl('dist/assets/images/logo.svg'),
        'alt' => get_bloginfo('name')
      ];
    //   var_dump($data['menu']);
    return $data;
});

// Options::addTranslatable('NavigationJs', [

// ]);

Options::addGlobal('NavigationJs', [
    [
        'label' => '',
        'name' => 'options',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            FieldVariables\getContainerSize()
        ],
    ],
]);
