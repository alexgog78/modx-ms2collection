<?php

require_once dirname(__FILE__) . '/config.inc.php';

$plugins = [
    [
        'ms2CollectionProduct',
        '{core_path}components/' . PKG_NAME_LOWER . '/ms2/plugins/product/index.php',
    ],
];

$services = [

];

class registerServices
{
    /** @var modX */
    protected $modx;

    /** @var array */
    private $plugins = [];

    /** @var array */
    private $services = [];

    /** @var miniShop2|null */
    private $ms2;

    /**
     * registerServices constructor.
     * @param modX $modx
     */
    public function __construct(modX &$modx, $plugins = [], $services = [])
    {
        $this->modx = &$modx;
        $this->plugins = $plugins;
        $this->services = $services;
        if (!$this->ms2 = $this->modx->getService('miniShop2')) {
            die('Could not initialize miniShop2');
        }
    }

    public function process()
    {
        $this->addPlugins();
        $this->addServices();
    }

    private function addPlugins()
    {
        foreach ($this->plugins as $plugin) {
            $this->ms2->addPlugin($plugin[0], $plugin[1]);
            $this->modx->log(modX::LOG_LEVEL_INFO, 'addPlugin: ' . $plugin[0] . ' ' . $plugin[1]);
        }
    }

    private function addServices()
    {
        foreach ($this->services as $service) {
            $this->ms2->addService($service[0], $service[1], $service[2]);
            $this->modx->log(modX::LOG_LEVEL_INFO, 'addService: ' . $service[0] . ' ' . $service[1] . ' ' . $service[2]);
        }
    }
}

echo '<pre>';
$registerServices = new registerServices($modx, $plugins, $services);
$registerServices->process();
echo '</pre>';

exit();
