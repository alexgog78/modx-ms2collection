<?php

/**
 * @var modX $modx
 * @var modPackageBuilder $builder
 */


/** Moving modElemets to modCategory */
$source = PKG_BUILD_TRANSPORT_RESOLVERS_PATH . 'category.php';
$vehicle = $builder->createVehicle([
    'source' => $source,
], [
    'vehicle_class' => 'xPDOScriptVehicle',
]);
$builder->putVehicle($vehicle);
$modx->log(modX::LOG_LEVEL_INFO, 'Added resolver: ' . $source);


/** miniShop2 plugins */
$source = PKG_BUILD_TRANSPORT_RESOLVERS_PATH . 'ms2plugins.php';
$vehicle = $builder->createVehicle([
    'source' => $source,
], [
    'vehicle_class' => 'xPDOScriptVehicle',
]);
$builder->putVehicle($vehicle);
$modx->log(modX::LOG_LEVEL_INFO, 'Added resolver: ' . $source);


/** Alter msProductData table */
$source = PKG_BUILD_TRANSPORT_RESOLVERS_PATH . 'ms2productdata.php';
$vehicle = $builder->createVehicle([
    'source' => $source,
], [
    'vehicle_class' => 'xPDOScriptVehicle',
]);
$builder->putVehicle($vehicle);
$modx->log(modX::LOG_LEVEL_INFO, 'Added resolver: ' . $source);
