<?php
class Stuff_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'stuff_widget',
            'Отображение поста с типом stuff',
            array('description' => 'Виджет для отображения записи типа "stuff" по её ID')
        );
    }

    public function widget($args, $instance) {
        // Вывод шорткода
        echo do_shortcode('[stuff id="' . $instance['stuff_id'] . '"]');
    }

    public function form($instance) {
        // Вывод формы настроек виджета
        $stuff_id = !empty($instance['stuff_id']) ? $instance['stuff_id'] : '';
        ?>
<p>
    <label for="<?php echo $this->get_field_id('stuff_id'); ?>">ID записи:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('stuff_id'); ?>"
        name="<?php echo $this->get_field_name('stuff_id'); ?>" type="text" value="<?php echo esc_attr($stuff_id); ?>">
</p>
<?php
    }
}
function register_stuff_widget() {
    register_widget('Stuff_Widget');
}
add_action('widgets_init', 'register_stuff_widget');

function stuff_shortcode($atts) {
    // Парсинг атрибутов шорткода
    $atts = shortcode_atts(
        array(
            'id' => '', // Значение по умолчанию для атрибута id
        ),
        $atts,
        'stuff'
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
    if (!$stuff_post || $stuff_post->post_type !== 'stuff') {
        return 'Запись не найдена или не является типом "stuff"';
    }

    // Возвращаем контент записи
    return $stuff_post->post_content;
}
add_shortcode('stuff', 'stuff_shortcode');