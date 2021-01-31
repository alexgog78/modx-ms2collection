<?php

class ms2CollectionEventmsOnManagerCustomCssJs extends abstractModuleEvent
{
    /** @var string */
    private $page;

    /** @var modManagerController */
    private $controller;

    public function __construct(abstractModule $service, $scriptProperties = [])
    {
        parent::__construct($service, $scriptProperties);
        $this->page = $scriptProperties['page'];
        $this->controller = $scriptProperties['controller'];
    }

    public function run()
    {
        if (!in_array($this->page, [
            'product_create',
            'product_update',
        ])) {
            return;
        }

        $this->controller->addLexiconTopic($this->service::PKG_NAMESPACE . ':default');

        $this->service->loadMgrAbstractCssJs($this->controller);
        $this->service->loadMgrDefaultCssJs($this->controller);

        $this->controller->addLastJavascript($this->service->jsUrl . 'mgr/ms2/panel.product.js');
    }
}
