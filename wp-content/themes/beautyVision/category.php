<?php
/**
 * Template Name: Товары категории
 */
get_header();
?>
<main class="main container">
    <?php
global $wp_query;
$cat_slug = $wp_query->query_vars['product_cat'];

$category = get_term_by('slug', $cat_slug, 'product_cat');

// Выводим название категории
echo '<h1 class="main__title">' . $category->name . '</h1>';

// Аргументы для запроса товаров
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'product_cat'    => $cat_slug,
);

// Запрос товаров
$products = new WP_Query( $args );

// Выводим товары
if ( $products->have_posts() ) {
    echo '<div class="products">';
    while ( $products->have_posts() ) {
        $products->the_post();
        global $product;

        // Получаем цену
        $price = $product->get_price_html();

        // Получаем краткое описание
        $short_description = $product->get_short_description();
        
        // Получаем изображение
        $image = $product->get_image();
        
        echo '<div class="home__products-card card">';
        echo $image;
        echo '<div class="card__content card">';
        echo '<h2 class="card__title">' . get_the_title() . '</h2>';
        echo '<div class="card__info">';
        echo '<p class="card__description card__price">' . $price . '</p>';
        echo '</div>';
        echo '<button class="card__detail">';
        echo '<a href="' . get_permalink() . '">Подробнее</a>';
        echo '</button>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo 'Товаров в этой категории нет.';
}
?>
</main>
<?php
get_footer();
?>