<?php

class ms2CollectionMgrTrashHandler extends abstractMgrHandler
{
    /**
     * @param $parentId
     */
    public function deleteCollection($parentId)
    {
        if (!$parent = $this->getParent($parentId)) {
            return;
        }
        $collection = $parent->getMany('ms2Collection');
        foreach ($collection as $item) {
            $this->modx->runProcessor('resource/delete', ['id' => $item->id]);
        }
    }

    /**
     * @param $parentId
     */
    public function unDeleteCollection($parentId)
    {
        if (!$parent = $this->getParent($parentId)) {
            return;
        }
        $collection = $parent->getMany('ms2Collection');
        foreach ($collection as $item) {
            $this->modx->runProcessor('resource/undelete', ['id' => $item->id]);
        }
    }

    /**
     * @param $parentId
     * @return object|null
     */
    private function getParent($parentId)
    {
        return $this->modx->getObject('msProduct', [
            'id' => $parentId,
            'class_key' => 'msProduct',
        ]);
    }
}
