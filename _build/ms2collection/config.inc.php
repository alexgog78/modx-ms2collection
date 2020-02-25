<?php

define('PKG_NAME', 'ms2Collection');
define('PKG_NAME_LOWER', 'ms2collection');
define('PKG_VERSION', '1.0');
define('PKG_RELEASE', 'rc1');
define('MS2_PLUGINS', [
    [
        'name' => 'ms2CollectionProduct',
        'path' => '{core_path}components/' . PKG_NAME_LOWER . '/ms2/plugins/product/index.php',
    ],
]);
