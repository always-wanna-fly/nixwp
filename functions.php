<?php

add_action('wp_enqueue_scripts', 'load_assets');

function load_assets(){
    wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.js');
    wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/assets/css/bootstrap.css');
    wp_enqueue_style('default-css', get_template_directory_uri().'/assets/css/style.css');
}
add_action('after_setup_theme', 'theme_register_nav_menu');

function theme_register_nav_menu(){
    register_nav_menu('top', 'header menu on top');
    register_nav_menu('footer', 'footer menu on bottom');
}

add_action('widgets_init', 'register_my_widgets');

function register_my_widgets(){
    register_sidebar( array(
        'name'=>'My sidebar',
        'id'=>'my_sidebar',
        'description'=>'desc my sidebar',
        'before_widget'=>'<div class="widget %2$s">',
        'after_widget'=>"</div>\n",
        'before_title'=>'<h5 class="widgettitle">',
        'after_title'=>"</h5>\n"
    ));
    register_sidebar( array(
        'name'=>'Search sidebar',
        'id'=>'search_sidebar',
        'description'=>'desc my sidebar',
        'before_widget'=>'<div class="widget %2$s">',
        'after_widget'=>"</div>\n",
        'before_title'=>'<h5 class="widgettitle">',
        'after_title'=>"</h5>\n"
    ));
}