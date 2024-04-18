<?php
// Создание класса виджета для отображения списка записей типа "advantages"
class Custom_Advantages_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'custom_advantages_widget',
            'Список преимуществ',
            array('description' => 'Отображает список записей типа "Advantages"')
        );
    }
    
    public function widget($args, $instance) {
        $query_args = array(
            'post_type' => 'advantages',
            'posts_per_page' => isset($instance['posts_per_page']) ? absint($instance['posts_per_page']) : 5,
        );
        
        $stuff_query = new WP_Query($query_args);
        
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        if ($stuff_query->have_posts()) {
            echo '<ul>';
            while ($stuff_query->have_posts()) {
                $stuff_query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo 'Нет записей для отображения';
        }
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('posts_per_page'); ?>">Количество записей для отображения:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>"
        name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" min="1" step="1"
        value="<?php echo esc_attr($posts_per_page); ?>">
</p>
<?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['posts_per_page'] = (!empty($new_instance['posts_per_page'])) ? absint($new_instance['posts_per_page']) : 5;
        return $instance;
    }
}

// Регистрация класса виджета для отображения списка записей типа "stuff"
function register_custom_advantages_widget() {
    register_widget('Custom_Advantages_Widget');
}
add_action('widgets_init', 'register_custom_advantages_widget');

// Функция для вывода списка записей типа "stuff" через шорткод
function custom_advantages_shortcode($atts) {
    $atts = shortcode_atts(array('posts_per_page' => 6), $atts);
    $query_args = array(
        'post_type' => 'advantages',
        'posts_per_page' => absint($atts['posts_per_page']),
    );
    
    $stuff_query = new WP_Query($query_args);
    
    ob_start();
    if ($stuff_query->have_posts()) {
        while ($stuff_query->have_posts()) {
            $stuff_query->the_post();
            $content = get_the_content();
            // Извлекаем первое изображение из контента
            $first_image = get_first_image_from_content($content);
            echo '<div class="home__advantages-card">';
            // Если изображение найдено, выводим его
            echo '<h3>' . get_the_title() . '</h3>';

            if ($first_image) {
                echo '<img src="' . esc_url($first_image) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
            }
            echo '</div>';
        }
        wp_reset_postdata();
    } else {
        echo 'Нет записей для отображения';
    }
    return ob_get_clean();
}

// Функция для извлечения первого изображения из контента
function get_first_image_from_content($content) {
    $first_image = '';
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    if (!empty($matches[1])) {
        $first_image = $matches[1][0];
    }
    return $first_image;
}

add_shortcode('custom_advantages', 'custom_advantages_shortcode');