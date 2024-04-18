<?php

get_header();

$url = $_SERVER['REQUEST_URI'];

if (str_contains($url, 'cart')) {
    get_template_part('cart');
} elseif (str_contains($url, 'my-account')) {
    get_template_part('account');
} elseif (str_contains($url, 'checkout')) {
    get_template_part('checkout');
}  elseif (str_contains($url, 'product-category')) {
    get_template_part('category');
}  elseif (str_contains($url, 'products')) {
    get_template_part('shop');
} 
 


get_footer();