<?php
// Создание класса виджета для отображения списка разделов таксономии
class Custom_Taxonomy_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'custom_taxonomy_widget',
            'Список разделов таксономии сотрудников',
            array('description' => 'Отображает список разделов созданной таксономии')
        );
    }
    
    public function widget($args, $instance) {
        $taxonomy = 'custom_section';
        $terms = get_terms($taxonomy);
        
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<h3 class="company__stuff-title">'. $term->name . '</h3>';
            }
        }
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

// Регистрация класса виджета
function register_custom_taxonomy_widget() {
    register_widget('Custom_Taxonomy_Widget');
}
add_action('widgets_init', 'register_custom_taxonomy_widget');

// Функция для генерации вывода виджета "Список разделов таксономии"
function custom_taxonomy_widget_shortcode($atts) {
    ob_start(); // Запускаем буферизацию вывода
    the_widget('Custom_Taxonomy_Widget', $atts, array()); // Выводим виджет
    $output = ob_get_clean(); // Получаем содержимое буфера и очищаем его
    return $output; 
}
add_shortcode('custom_taxonomy_widget', 'custom_taxonomy_widget_shortcode');