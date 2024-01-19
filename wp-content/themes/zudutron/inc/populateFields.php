<?php

/**
 * Populates any fields that require programatic population.
 */

//  Post Type Select Field populated with post types
add_filter('acf/load_field/name=postTypeSelect', 'acf_load_post_types');
function acf_load_post_types($field)
{
    foreach ( get_post_types( '', 'names' ) as $post_type ) {
        $disallowed = ['attachment','revision','nav_menu_item','custom_css','customize_changeset', 'oembed_cache', 'user_request','wp_block','acf-field-group','acf-field'];
        if (!in_array($post_type, $disallowed)){
            $field['choices'][$post_type] = $post_type;
        }     
    }

    // return the field
    return $field;
}

// //  Populate Taxnonomies in the options.
// //  the key used here is the field's name attribute generated and used in the DOM, in this case: name="acf[field_global_TaxonomyOptions_taxFilters]"
// add_filter('acf/load_field/key=field_global_TaxonomyOptions_taxFilters', 'acf_load_taxonomies');
// function acf_load_taxonomies($field)
// {
//     foreach ( get_taxonomies(null, 'objects') as $tax) {
//         $disallowed = ['Themes','Formats','Navigation Menus','Link Categories',];
//         if (!in_array($tax->label, $disallowed)){
//             $field['choices'][$tax->name] = $tax->label;
//         }     
//     }
//     // return the field
//     return $field;
// }

function mytest_reference_slug_output() {
    ?>
    <input name="mytheme_reference_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('mytheme_reference_slug')); ?>" placeholder="<?php echo 'reference'; ?>" />
    <?php
    }