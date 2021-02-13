<?php

/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var string $snippet
 */

if (!empty($scriptProperties['where']) && !is_array($scriptProperties['where'])) {
    $scriptProperties['where'] = $modx->fromJSON($scriptProperties['where']);
}

$scriptProperties = array_merge_recursive($scriptProperties, [
    'where' => [
        'Data.ms2collection_parent_id' => 0,
    ],
]);
unset($scriptProperties['snippet']);
return $modx->runSnippet($snippet, $scriptProperties);
