<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_files');

function theme_enqueue_files()
{
    $theme_uri = get_template_directory_uri();
    $css_uri = get_stylesheet_uri();
    wp_enqueue_style('style', $css_uri);
    wp_enqueue_style('app', $theme_uri . '/css/app.css');

    wp_enqueue_script( 'modal', get_stylesheet_directory_uri() . '/js/modal.js', array( 'jquery' ), '3.0' );
}


add_filter('nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1);

function custom_nav_menu_css_class($classes) {
    $classes[] ='nav_item';
    
    return $classes;
}