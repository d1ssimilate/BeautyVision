<?php
/*
Template Name: Контакты
Template Post Type: page
*/
get_header(); ?>
<main id="page-contacts" class="main container">
    <h1 class="main__title">Контакты</h1>
    <div class="contacts">
        <div class="contacts__info">
            <span class="contacts__info-detail">
                <strong>Адрес:</strong> ул. Примерная, 23 A, г. Ижевск
            </span>
            <span class="contacts__info-detail">
                <strong>Телефон:</strong> +7 (924) 465-47-32
            </span>
            <span class="contacts__info-detail">
                <strong>Электронная почта:</strong> info@beautyvision.com
            </span>
        </div>
        <?=do_shortcode('[contact-form-7 id="78dbd38" title="Контактная форма"]') ?>
    </div>
</main>
<?php
get_footer();