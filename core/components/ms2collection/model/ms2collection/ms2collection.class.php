<?php

if (!class_exists('AbstractModule')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/abstractmodule.class.php';
}

class ms2Collection extends AbstractModule
{
    /** @var array */
    protected $handlers = [
        'default' => [],
        'mgr' => [
            'ProductLayout',
            'Trash',
            'ProductNew',
        ],
        'web' => [],
    ];
}
