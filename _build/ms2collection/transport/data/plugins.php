<?php

return [
    [
        'name' => 'ms2Collection',
        'static_file' => 'ms2collection.php',
        'events' => [
            'msOnManagerCustomCssJs',
            'OnDocFormRender',
            'OnBeforeDocFormSave',
            'OnResourceDelete',
            'OnResourceUndelete',
        ],
    ],
];
