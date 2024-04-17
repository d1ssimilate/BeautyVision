<?php

require get_template_directory() . '/widgets/post-type-stuff/class-taxonomy-widget.php';
require get_template_directory() . '/widgets/post-type-stuff/class-posts-type-widget.php';
require get_template_directory() . '/widgets/post-type-stuff/class-posts-taxonomy-widget.php';
require get_template_directory() . '/widgets/post-type-stuff/class-post-id-widget.php';

require get_template_directory() . '/widgets/post-type-advantages/class-taxonomy-widget.php';
require get_template_directory() . '/widgets/post-type-advantages/class-posts-type-widget.php';
require get_template_directory() . '/widgets/post-type-advantages/class-post-id-widget.php';

add_action('wp_enqueue_scripts', 'theme_enqueue_files');

function theme_enqueue_files()
{
    $theme_uri = get_template_directory_uri();
    $css_uri = get_stylesheet_uri();
    wp_enqueue_style('style', $css_uri);
    wp_enqueue_style('app', $theme_uri . '/css/app.css');

    wp_enqueue_script( 'modal', get_stylesheet_directory_uri() . '/js/accordion.js', array( 'jquery' ), '3.0' );
}


add_filter('nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1);

function custom_nav_menu_css_class($classes) {
    $classes[] ='nav_item';
    
    return $classes;
}

function taxonomy_widgets_init() {
    register_sidebar( array(
        'name' => 'Custom_Taxonomy_Widget',
        'id' => 'custom_taxonomy_widget',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}

add_action( 'widgets_init', 'taxonomy_widgets_init' );