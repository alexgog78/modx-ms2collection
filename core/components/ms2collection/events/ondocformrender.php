<?php

class ms2CollectionEventOnDocFormRender extends abstractModuleEvent
{
    /** @var modResource */
    private $resource;

    /** @var string */
    private $mode;

    /** @var modManagerController */
    private $controller;

    /** @var int */
    private $collectionParentId;

    /**
     * ms2CollectionEventOnDocFormRender constructor.
     *
     * @param ms2Collection $service
     * @param string $eventName
     * @param array $scriptProperties
     */
    public function __construct(ms2Collection $service, string $eventName, $scriptProperties = [])
    {
        parent::__construct($service, $eventName, $scriptProperties);
        $this->resource = $scriptProperties['resource'];
        $this->mode = $scriptProperties['mode'];
        $this->controller = $this->modx->controller;
        $this->collectionParentId = $this->controller->scriptProperties['ms2collection_parent_id'] ?? 0;
    }

    /**
     * @return bool
     */
    protected function checkPermissions()
    {
        if ($this->mode != modSystemEvent::MODE_NEW || $this->resource->get('class_key') != 'msProduct' || !$this->collectionParentId) {
            return false;
        }
        return parent::checkPermissions();
    }

    protected function handleEvent()
    {
        $this->resource->set('ms2collection_parent_id', $this->collectionParentId);
        $this->controller->resourceArray['ms2collection_parent_id'] = $this->collectionParentId;

        /** @var msProduct $parent */
        $parent = $this->modx->getObject('msProduct', [
            'id' => $this->collectionParentId,
            'class_key' => 'msProduct',
        ]);
        if (!$parent) {
            return;
        }
        $this->setModResourceData($parent);
        $this->setMsProductData($parent);
    }

    /**
     * @param msProduct $parent
     */
    private function setModResourceData(msProduct $parent)
    {
        $keys = [
            'pagetitle',
            'longtitle',
            'description',
            'introtext',
            'content',
            'link_attributes',
            'alias',
            'menutitle',
        ];
        foreach ($keys as $key) {
            $this->controller->resourceArray[$key] = $parent->get($key);
        }
    }

    /**
     * @param msProduct $parent
     */
    private function setMsProductData(msProduct $parent)
    {
        if (!$parentData = $parent->getOne('Data')) {
            return;
        }
        $parentData = $parentData->toArray();
        unset($parentData['id'], $parentData['image'], $parentData['thumb'], $parentData['ms2collection_parent_id']);
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
