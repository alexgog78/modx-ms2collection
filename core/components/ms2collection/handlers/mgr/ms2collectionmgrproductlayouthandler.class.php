<?php

class ms2CollectionMgrProductLayoutHandler extends abstractMgrHandler
{
    /** @var miniShop2 */
    private $miniShop2;

    /** @var array */
    private $productFields = [];

    /** @var array */
    private $gridFields = [];

    /**
     * ms2CollectionMgrMsProductHandler constructor.
     * @param $module
     * @param array $config
     */
    public function __construct(& $module, array $config = [])
    {
        parent::__construct($module, $config);
        $this->miniShop2 = $this->modx->getService('miniShop2');
    }

    /**
     * @param modManagerController $controller
     */
    public function loadAssets(modManagerController $controller)
    {
        $this->loadMs2Assets($controller);
        $this->config = array_merge($this->config, [
            'recordId' => $controller->resource->id ?? null,
            'recordCollectionParentId' => $controller->scriptProperties['collection_parent_id'] ?? $controller->resource->get('collection_parent_id'),
            'recordParentId' => $controller->resource->parent,
        ]);
        parent::loadAssets($controller);
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/utils/notice.indevelopment.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/utils/notice.undefined.js');
        $controller->addJavascript($this->miniShop2->config['jsUrl'] . 'mgr/misc/default.grid.js');
        $controller->addJavascript($this->miniShop2->config['jsUrl'] . 'mgr/category/product.grid.js');
        $controller->addJavascript($this->config['jsUrl'] . 'mgr/widgets/product/grid.js');
        $controller->addLastJavascript($this->config['ms2JsUrl'] . 'mgr/extend/product.panel.js');
    }

    /**
     * @param modManagerController $controller
     */
    private function loadMs2Assets(modManagerController $controller)
    {
        $this->getProductFields();
        $this->getGridFields();
        $ms2Config = [
            'product_fields' => $this->modx->toJSON($this->productFields),
            'grid_fields' => $this->modx->toJSON($this->gridFields),
        ];
        $controller->addHtml('<script type="text/javascript">
            miniShop2.config.product_fields = ' . $ms2Config['product_fields'] . ';
            miniShop2.config.grid_fields = ' . $ms2Config['grid_fields'] . ';
        </script>');
    }

    private function getProductFields()
    {
        $category_option_keys = [];
        $category = $this->modx->newObject('msCategory');
        $showOptions = (bool)$this->modx->getOption('ms2_category_show_options', null, true);
        if ($showOptions) {
            $category_option_keys = $category->getOptionKeys();
        }

        $product = $this->modx->newObject('msProduct');
        $this->productFields = array_merge($product->getAllFieldsNames(), $category_option_keys, [
            'actions',
            'preview_url',
            'cls',
            'vendor_name',
            'category_name',
        ]);
    }

    private function getGridFields()
    {
        $categoryGridFields = $this->modx->getOption('ms2_category_grid_fields');
        if (empty($categoryGridFields)) {
            $categoryGridFields = 'id,pagetitle,article,price,weight,image';
        }
        $categoryGridFields = array_map('trim', explode(',', $categoryGridFields));
        $this->gridFields = array_values(array_intersect($categoryGridFields, $this->productFields));
        if (!in_array('actions', $this->gridFields)) {
            $this->gridFields[] = 'actions';
        }
    }
}
