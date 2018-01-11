<?php


/** Заборонити REVISIONS */
define('AUTOSAVE_INTERVAL', 17000 ); // seconds
define('WP_POST_REVISIONS', false );

/** Заборонити оновлення */
define( 'AUTOMATIC_UPDATER_DISABLED', true );



/* // Заборонити зміни файлів у адмінці, установку плагінів 
define( 'DISALLOW_FILE_MODS', true );
 */

/* 
// Ліміт часу на виконання операцій (може бути потрібно при завантаженні тестового контенту ...)
set_time_limit(600); 

// Ліміт віртуальної памяті 
define('WP_MEMORY_LIMIT', '64M');

// Час збереження матеріалів у кошику, у днях 
define('EMPTY_TRASH_DAYS', 30 );  // Замініть число «30» на бажану кількість днів

// Дозволяємо кешування 
define('WP_CACHE', true);
 */

/* 
// Повідомлення про помилки
if (WP_DEBUG) {
  define('WP_DEBUG_LOG', true);
  define('WP_DEBUG_DISPLAY', false);
  @ini_set('display_errors',0);
}
*/

 