<?php

$prefix = 'ms2collection.';

$_lang['ms2collection'] = 'ms2Collection';
$_lang[$prefix . 'management'] = 'Коллекция товаров';

$files = scandir(dirname(__FILE__));
foreach ($files as $file) {
    if (strpos($file, '.inc.php')) {
        @include_once $file;
    }
}
