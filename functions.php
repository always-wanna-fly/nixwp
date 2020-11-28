<?php
require_once ('kama.php');
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
            'taxonomies'=>array(),
            'rewrite'=>true,
            'query_var'=>true,

        ));
}
add_action('init', 'create_post_type');


//add_action( 'add_meta_boxes_'.'consoles_news', 'adding_custom_meta_boxes' );
//function adding_custom_meta_boxes( $post ) {
//    add_meta_box( 'my-meta-box', 'Мой метаблок', 'render_my_meta_box', 'consoles_news', 'normal', 'default' );
//}
//
//function render_my_meta_box(){
//    echo 'HTML метаблока';
//}

class_exists('Kama_Post_Meta_Box') && new Kama_Post_Meta_Box( array(
    'id'     => '_seo',
    'post_type'=>'consoles_news',
    'title'  => 'SEO поля',
    'fields' => array(
        'title' => array(
            'type'=>'text',    'title'=>'Title',       'desc'=>'Заголовок страницы (рекомендуется 70 символов)', 'attr'=>'style="width:99%;"'
        ),
        'description' => array(
            'type'=>'textarea','title'=>'Description', 'desc'=>'Описание страницы (рекомендуется 160 символов)', 'attr'=>'style="width:99%;"'
        ),
        'keywords' => array(
            'type'=>'text',    'title'=>'Keywords',    'desc'=>'Ключевые слова для записи',       'attr'=>'style="width:99%;"'
        ),
        'robots' => array(
            'type'=>'radio',   'title'=>'Robots',      'options' => array(''=>'index,follow', 'noindex,nofollow'=>'noindex,nofollow')
        ),
    ),
) );
//Register Meta Box
//function rm_register_meta_box() {
//    add_meta_box( 'rm-meta-box-id', esc_html__( 'Мій MetaBox', 'text-domain' ), 'rm_meta_box_callback', 'consoles_news', 'advanced', 'high' );
//}
//add_action( 'add_meta_boxes', 'rm_register_meta_box');
//
////Add field
//function rm_meta_box_callback( $meta_id ) {
//
//    $outline = '<label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Альтернативний опис', 'text-domain') .'</label>';
//    $title_field = get_post_meta( $meta_id->ID, 'title_field', true );
//    $outline .= '<input type="text" name="title_field" id="title_field" class="title_field" value="'. esc_attr($title_field) .'" style="width:300px;"/>';
//
//    echo $outline;
//}