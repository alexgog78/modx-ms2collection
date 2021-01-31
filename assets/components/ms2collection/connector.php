<?php

define('PKG_NAME', 'ms2Collection');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));

/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(__DIR__))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/**
 * @var modX $modx
 * @noinspection PhpIncludeInspection
 */
require_once MODX_CONNECTORS_PATH . 'index.php';

/** @var ms2Collection $service */
$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/model/');
$modx->lexicon->load(PKG_NAME_LOWER . ':default');

/** @var modConnectorRequest $request */
$request = $modx->request;
$processorsPath = $modx->getOption('processorsPath', $service->getConfig(), MODX_CORE_PATH . 'processors/');
$request->handleRequest([
    'processors_path' => $processorsPath,
    'location' => '',
]);
