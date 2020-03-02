<?php

class ms2CollectionMgrProductNewHandler extends AbstractMgrHandler
{
    /** @var modManagerController */
    private $controller;

    /** @var int */
    private $parentId;

    /** @var msProduct */
    private $parent;

    public function renderResourceForm()
    {
        $this->controller = $this->modx->controller;
        $this->parentId = $this->controller->scriptProperties['collection_parent_id'];
        if (!$this->parentId) {
            return;
        }
        $this->getParent();
        if (!$this->parent) {
            return;
        }
        $this->setModResourceData();
        $this->setMsProductData();
    }

    private function getParent()
    {
        $this->parent = $this->modx->getObject('msProduct', [
            'id' => $this->parentId,
            'class_key' => 'msProduct',
        ]);
    }

    private function setModResourceData()
    {
        $this->controller->resourceArray['show_in_tree'] = 0;
        $keys = [
            'pagetitle',
            'longtitle',
            'introtext',
            'description',
            'content',
        ];
        foreach ($keys as $key) {
            $this->controller->resourceArray[$key] = $this->parent->get($key);
        }
    }

    private function setMsProductData()
    {
        $this->controller->resourceArray['collection_parent_id'] = $this->parentId;
        if (!$parentData = $this->parent->getOne('Data')) {
            return;
        }
        $parentData = $parentData->toArray();
        unset($parentData['id'], $parentData['image'], $parentData['thumb']);
        foreach ($parentData as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subValue) {
                    if (!empty($subValue))
                        $this->controller->resourceArray[$key][] = ['value' => $subValue];
                }
            } else {
                $this->controller->resourceArray[$key] = $value;
            }
        }
    }
}
