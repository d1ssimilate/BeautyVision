<?php
/*
Template Name: Блог
Template Post Type: page
*/
get_header(); ?>
<!-- <?php
    $args = array(
        'post_type' => 'staff',
        'tax_query' => array(
            array(
                'taxonomy' => 'custom_section',
                'field' => 'name',
                'terms' => 'Парикмахерское отделение'
            )
        ),
        'posts_per_page' => 15,
    );
    $custom_query = new WP_Query($args);
    if ($custom_query->have_posts()):
        while ($custom_query->have_posts()):
            ?>
                    <div class="blog-card">
                        <?php
                $custom_query->the_post();
                ?>
                        <?= the_post_thumbnail('thumbnail'); ?>
                        <div class="blog-card__content">
                            <h2 class="blog-card__title">
                                <?= the_title(); ?>
                            </h2>
                            <div class="blog-card__info">
                                <div class="blog-card__description">
                                    <?= the_excerpt(); ?>
                                </div>
                                <button class="blog-card__detail">
                                    <?= the_shortlink('Подробнее'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
        endwhile;
        the_posts_pagination(array(
            'prev_text' => '« Назад',
            'next_text' => 'Вперед »',
        ));
        wp_reset_postdata();
    else:
        _e("Не найдено ни одной записи", "textdomain");
    endif;
?> -->
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
        <div class="blog-card">
            <?php
                $custom_query->the_post();
                ?>
            <?= the_post_thumbnail('thumbnail'); ?>
            <div class="blog-card__content">
                <h2 class="blog-card__title">
                    <?= the_title(); ?>
                </h2>
                <div class="blog-card__info">
                    <div class="blog-card__description">
                        <?= the_excerpt(); ?>
                    </div>
                    <button class="blog-card__detail">
                        <?= the_shortlink('Подробнее'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
        endwhile;
        the_posts_pagination(array(
            'prev_text' => '« Назад',
            'next_text' => 'Вперед »',
        ));
        wp_reset_postdata();
    else:
        _e("Не найдено ни одной записи", "textdomain");
    endif;
?>

    </div>
</main>
<?php
get_footer();