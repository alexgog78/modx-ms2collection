<?php

/** @var xPDOTransport $transport */

/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx = &$transport->xpdo;

    $tableClass = 'msProductData';
    $msProductData = include MODX_CORE_PATH . 'components/ms2collection/ms2/plugins/product/msproductdata.map.inc.php';

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $miniShop2 = $modx->getService('miniShop2');
            $manager = $modx->getManager();

            foreach (array_keys($msProductData['fields']) as $field) {
                $manager->addField($tableClass, $field, $msProductData['fieldMeta'][$field]);
            }
            foreach ($msProductData['indexes'] as $indexKey => $indexData) {
                $manager->addIndex($tableClass, $indexKey, $indexData);
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return true;
