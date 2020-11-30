<?php get_header(); ?>

    <div class="slider">
            <?php echo do_shortcode('[my_short]') ?>
    </div>




    <main>
        <div class="container">
            <div class="row">
                <div class="post col-md-8">
                    <?php
                    if (have_posts()): while (have_posts()): the_post();?>
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

                        <!--                <p>--><?php //the_content(__('(more...)'));?><!--</p>-->
                        <hr><?php endwhile;else: ?>

                        <p><?php _e('Sorry, no posts')?></p><?php endif;?>
                </div>
                <div class="post col-md-4"><?php get_sidebar('my_sidebar'); ?></div>

            </div>
        </div>
        <div class="content">

            <div class="content">



            </div>

        </div>


    </main>


<?php get_footer(); ?>