<?php
/*
Plugin Name: Custom SEO Fields
Plugin URI: https://example.com/plugins/custom-seo-fields
Description: Добавляйте на страницы пользовательские поля SEO для заголовка, описания и ключевых слов.
Version: 1.0
Author: Макаров Роман
*/

// Добавление метаполя для полей SEO
function custom_seo_fields_meta_box() {
    add_meta_box('custom-seo-fields', 'Настройки SEO', 'custom_seo_fields_callback', 'page', 'normal', 'high');
}

// Функция обратного вызова для рендеринга содержимого метаполя
function custom_seo_fields_callback($post) {
    // Получить текущие значения для полей SEO
    $title = get_post_meta($post->ID, '_custom_seo_title', true);
    $description = get_post_meta($post->ID, '_custom_seo_description', true);
    $keywords = get_post_meta($post->ID, '_custom_seo_keywords', true);

    // Поля вывода
    wp_nonce_field('custom_seo_fields_nonce', 'custom_seo_fields_nonce');
    ?>
<p>
    <label for="custom-seo-title">Title:</label><br>
    <input type="text" id="custom-seo-title" name="custom-seo-title" value="<?php echo esc_attr($title); ?>"
        style="width: 100%;">
</p>
<p>
    <label for="custom-seo-description">Description:</label><br>
    <textarea id="custom-seo-description" name="custom-seo-description"
        style="width: 100%;"><?php echo esc_textarea($description); ?></textarea>
</p>
<p>
    <label for="custom-seo-keywords">Keywords:</label><br>
    <input type="text" id="custom-seo-keywords" name="custom-seo-keywords" value="<?php echo esc_attr($keywords); ?>"
        style="width: 100%;">
</p>
<?php
}

// Сохранение данных пользовательских полей SEO
function save_custom_seo_fields_data($post_id) {
    // Проверка, является ли это автосохранением
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Проверка, установлен ли nonce
    if (!isset($_POST['custom_seo_fields_nonce']) || !wp_verify_nonce($_POST['custom_seo_fields_nonce'], 'custom_seo_fields_nonce')) return;

    // Проверка права пользователя
    if (!current_user_can('edit_page', $post_id)) return;

    // Сохранение данных
    if (isset($_POST['custom-seo-title'])) {
        update_post_meta($post_id, '_custom_seo_title', sanitize_text_field($_POST['custom-seo-title']));
    }
    if (isset($_POST['custom-seo-description'])) {
        update_post_meta($post_id, '_custom_seo_description', sanitize_textarea_field($_POST['custom-seo-description']));
    }
    if (isset($_POST['custom-seo-keywords'])) {
        update_post_meta($post_id, '_custom_seo_keywords', sanitize_text_field($_POST['custom-seo-keywords']));
    }
}

// Добавление пользовательские метатеги в раздел <head>
function custom_seo_meta_tags() {
    if (is_page()) {
        $post_id = get_the_ID();
        $title = get_post_meta($post_id, '_custom_seo_title', true);
        $description = get_post_meta($post_id, '_custom_seo_description', true);
        $keywords = get_post_meta($post_id, '_custom_seo_keywords', true);

        if (!empty($title)) {
            echo '<meta name="title" content="' . esc_attr($title) . '">' . "\n";
        }
        if (!empty($description)) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
        if (!empty($keywords)) {
            echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
        }
    }
}

// Инициализация к Wordpress
add_action('add_meta_boxes', 'custom_seo_fields_meta_box');
add_action('save_post', 'save_custom_seo_fields_data');
add_action('wp_head', 'custom_seo_meta_tags');