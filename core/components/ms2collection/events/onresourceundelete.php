<?php

class ms2CollectionEventOnResourceUndelete extends abstractModuleEvent
{
    /** @var modResource string */
    private $resource;

    /**
     * ms2CollectionEventOnResourceUndelete constructor.
     *
     * @param abstractModule $service
     * @param array $scriptProperties
     */
    public function __construct(abstractModule $service, $scriptProperties = [])
    {
        parent::__construct($service, $scriptProperties);
        $this->resource = $scriptProperties['resource'];
    }

    public function run()
    {
        if ($this->resource->get('class_key') != 'msProduct') {
            return;
        }
        $collection = $this->resource->getMany('ms2Collection');
        foreach ($collection as $item) {
            $this->modx->runProcessor('resource/undelete', ['id' => $item->get('id')]);
        }
    }
}
