<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'beauty_vision' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~i;]jmnPEYen{:(qql8F0[3x#VB~7&&u9>__?GosD|jin,mJsT.!5s^Et.x|.PBU' );
define( 'SECURE_AUTH_KEY',  'XCU*$*Yn6q}[^!OQ~ QQBj&%ReKsH5i2`#A+eFVDBXnn[$J4 =44CkUnyCXhS)Df' );
define( 'LOGGED_IN_KEY',    'kacvVlj|>=z3G~%r|Q9ZD%W A]-iPXx*,{])+tP=Yh115WS&#0fh<zlt}9KM%VO?' );
define( 'NONCE_KEY',        'FS/EXIU#2[|*a6AQHIa^!#.Tc]d:FSmyEV[^ B/8.;!/IV:Qi] m|6q.r/Y@~rb<' );
define( 'AUTH_SALT',        '!I5Q6S-B!M%C)Wg%>5#(;OBCePd1xvoqg,xrk;[AH{3Ii^G-VjW8D/xR#t9#F)M]' );
define( 'SECURE_AUTH_SALT', 'W0=im=.Z{`UZSOyi)|cPJ%L~ZfGZzz$KF8Yx_*MV`3TMb&x`S^,;W`ZJC#7&9aNd' );
define( 'LOGGED_IN_SALT',   '}>tmyAs<2C:_i3zDwfOtja|]!V9a=1|T-?]iYtTBY)?*z*vu;SAyrZCI@<0$-4`o' );
define( 'NONCE_SALT',       '9iCDd>jbCwux1#EQeDM9*usn1[{kN0HlV-LFqe;M7&b3~J^Yf=$)l6b|(b3 IE?M' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
