<div class="widget">
    <h2 class="widget-title">Custom Taxonomy</h2>
    <ul>
        <?php
        $terms = get_terms( array(
            'taxonomy' => 'custom_section',
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                echo '<li><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>';
            }
        }
        ?>
    </ul>
</div>