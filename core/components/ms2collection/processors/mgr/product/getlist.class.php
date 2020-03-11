<?php

if (!$this->loadClass('getlist', MODX_CORE_PATH . 'components/minishop2/processors/mgr/product/', true, true)) {
    return false;
}

class ms2collectionProductGetListProcessor extends msProductGetListProcessor
{
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);
        $collectionParentId = $this->getProperty('ms2collection_parent_id');
        if (isset($collectionParentId)) {
            $c->where([
                'AND:Data.ms2collection_parent_id:=' => $collectionParentId,
            ]);
        }
        return $c;
    }
}

return 'ms2collectionProductGetListProcessor';
