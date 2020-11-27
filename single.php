<?php get_header(); ?>
   <?php if (have_posts()): while (have_posts()): the_post();?>
    <main>
        <div class="container">
            <div class="title">
                <h1><?php the_title()?></h1>
            </div>
            <div class="image">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="description">
                <p><?php the_content();?></p>
            </div>
        </div>
    </main>
    <hr><?php endwhile;else: ?>

    <p><?php _e('Sorry, no posts')?></p><?php endif;?>
<?php get_footer();?>