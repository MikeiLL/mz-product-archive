<?php

function mzoo_add_category_parent_css($css_classes, $category, $depth, $args){
    $css_classes[] = 'list-inline-item';
    return $css_classes;
}

add_filter( 'category_css_class', 'mzoo_add_category_parent_css', 10, 4);