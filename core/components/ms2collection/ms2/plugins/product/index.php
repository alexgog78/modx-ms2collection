<?php

return [
    'xpdo_meta_map' => [
        'msProductData' => require_once dirname(__FILE__) . '/msproductdata.map.inc.php',
    ],
    'manager' => [
        'msProductData' => MODX_ASSETS_URL . 'components/ms2collection/ms2/plugins/product/msproductdata.js',
    ],
];
