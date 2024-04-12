<?php
/* Plugin name: Post Types 
Author: Роман Макаров
Version: 1.0
Description: Добавление типов к записям
*/
// Регистрация нового типа записи
function custom_post_type() {
    register_post_type('advantages', [
        'labels' => [
            'name' => 'Преимущества',
            'singular_name' => 'Преимущества',
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
    ]);

    register_post_type('staff', [
        'labels' => [
            'name' => 'Сотрудники',
            'singular_name' => 'Сотрудники',
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
    ]);
}
add_action('init', 'custom_post_type');

// Создание новой таксономии
function custom_taxonomy() {
    register_taxonomy('custom_section', ['advantages', 'staff'], [
        'labels' => [
            'name' => 'Разделы',
            'singular_name' => 'Раздел',
        ],
        'show_ui' => true,
        'show_tagcloud' => false,  
        'hierarchical' => true 
    ]);
}
add_action('init', 'custom_taxonomy');

// Добавление метабоксов
function custom_meta_boxes() {
    add_meta_box('custom_post_type_box', 'Выберите тип записи', 'custom_post_type_box_callback', ['advantages', 'staff'], 'side', 'default');
    add_meta_box('custom_excerpt_box', 'Краткое описание', 'custom_excerpt_box_callback', ['advantages', 'staff'], 'normal', 'default');
    add_meta_box('custom_thumbnail_box', 'Изображение (превью)', 'custom_thumbnail_box_callback', ['advantages', 'staff'], 'side', 'default');
}
add_action('add_meta_boxes', 'custom_meta_boxes');


// Callback-функции для метабоксов
function custom_post_type_box_callback($post) {
    $current_type = get_post_type($post);
    $types = get_post_types(['public' => true], 'objects');
    ?>
<label for="custom_post_type">Выберите тип записи:</label>
<select name="custom_post_type" id="custom_post_type">
    <?php foreach ($types as $type) : ?>
    <option value="<?php echo esc_attr($type->name); ?>" <?php selected($current_type, $type->name); ?>>
        <?php echo esc_html($type->labels->singular_name); ?>
    </option>
    <?php endforeach; ?>
</select>
<?php
}

function custom_excerpt_box_callback($post) {
    $excerpt = get_post_meta($post->ID, '_excerpt', true);
    ?>
<label for="excerpt">Краткое описание:</label>
<textarea name="excerpt" id="excerpt" rows="3"><?php echo esc_html($excerpt); ?></textarea>
<?php
}

function custom_thumbnail_box_callback($post) {
    $thumbnail_id = get_post_thumbnail_id($post->ID);
    echo wp_get_attachment_image($thumbnail_id, 'thumbnail');
    ?>
<input type="hidden" name="_thumbnail_id" id="_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>">
<button id="upload_thumbnail_button" class="button">Загрузить изображение</button>

<script>
jQuery(document).ready(function($) {
    $('#upload_thumbnail_button').click(function() {
        wp.media.editor.send.attachment = function(props, attachment) {
            $('#_thumbnail_id').val(attachment.id);
            $('#thumbnail').html('<img src="' + attachment.url + '" alt="Thumbnail">');
        };
        wp.media.editor.open();
        return false;
    });
});
</script>
<?php
}

function save_custom_post_type($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['custom_post_type']) || !current_user_can('edit_post', $post_id)) return;

    $selected_type = sanitize_text_field($_POST['custom_post_type']);
    set_post_type($post_id, $selected_type);

    if (isset($_POST['excerpt'])) {
        $excerpt = sanitize_text_field($_POST['excerpt']);
        update_post_meta($post_id, '_excerpt', $excerpt);
    }

    if (isset($_POST['_thumbnail_id'])) {
        $thumbnail_id = intval($_POST['_thumbnail_id']);
        set_post_thumbnail($post_id, $thumbnail_id);
    }
}
add_action('save_post', 'save_custom_post_type');


// Создание виджетов и шорткодов
function custom_single_post_shortcode($atts) {
    $atts = shortcode_atts(['id' => 0], $atts);
}
add_shortcode('custom_single_post', 'custom_single_post_shortcode');