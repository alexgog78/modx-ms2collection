<?php

class ms2CollectionEventmsOnManagerCustomCssJs extends abstractModuleEvent
{
    /** @var string */
    private $page;

    /** @var modManagerController */
    private $controller;

    /** @var miniShop2 */
    private $miniShop2;

    /**
     * ms2CollectionEventmsOnManagerCustomCssJs constructor.
     *
     * @param ms2Collection $service
     * @param string $eventName
     * @param array $scriptProperties
     */
    public function __construct(ms2Collection $service, string $eventName, $scriptProperties = [])
    {
        parent::__construct($service, $eventName, $scriptProperties);
        $this->page = $scriptProperties['page'];
        $this->controller = $scriptProperties['controller'];
        $this->miniShop2 = $this->modx->getService('miniShop2');
    }

    public function run()
    {
        if (!in_array($this->page, [
                'product_create',
                'product_update',
            ]) || $this->controller->resource->get('ms2collection_parent_id')) {
            return;
        }

        $this->controller->addLexiconTopic($this->service::PKG_NAMESPACE . ':default');

        $this->service->loadMgrAbstractCssJs($this->controller);
        $this->service->loadMgrDefaultCssJs($this->controller);
        $this->loadMs2Assets();
        $this->controller->addJavascript($this->service->jsUrl . 'mgr/widgets/product/grid.js');

        $configJs = $this->modx->toJSON([
            'record_id' => $this->controller->resource->get('id') ?? 0,
            'parent_id' => $this->controller->resource->get('parent'),
        ]);
        $this->controller->addHtml('<script type="text/javascript">Ext.applyIf(' . get_class($this->service) . '.config, ' . $configJs . ');</script>');
        $this->controller->addLastJavascript($this->service->jsUrl . 'mgr/ms2/panel.product.js');
    }

    private function loadMs2Assets()
    {
        $this->controller->addJavascript($this->miniShop2->config['jsUrl'] . 'mgr/misc/default.grid.js');
        $this->controller->addJavascript($this->miniShop2->config['jsUrl'] . 'mgr/category/product.grid.js');

        $productFields = $this->getProductFields();
        $categoryGridFields = $this->getGridFields($productFields);
        $ms2Config = [
            'product_fields' => $this->modx->toJSON($productFields),
            'grid_fields' => $this->modx->toJSON($categoryGridFields),
        ];
        $this->controller->addHtml('<script type="text/javascript">
            miniShop2.config.product_fields = ' . $ms2Config['product_fields'] . ';
            miniShop2.config.grid_fields = ' . $ms2Config['grid_fields'] . ';
        </script>');
    }

    /**
     * @return array
     */
    private function getProductFields()
    {
        $category = $this->modx->newObject('msCategory');
        $showOptions = (bool)$this->modx->getOption('ms2_category_show_options', [], true);
        $categoryOptionKeys = $showOptions ? $category->getOptionKeys() : [];

        $product = $this->modx->newObject('msProduct');
        return array_merge($product->getAllFieldsNames(), $categoryOptionKeys, [
            'actions',
            'preview_url',
            'cls',
            'vendor_name',
            'category_name',
        ]);
    }

    /**
     * @param array $productFields
     * @return array
     */
    private function getGridFields($productFields = [])
    {
        $categoryGridFields = $this->modx->getOption('ms2_category_grid_fields', [], 'id,pagetitle,article,price,weight,image', true);
        $categoryGridFields = explode(',', $categoryGridFields);
        $categoryGridFields = array_map('trim', $categoryGridFields);
        $categoryGridFields = array_values(array_intersect($categoryGridFields, $productFields));
        if (!in_array('actions', $categoryGridFields)) {
            $categoryGridFields[] = 'actions';
        }
        return $categoryGridFields;
    }
}
