<?php 

function getTaxAndTerms($post){
    $taxs = [];
    $taxNames = get_object_taxonomies( $post );
    if (($key = array_search('post_format', $taxNames)) !== false) {
        unset($taxNames[$key]);
    }   
    foreach ( $taxNames as $tax ) {
        array_push($taxs,get_taxonomy($tax));        
    }
    foreach ( $taxs as $key => $value ) {
        $terms = get_the_terms( $post->ID, $value->name);
        $taxs[$key]->terms = $terms;    
    }
    return $taxs;
}

