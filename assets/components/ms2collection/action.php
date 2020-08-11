<?php

//TODO remove file


if (empty($_REQUEST['ms2collection_id'])) {
    exit(json_encode(array('success' => false, 'message' => 'Access denied')));
}

define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';
$modx->getService('error', 'error.modError');
$modx->getRequest();
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');
$modx->error->reset();

/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService('pdoFetch');

/** @var miniShop2 $miniShop2 */
$miniShop2 = $modx->getService('miniShop2');

$product = $pdoFetch->getArray('msProduct', [
    'msProduct' . '.id:=' => $_REQUEST['ms2collection_id'],
], [
    'innerJoin' => [
        'Data' => [
            'class' => 'msProductData',
        ],
    ],
    'leftJoin' => [
        '140x' => [
            'class' => 'msProductFile',
            'on' => '140x.product_id = msProduct.id AND 140x.rank = 0 AND 140x.path LIKE "%140x%"',
        ]
    ],
    'select' => [
        'msProduct' => '*',
        'Data' => $modx->getSelectColumns('msProductData', 'Data', '', ['id'], true),
        '140x' => '140x.url as 140x',
    ],
]);
if (!$product) {
    exit(false);
}
$product['url'] = $modx->makeUrl($product['id'], $product['context_key']);
$product['price'] = $miniShop2->formatPrice($product['price']);

$response = $modx->toJSON($product);
exit($response);
