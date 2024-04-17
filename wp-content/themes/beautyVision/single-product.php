<?php
/*
Template Name: Товар
Template Post Type: product
*/
$product_slug = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$product_path = get_page_by_path($product_slug, OBJECT, 'product');

// Проверяем, найден ли товар
if ($product_path) {
    $product_id = $product_path->ID;
    $product = wc_get_product( $product_id );
}
?>
<?php get_header(); ?>

<main id="page-product" class="main container">
    <div class="product">
        <div class="product__content">
            <h1 class="product__title"> <?= $product->get_name() ?></h1>
            <?= $product->get_image(); ?>
            <p class="product__description">
                Описание
            </p>
            <div class="product__text">
                <?= $product->get_description(); ?>
            </div>
        </div>
        <div class="product__details">
            <p class="product__price">Цена: <?= $product->get_price_html() ?></p>
            <?php
            echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="product__to-cart %s">%s</a>', esc_url($product->add_to_cart_url()), esc_attr($product->get_id()), esc_attr($product->get_sku()), $product->is_purchasable() ? 'add_to_cart_button' : '', $product->add_to_cart_text()), $product);
            
            echo comments_template();
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>