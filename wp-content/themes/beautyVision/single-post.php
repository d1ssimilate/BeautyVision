<?php
get_header();
if (have_posts()):
    the_post(); 
    ?>
<main class="main container">
    <div class="blog">
        <div class="blog__main">
            <h1 class="blog__title">
                <?= the_title(); ?>
            </h1>
            <p>Пост опубликован: <?php the_date(); ?>, Автор: <?php the_author(); ?></p>
            <div class="blog__content">
                <?= the_content(); ?>
            </div>

        </div>
        <div class="blog__nav">
            <?php
             if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
            <?php
    
    the_post_navigation(
        array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('«', 'mytheme'),
            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('»', 'mytheme'),
        )
    );

   
endif;
?>
        </div>
    </div>

</main>
<?php
get_footer();