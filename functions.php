<?php
require_once ('kama.php');
add_action('wp_enqueue_scripts', 'load_assets');

function load_assets(){
    wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.js');
    wp_enqueue_script('main_js', get_template_directory_uri().'/assets/js/main.js', NULL, 1.0, true);
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
// Creating a Deals Custom Post Type
function crunchify_deals_custom_post_type() {
    $labels = array(
        'name'                => __( 'Новина' ),
        'singular_name'       => __( 'Новина'),
        'menu_name'           => __( 'Новини та анонси'),
        'parent_item_colon'   => __( 'Батьківська новина'),
        'all_items'           => __( 'Всі новини'),
        'view_item'           => __( 'Дивитись новину'),
        'add_new_item'        => __( 'Додати нову новину'),
        'add_new'             => __( 'Додати новину'),
        'edit_item'           => __( 'Редагувати новину'),
        'update_item'         => __( 'Редагувати новину'),
        'search_items'        => __( 'Пошук новин'),
        'not_found'           => __( 'Не знайдено'),
        'not_found_in_trash'  => __( 'Не знайдено в корзині')
    );
    $args = array(
        'label'               => __( 'consoles_news'),
        'description'         => __( ''),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => true,
        'can_export'          => true,
        'exclude_from_search' => false,
        'yarpp_support'       => true,
        'taxonomies' 	      => array('post_tag'),
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
    );
    register_post_type( 'consoles_news', $args );
}
add_action( 'init', 'crunchify_deals_custom_post_type', 0 );

// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'crunchify_create_deals_custom_taxonomy', 0 );

//create a custom taxonomy name it "type" for your posts
function crunchify_create_deals_custom_taxonomy() {

    $labels = array(
        'name' => _x( 'Теги', 'taxonomy general name' ),
        'singular_name' => _x( 'Тег', 'taxonomy singular name' ),
        'search_items' =>  __( 'Пошук тега' ),
        'all_items' => __( 'Всі теги' ),
        'parent_item' => __( 'Батьківський тег' ),
        'parent_item_colon' => __( 'Батьківський тег:' ),
        'edit_item' => __( 'Редагувати тег' ),
        'update_item' => __( 'Редагувати тег' ),
        'add_new_item' => __( 'Додати новий тег' ),
        'new_item_name' => __( 'Додати новий тег' ),
        'menu_name' => __( 'Теги' ),
    );

    register_taxonomy('types',array('consoles_news'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'type' ),
    ));
}



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

//add_shortcode('my_short', 'short_function');
//
//function short_function(){
//    return 'shortcode here';
//}
add_shortcode('my_short', 'short_function');
function short_function($atts)
{
    $atts = shortcode_atts([
        'numberposts' => 10,
        'orderby'     => 'date',
        'order'       => 'DESC'
    ], $atts);

    $posts = get_posts( array(
        'numberposts' => $atts['numberposts'],
        'orderby'     => $atts['orderby'],
        'order'       => $atts['order'],
        'post_type'   => 'consoles_news'
    ) );

    $out = '<div class="slider__wrapper">';


    foreach ($posts as $post):
        setup_postdata($post);

        $out .= '<div class="slider__item">

                
                <a href="'.get_the_permalink($post->ID).'"> '.get_the_post_thumbnail($post->ID).' </a>
                
                
        </div>';

    endforeach;


    $out .= '</div>
<a class="slider__control slider__control_left" href="#" role="button"></a>
        <a class="slider__control slider__control_right slider__control_show" href="#" role="button"></a>';


    wp_reset_postdata();

    return $out;
}