<?php

get_header();

 
?>



<main class="main container">
    <div class="home">
        <h2 class="home__title">Товары</h2>
        <div class="home__products">
            <?php
    $products = wc_get_products(array(
        'limit' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    if ($products) :

        foreach ($products as $product) :
    ?>
            <div class="home__products-card card">
                <?= $product->get_image() ?>
                <div class="card__content">
                    <h3 class="card__title"><?= $product->get_name() ?></h3>
                    <div class="card__info">
                        <p class="card__description"><?= $product->get_short_description() ?></p>
                        <p class="card__description card__price"><?= $product->get_price_html() ?></p>
                    </div>
                    <button class="card__detail">
                        <a href="<?= $product->get_permalink() ?>">Подробнее</a>
                    </button>
                </div>
            </div>
            <?php
        endforeach;
    else : ?>
            <h3>Не найдено</h3>
            <?php
    endif;
    ?>
        </div>
        <h2 class="home__title">Блог</h2>
        <div class="home__blogs">
            <?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
    );
    $custom_query = new WP_Query($args);
    if ($custom_query->have_posts()):
        while ($custom_query->have_posts()):
            ?>
            <div class="card">
                <?php
                $custom_query->the_post();
                ?>
                <?= the_post_thumbnail('thumbnail'); ?>
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
        <h2 class="home__title">Преимущества</h2>
        <div class="home__advantages">
            <?php echo do_shortcode('[custom_advantages]');?>
        </div>
        <h2 class="home__title">Сотрудники</h2>
        <div class="home__stuff">
            <?php echo do_shortcode('[custom_stuff posts_per_page="4"]');?>
        </div>
    </div>
</main>
<?php
get_footer();