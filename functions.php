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
    add_theme_support('post-thumbnails', array('post', 'consoles_news'));
    add_image_size('post_thumb', 200, 200, true);
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

function create_post_type(){
    register_post_type('consoles_news',
        array(
            'labels'=>array(
                'name'=>'Новина',
                'singular_name'=>'Новина',
                'add_new'=>'Додати нову новину',
                'add_new_item'=>'Додати новину',
                'edit_item'=>'Редагувати',
                'view_item'=>'Перегляд',
                'search_items'=>'Знайти новину',
                'not_found'=>'Не знайдено',
                'not_found_in_trash'=>'Не знайдено в корзині',
                'parent_item_colon'=>'',
                'menu_name'=>'Новини та анонси',
            ),
            'has_archive'=>true,
            'public'=>true,
            'description'=>'Новини та анонси',

            'publicly_queryable'=>true,
            'exclude_from_search'=>true,
            'show_ui'=>true,
            'show_in_menu'=>true,
            'show_in_admin_bar'=>true,
            'show_in_nav_menus'=>true,
            'show_in_rest'=>true,
//            'rest_base'=>true,
            'menu_position'=>4,
            'menu_icon'=>null,
            'hierarchical'=>false,
            'supports'=>array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
            'taxonomies'=>array('tags'),

            'rewrite'=>true,
            'query_var'=>true,

        ));
}
add_action('init', 'create_post_type');