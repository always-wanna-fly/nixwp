<?php get_header(); ?>


<?php
$argc=array(
    'numberposts'=>5,
    'post_type'=>'consoles_news',
    'suppress_filters'=>true,
);
$posts = get_posts($argc);
foreach($posts as $post){setup_postdata($post);
    ?>
    <div><a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a></div>
    <div><?php the_title();?></div>
    <p><?php the_excerpt();?></p>
<?php }
wp_reset_postdata();
?>


<?php get_footer(); ?>