<?php


get_header(); ?>

<main id="page-shop" class="main container">
    <h1 class="main__title">Категории товаров</h1>
    <div class="categories">
        <?php
$args = array(
    'taxonomy'     => 'product_cat', // Указываем, что хотим вывести категории товаров
    'show_count'   => true, // Показывать количество товаров в категории
    'hierarchical' => true, // Использовать иерархический вид
    'title_li'     => '', // Не показывать заголовок "Категории"
);

$categories = get_categories( $args );


foreach ( $categories as $category ) {
    echo '<a class="categories__card" href="' . get_term_link( $category ) . '">';
    echo '<div class="categories__card-сover">';
    echo $category->description; 
    echo '<h2>' . $category->name . '</h2>';
    echo '</div>';
    echo '</a>';
}
?>
    </div>
</main>
<?php
get_footer();