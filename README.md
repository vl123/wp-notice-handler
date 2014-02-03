WP Notice Handler
=================

Simple notice handler for Wordpress.
You can use it by including file in your plugin or theme and calling "add" method to add notice.
```php
require_once 'wp-notice-handler.php';
WP_Notice_Handler::i()->add('Hello World!', WP_Notice_Handler::NOTICE);
```