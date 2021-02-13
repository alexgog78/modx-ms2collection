<?php

class ms2CollectionEventOnBeforeDocFormSave extends abstractModuleEvent
{
    /** @var string */
    private $mode;

    /** @var modResource */
    private $resource;

    /** @var int */
    private $id;

    /**
     * ms2CollectionEventOnDocFormSave constructor.
     *
     * @param abstractModule $service
     * @param string $eventName
     * @param array $scriptProperties
     */
    public function __construct(abstractModule $service, string $eventName, $scriptProperties = [])
    {
        parent::__construct($service, $eventName, $scriptProperties);
        $this->mode = $scriptProperties['mode'];
        $this->resource = $scriptProperties['resource'];
        $this->id = $scriptProperties['id'];

    }

    /**
     * @return bool
     */
    protected function checkPermissions()
    {
        if ($this->mode != modSystemEvent::MODE_NEW || !$this->resource->get('ms2collection_parent_id')) {
            return false;
        }
        return parent::checkPermissions();
    }

    protected function handleEvent()
    {
        $showInTree = (bool)$this->modx->getOption('ms2collection_product_show_in_tree');
        if (!$showInTree) {
            $this->resource->set('show_in_tree', 0);
        }
    }
}
