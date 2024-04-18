<?php
// Регистрация виджета
function custom_taxonomy_posts_widget_init() {
    register_widget( 'Custom_Taxonomy_Posts_Widget' );
}
add_action( 'widgets_init', 'custom_taxonomy_posts_widget_init' );

// Создание класса виджета
class Custom_Taxonomy_Posts_Widget extends WP_Widget {
    
    function __construct() {
        parent::__construct(
            'custom_taxonomy_posts_widget', // Base ID
            esc_html__( 'Custom Taxonomy Posts Widget', 'text_domain' ), // Name
            array( 'description' => esc_html__( 'Display posts from a custom taxonomy', 'text_domain' ), ) // Args
        );
    }

    // Вывод виджета
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        $taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'category';
        $term = get_queried_object();
        $term_id = $term->term_id;
        $posts = get_posts( array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'id',
                    'terms'    => $term_id,
                ),
            ),
        ) );
        
        if ( ! empty( $posts ) ) {
            echo '<h2>' . $term->name . '</h2>';
            echo '<ul>';
            foreach ( $posts as $post ) {
                echo '<li><a href="' . get_permalink( $post ) . '">' . get_the_title( $post ) . '</a></li>';
            }
            echo '</ul>';
        }
        
        echo $args['after_widget'];
    }

    // Форма настройки виджета в админке
    public function form( $instance ) {
        $taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'category';
        ?>
<p>
    <label
        for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_attr_e( 'Taxonomy:', 'text_domain' ); ?></label>
    <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>">
        <?php
                $taxonomies = get_taxonomies();
                foreach ( $taxonomies as $tax ) {
                    echo '<option value="' . esc_attr( $tax ) . '" ' . selected( $taxonomy, $tax, false ) . '>' . esc_html( $tax ) . '</option>';
                }
                ?>
    </select>
</p>
<?php
    }

    // Обновление настроек виджета
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['taxonomy'] = ( ! empty( $new_instance['taxonomy'] ) ) ? sanitize_text_field( $new_instance['taxonomy'] ) : '';

        return $instance;
    }
}

// Регистрация шорткодаа
function custom_taxonomy_posts_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'taxonomy_id' => 0, // По умолчанию ID таксономии - 0
    ), $atts );

    // Получаем объект таксономии по ее ID
    $term = get_term( $atts['taxonomy_id'] );

    // Для отладки - выводим значения переменных
    // var_dump($atts['taxonomy_id']);
    // var_dump($term);

    if ( $term && ! is_wp_error( $term ) ) {
        $taxonomy = $term->taxonomy; // Получаем имя таксономии
        $term_id = $term->term_id;
        $posts = get_posts( array(
            'post_type' => 'staff',
            'tax_query' => array(
                array(
                    'taxonomy' => 'custom_section',
                    'field'    => 'name',
                    'terms'    => $term->name,
                ),
            ),
        ) );
        $output = '';
        if ( ! empty( $posts ) ) {
            $output .= '<div class="company__stuff-taxonomy">';
            $output .= '<h3 class="company__stuff-title">' . $term->name . '</h3>';
            $output .= '<div class="company__stuff-cards">';
            foreach ( $posts as $post ) {
                setup_postdata( $post ); // Устанавливаем контекст поста
                $output .= '<div class="company__stuff-card">';
                $first_image = get_first_image(get_the_content());
                if ($first_image) {
                    $output .= '<img src="' . esc_url($first_image) . '" alt="' . get_the_title($post) . '" title="' . get_the_title($post) . '" />';
                }
                $output .= '<p>' . get_the_title( $post ) . '</p>';
                $output .= '</div>';
            }
            wp_reset_postdata(); // Сбрасываем контекст поста
            $output .= '</div>';
            $output .= '</div>';
        }

        echo $output; // Выводим содержимое
    } else {
        echo 'Таксономия не найдена'; // Выводим сообщение об ошибке
    }
}
add_shortcode( 'custom_taxonomy_posts', 'custom_taxonomy_posts_shortcode' );