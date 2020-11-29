<?php get_header()?>
    <main>
        <div class="container">
            <div class="title">
                <h1><?php the_title()?></h1>
            </div>
            <div class="image">
                <?php the_post_thumbnail(); ?>
            </div>

            <div class="container">
                <p><?php the_content();?></p>
                <?php $meta_value = get_post_meta( get_the_ID(), '', true ); ?>
            </div>
            <div>
                <p>Metaboxes:</p>
                <p>title:<?php echo $meta_value['title'][0]?></p>
                <p>description:<?php echo $meta_value['description'][0]?></p>
                <p>keywords:<?php echo $meta_value['keywords'][0]?></p>
                <p>robots:<?php echo $meta_value['robots'][0]?></p>
            </div>
            <div>
                <p>Taxonomy terms:</p>
                <p><?php the_terms(get_the_ID(), 'types', '', '/', '')?></p>
            </div>
        </div>
    </main>



<?php get_footer()?>