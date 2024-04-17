<?php
class Advantages_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'Advantages_Widget',
            'Отображение поста с типом advantages',
            array('description' => 'Виджет для отображения записи типа "advantages" по её ID')
        );
    }

    public function widget($args, $instance) {
        // Вывод шорткода
        echo do_shortcode('[advantages id="' . $instance['advantages_id'] . '"]');
    }

    public function form($instance) {
        // Вывод формы настроек виджета
        $advantages_id = !empty($instance['advantages_id']) ? $instance['advantages_id'] : '';
        ?>
<p>
    <label for="<?php echo $this->get_field_id('advantages_id'); ?>">ID записи:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('advantages_id'); ?>"
        name="<?php echo $this->get_field_name('advantages_id'); ?>" type="text"
        value="<?php echo esc_attr($advantages_id); ?>">
</p>
<?php
    }
}
function register_advantages_widget() {
    register_widget('Advantages_Widget');
}
add_action('widgets_init', 'register_advantages_widget');

function advantages_shortcode($atts) {
    // Парсинг атрибутов шорткода
    $atts = shortcode_atts(
        array(
            'id' => '', // Значение по умолчанию для атрибута id
        ),
        $atts,
        'advantages'
    );

    // Получаем ID из атрибута шорткода
    $id = $atts['id'];

    // Проверка наличия ID
    if (empty($id)) {
        return 'Не указан ID записи';
    }

    // Получаем запись по ID
    $stuff_post = get_post($id);

    // Проверка наличия записи и её типа
    if (!$stuff_post || $stuff_post->post_type !== 'advantages') {
        return 'Запись не найдена или не является типом "advantages"';
    }

    // Возвращаем контент записи
    return $stuff_post->post_content;
}
add_shortcode('advantages', 'advantages_shortcode');