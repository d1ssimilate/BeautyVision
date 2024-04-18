<?php
/*
Template Name: Блог
Template Post Type: page
*/
get_header(); ?>
<main class="main container">
    <h1 class="main__title">Блог</h1>
    <div class="blogs">
        <?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 15,
    );
    $custom_query = new WP_Query($args);
    if ($custom_query->have_posts()):
        while ($custom_query->have_posts()):
            ?>
        <div class="card">
            <?php
                $custom_query->the_post();
                $thumbnail_title = get_the_title();
            $thumbnail_alt = get_the_title();
            $thumbnail = get_the_post_thumbnail(null, 'post-thumbnail', ['title' => $thumbnail_title, 'alt' => $thumbnail_alt]);
            echo $thumbnail;
                ?>

            <div class="card__content">
                <h2 class="card__title">
                    <?= the_title(); ?>
                </h2>
                <div class="card__info">
                    <div class="card__description">
                        <?= the_excerpt(); ?>
                    </div>
                    <button class="card__detail">
                        <?= the_shortlink('Подробнее'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else:
        _e("Не найдено ни одной записи", "textdomain");
    endif;
?>

    </div>
</main>
<?php
get_footer();