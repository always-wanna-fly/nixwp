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
