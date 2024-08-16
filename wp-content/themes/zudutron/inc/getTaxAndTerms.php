<?php 
function getTaxAndTerms($post)
{
    $taxs = [];
    $taxNames = get_object_taxonomies($post);
    if (($key = array_search('post_format', $taxNames)) !== false) {
        unset($taxNames[$key]);
    }
    foreach ($taxNames as $tax) {
        array_push($taxs, get_taxonomy($tax));
    }
    foreach ($taxs as $key => $value) {
        $terms = get_the_terms($post->ID, $value->name);
        $taxs[$key]->terms = $terms;
    }
    return $taxs;
}

function get_taxonomies_for_post_type($post_type, $exclude_taxonomies = array()) {
    // Initialize an array to store taxonomies information
    $taxonomies_info = array();

    // Get all taxonomies associated with the given post type
    $taxonomies = get_object_taxonomies($post_type, 'objects');

    // Check if the post type is 'post' to include default categories and tags
    if ($post_type === 'post') {
        $taxonomies['category'] = get_taxonomy('category');
        $taxonomies['post_tag'] = get_taxonomy('post_tag');
    }

    // Loop through each taxonomy and gather the required information
    foreach ($taxonomies as $taxonomy) {
        // Skip excluded taxonomies
        if (in_array($taxonomy->name, $exclude_taxonomies)) {
            continue;
        }

        // Initialize the URL variable
        $taxonomy_archive_url = '#'; // Default fallback URL

        // Construct the taxonomy archive URL
        if (isset($taxonomy->rewrite['slug'])) {
            $taxonomy_archive_url = home_url($taxonomy->rewrite['slug']);
        } else {
            // For taxonomies without a rewrite slug, create a basic URL structure
            $taxonomy_archive_url = home_url('/' . $taxonomy->name . '/');
        }

        // Ensure the link is properly formatted
        $taxonomy_archive_url = trailingslashit($taxonomy_archive_url);

        // Fetch terms for this taxonomy
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy->name,
            'hide_empty' => true, // Only show non-empty terms
        ));

        // Initialize an array to store terms information
        $terms_info = array();

        // Loop through each term and gather the required information
        foreach ($terms as $term) {
            $terms_info[] = array(
                'slug'  => $term->slug,
                'name' => $term->name, // Term label is typically the term name
                'link'  => get_term_link($term->term_id, $taxonomy->name),
                'id'    => $term->term_id,
            );
        }

        $taxonomies_info[] = array(
            'name'     => $taxonomy->name, // Taxonomy name
            'label'    => $taxonomy->label, // Taxonomy label
            'link'     => $taxonomy_archive_url,
            'terms'    => $terms_info,
        );
    }

    return $taxonomies_info;
}



