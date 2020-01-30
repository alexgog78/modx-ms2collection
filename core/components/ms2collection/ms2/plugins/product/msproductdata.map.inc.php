<?php

return [
    'fields' => [
        'collection_parent_id' => 0,
    ],
    'fieldMeta' => [
        'collection_parent_id' => [
            'dbtype' => 'int',
            'precision' => '10',
            'attributes' => 'unsigned',
            'phptype' => 'integer',
            'null' => false,
            'default' => 0,
        ],
    ],
    'indexes' => [
        'collection_parent_id' => [
            'alias' => 'collection_parent_id',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => [
                'collection_parent_id' => [
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ],
            ],
        ],
    ],
    'composites' => [
        'ms2Collection' => [
            'class' => 'msProductData',
            'local' => 'id',
            'foreign' => 'collection_parent_id',
            'cardinality' => 'many',
            'owner' => 'local',
        ],
    ],
    'aggregates' => [
        'ms2CollectionParent' => [
            'class' => 'msProduct',
            'local' => 'collection_parent_id',
            'foreign' => 'id',
            'cardinality' => 'one',
            'owner' => 'foreign',
        ],
    ],
];
