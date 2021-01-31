<?php

/**
 * @var xPDOTransport $transport
 * @var array $options
 * @var modX $modx
 */

if ($transport->xpdo) {
    $modx = &$transport->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var miniShop2 $miniShop2 */
            $miniShop2 = $modx->getService('miniShop2');
            /** @var xPDOManager $manager */
            $manager = $modx->getManager();

            $tableClass = 'msProductData';
            $msProductData = include MODX_CORE_PATH . 'components/ms2collection/ms2/plugins/product/msproductdata.map.inc.php';
            foreach ($msProductData as $key => $data) {
                $modx->map[$tableClass][$key] = array_merge($modx->map[$tableClass][$key], $data);
            }
            foreach (array_keys($msProductData['fields']) as $field) {
                $manager->addField($tableClass, $field);
            }
            foreach (array_keys($msProductData['indexes']) as $index) {
                $manager->addIndex($tableClass, $index);
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return true;
