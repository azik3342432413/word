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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         ':.$0-cbCo^njl.(I+<^-oQI_cBv7=sT`ll)Z3K9=[=2.yb/Wk)uLGDsbov`*mY&*' );
define( 'SECURE_AUTH_KEY',  '@j]9L$Af}qRPVd$*RNY)Ewoq3f7ja4Z+GjQ1c4cXnF7J]|#<|,$,[M]S,zCbZ03;' );
define( 'LOGGED_IN_KEY',    'DSLD)~}f.or&fcvj$%hjwR$;VFtd2@,PldQ)b)da0.K/@#D#%sN)$[>2feQqdK[3' );
define( 'NONCE_KEY',        '^qSD/H!mE>6 /GaI8_hT^Yi~e4[QpQ)7i?31%Io,#>L>DDu5WwK4d3Z&v0K!G5:X' );
define( 'AUTH_SALT',        '=$`0-KV^8^n?gSE]A{Eo^^0)LTYSG-)+aXFMN:?>q.BUTXG8rK(Sc|<oZzO)%SG_' );
define( 'SECURE_AUTH_SALT', 'IxFH6J*fcv7>:nN9q;,i}_~.M6a})G:/xY3m2no/z/UJv_ykT^Tmle*V)_iAGdqq' );
define( 'LOGGED_IN_SALT',   'S(K9fK.^y0sK|zw|R]lCAnD~3,Wi#i`j#g73icIvvEsD&fdc@OeCHXS_ap]DHT;Y' );
define( 'NONCE_SALT',       'lgAA$m{i9$EbqO;@:-F>eA-LHFtW3kM&Pg*-Fo`S]3XrDqrEr56jBf[TmFP[ChWs' );

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
