<?php

class ms2CollectionEventOnResourceDelete extends abstractModuleEvent
{
    /** @var modResource */
    private $resource;

    /**
     * ms2CollectionEventOnResourceDelete constructor.
     *
     * @param ms2Collection $service
     * @param string $eventName
     * @param array $scriptProperties
     */
    public function __construct(ms2Collection $service, string $eventName, $scriptProperties = [])
    {
        parent::__construct($service, $eventName, $scriptProperties);
        $this->resource = $scriptProperties['resource'];
    }

    /**
     * @return bool
     */
    protected function checkPermissions()
    {
        if ($this->resource->get('class_key') != 'msProduct') {
            return false;
        }
        return parent::checkPermissions();
    }

    protected function handleEvent()
    {
        $collection = $this->resource->getMany('ms2Collection');
        foreach ($collection as $item) {
            $this->modx->runProcessor('resource/delete', ['id' => $item->get('id')]);
        }
    }
}
