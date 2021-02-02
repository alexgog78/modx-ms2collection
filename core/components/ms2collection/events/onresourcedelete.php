<?php

class ms2CollectionEventOnResourceDelete extends abstractModuleEvent
{
    /** @var modResource */
    private $resource;

    /**
     * ms2CollectionEventOnResourceDelete constructor.
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
            $this->modx->runProcessor('resource/delete', ['id' => $item->get('id')]);
        }
    }
}
