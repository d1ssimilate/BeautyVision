<?php $theme_uri = get_template_directory_uri(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Beauty Vision</title>
    <link rel="shortcut icon" href="<?= $theme_uri . '/images/logo.svg' ?>">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <?php wp_head(); ?>
</head>

<body>

    <div class="wrapper">
        <header class="header">
            <a href="/" class="header__start">
                <img class="header__logo" src="<?= $theme_uri . '/images/logo.svg' ?>" alt="">
                <h1>BEAUTY VISION</h1>
            </a>
            <?php
            $args = [
                'menu_class'        => 'header__menu', 
                'menu_id'           => false, 
                'echo'              => true,
                'depth'             => 0, 
                'walker'            => '',
                'theme_location'    => '', 
            ];
            wp_nav_menu($args);
            ?>
        </header>