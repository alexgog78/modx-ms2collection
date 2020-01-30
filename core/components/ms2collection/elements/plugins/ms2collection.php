<?php

/** @var modX $modx */

/** @var ms2Collection $ms2Collection */
$ms2Collection = $modx->getService('ms2collection', 'ms2Collection', $modx->getOption('core_path') . 'components/ms2collection/model/ms2collection/', [
    'ctx' => $modx->context->key,
]);
if (!($ms2Collection instanceof ms2Collection)) {
    exit('Could not get ms2Collection');
}

$modxEvent = $modx->event->name;
switch ($modxEvent) {
    case 'msOnManagerCustomCssJs':
        /** @var modManagerController $controller */
        /** @var $page */
        if (in_array($page, [
            'product_create',
            'product_update',
        ])) {
            $ms2Collection->mgrProductLayout->addLexicon($controller);
            $ms2Collection->mgrProductLayout->loadAssets($controller);
        }
        break;
    case 'OnDocFormRender':
        /** @var $mode */
        /** @var $resource */
        /** @var $id */
        if ($mode === 'new') {
            $ms2Collection->mgrProductNew->renderResourceForm();
        }
        break;
    case 'OnResourceDelete':
        /** @var $id */
        /** @var $children */
        /** @var $resource */
        $ms2Collection->mgrTrash->deleteCollection($id);
        break;
    case 'OnResourceUndelete':
        /** @var $id */
        /** @var $resource */
        $ms2Collection->mgrTrash->unDeleteCollection($id);
        break;
}
return;



