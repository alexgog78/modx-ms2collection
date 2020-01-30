<?php

if (!class_exists('abstractModule')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/model/abstractmodule/abstractmodule.class.php';
}

class ms2Collection extends abstractModule
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

    /**
     * @param array $config
     * @return array
     */
    protected function getConfig($config = [])
    {
        $config = parent::getConfig($config);
        $config['ms2JsUrl'] = $config['assetsUrl'] . 'ms2/js/';
        return $config;
    }
}
