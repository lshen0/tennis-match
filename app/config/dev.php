<?php

define('SPF_BASE_ROOT', 'URL.com'); // TODO

define('SPF_DISPLAY_ERRORS', TRUE);
define('SPF_ERROR_EMAIL', 'yourEmail@email.com');

// TODO: SMTP info?

// session idle timeout in seconds (?)
define('SPF_SESSION_TIMEOUT', '1 HOUR');

define('SPF_COOKIE_DOMAIN', 'URL.com'); // TODO
define('SPF_COOKIE_PATH', '/'); // TODO

// db server connection
self::$dsn['default'] = array(
'host' => 'localhost',
'name' => 'tennis',
'user' => 'root',
'pass' => 'password' // TODO: ????
);

define('SPF_TABLE_PREFIX', 'tennis_'); // what does this do

// TODO: custom config options?
define('SPF_FROM_EMAIL', 'yourEmail@email.com');
define('SPF_NOTIFICATION_EMAIL', 'yourEmail@email.com');

define('SPF_DATE_FORMAT', 'n/j/y');
define('SPF_TIME_FORMAT', 'g:i a');
define('SPF_DATETIME_FORMAT', 'n/j/y g:i a');