<?php

define('PKG_NAME', 'ms2Collection');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));

define('PKG_PATH', MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/');
define('PKG_MODEL_PATH', PKG_PATH . 'model/');
define('PKG_ELEMENTS_PATH', PKG_PATH . 'elements/');

define('PKG_BUILD_PATH', __DIR__ . '/');
define('PKG_BUILD_TRANSPORT_PATH', PKG_BUILD_PATH . 'transport/');
define('PKG_BUILD_TRANSPORT_DATA_PATH', PKG_BUILD_TRANSPORT_PATH . 'data/');
define('PKG_BUILD_TRANSPORT_RESOLVERS_PATH', PKG_BUILD_TRANSPORT_PATH . 'resolvers/');
