<?php get_header(); ?>
<?php
$argc = array('post_type'=>'consoles_news', 'posts_per_page'=>10);
$loop = new WP_Query($argc);

while($loop->have_posts()) : $loop->the_post();?>
    <main>
        <div class="container">
            <div class="row">
                <div class="post col-md-8">
                        <div><h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2></div>
                        <div class="w-25">
                            <a href="<?php the_permalink();?>"><?php the_post_thumbnail('post_thumb'); ?></a>
                        </div>
                        <div class="post-content">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="date">
                            <h6>Опубліковано <?php the_time('F jS, Y');?></h6>
                        </div>
                </div>
            </div>
        </div>



    </main>
<?php
//    the_title();
//    the_content();
    endwhile;
?>



<?php get_footer(); ?>