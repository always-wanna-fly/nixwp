<?php get_header()?>
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

<?php get_footer()?>