<?php

define('PKG_NAME', 'ms2Collection');
define('PKG_NAME_LOWER', 'ms2collection');

if (!class_exists('amConnector')) {
    require_once '../abstractmodule/connector.class.php';
}

(new class(PKG_NAME_LOWER, PKG_NAME) extends amConnector
{
})->process();
