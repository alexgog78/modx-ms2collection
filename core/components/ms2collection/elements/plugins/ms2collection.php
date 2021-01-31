<?php

/**
 * @var modX $modx
 * @var array $scriptProperties
 */

/** @var ms2Collection $ms2Collection */
$ms2Collection = $modx->getService('ms2collection', 'ms2Collection', MODX_CORE_PATH . 'components/ms2collection/model/');
if (!($ms2Collection instanceof ms2Collection)) {
    exit('Could not get ms2Collection');
}
$modxEvent = $modx->event->name;
$ms2Collection->handleEvent($modxEvent, $scriptProperties);
return;
