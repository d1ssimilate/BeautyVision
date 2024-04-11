<?php

get_header();

 
?>

<!-- <h1>Посты / Новости</h1>
<div class="accordion">
    <div class="accordion-item">
        <div class="accordion-header">Заголовок 1</div>
        <div class="accordion-content">Содержимое 1</div>
    </div>
    <div class="accordion-item">
        <div class="accordion-header">Заголовок 2</div>
        <div class="accordion-content">Содержимое 2</div>
    </div>
</div> -->


<main>

    <!-- <?php 
    $args = array(
        'post_type' => 'insight',
        'posts_per_page' => 4,  // Количество постов для вывода
    );
    $custom_query = new WP_Query($args);
    if ($custom_query->have_posts()):
    while ($custom_query->have_posts()):
            ?>
    <div class="post">
        <?php
                $custom_query->the_post();
                ?>
        <h2>
            <?= the_title(); ?>
        </h2>
        <p>
            <?= the_post_thumbnail('thumbnail'); ?>
        </p>
        <p>
            <?= the_excerpt(); ?>
        </p>
        <p>
            <?= the_shortlink('- more details -'); ?>
        </p>
    </div>
    <?php
        endwhile;
        wp_reset_postdata();
else:
    _e("Не найдено ни одной записи", "textdomain");
endif;
?> -->
    <?php 
    if (have_posts()):
    while (have_posts()):
            ?>
    <div class="post">
        <?php
                the_post();
                ?>
        <h2>
            <?= the_title(); ?>
        </h2>
        <p>
            <?= the_post_thumbnail('thumbnail'); ?>
        </p>
        <p>
            <?= the_excerpt(); ?>
        </p>
        <p>
            <?= the_shortlink('- more details -'); ?>
        </p>
    </div>
    <?php
        endwhile;
        wp_reset_postdata();
else:
    _e("Не найдено ни одной записи", "textdomain");
endif;
?>
</main>
<?php
get_footer();