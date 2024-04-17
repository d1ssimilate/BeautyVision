<?php
/*
Plugin Name: Custom Table CRUD Plugin
Author: Роман Макаров
Description: Плагин для создания пользовательской таблицы в базе данных WordPress и выполнения операций с сеткой.
Version: 1.0
*/

// Создаем таблицу при активации плагина
register_activation_hook( __FILE__, 'custom_table_plugin_activate' );
function custom_table_plugin_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_table';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        short_description text,
        description longtext,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// Добавляем страницу в админку для управления записями
add_action( 'admin_menu', 'custom_table_plugin_menu' );
function custom_table_plugin_menu() {
    add_menu_page( 'Custom Table CRUD', 'Custom Table CRUD', 'manage_options', 'custom-table-crud', 'custom_table_plugin_page');
}

// Выводим страницу в админке
function custom_table_plugin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_table';

    if ( isset( $_POST['submit'] ) ) {
        $name = sanitize_text_field( $_POST['name'] );
        $short_description = sanitize_text_field( $_POST['short_description'] );
        $description = wp_kses_post( $_POST['description'] );

        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'short_description' => $short_description,
                'description' => $description,
            )
        );
        echo '<div class="updated"><p>Запись создана!</p></div>';
    }
    ?>
<div class="wrap">
    <h2>Custom Table CRUD</h2>
    <form method="post" action="">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="short_description">Краткое описание:</label>
        <input type="text" id="short_description" name="short_description"><br><br>
        <label for="description">Описание:</label><br>
        <textarea id="description" name="description" rows="4"></textarea><br><br>
        <input type="submit" name="submit" value="Создать">
    </form>

    <h2>Записи</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Краткое описание</th>
                <th>Описание</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $results = $wpdb->get_results( "SELECT * FROM $table_name" );
            foreach ( $results as $result ) {
                echo "<tr>";
                echo "<td>$result->id</td>";
                echo "<td>$result->name</td>";
                echo "<td>$result->short_description</td>";
                echo "<td>$result->description</td>";
                echo '<td><a href="#" onclick="delete_record(' . $result->id . ')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function delete_record(id) {
    if (confirm('Вы уверены что хотите удалить запись?')) {
        window.location.href = '<?php echo admin_url( 'admin.php?page=custom-table-crud&action=delete&id=' ); ?>' + id;
    }
}
</script>
<?php
}

// Удаляем запись при запросе из админки
add_action( 'admin_init', 'custom_table_delete_record' );
function custom_table_delete_record() {
    if ( isset( $_GET['action'] ) && $_GET['action'] == 'delete' && isset( $_GET['id'] ) ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_table';
        $id = intval( $_GET['id'] );

        $wpdb->delete( $table_name, array( 'id' => $id ) );
        wp_redirect( admin_url( 'admin.php?page=custom-table-crud' ) );
        exit;
    }
}