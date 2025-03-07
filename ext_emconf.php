<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Faker',
    'description' => 'Generate faked data',
    'category' => 'backend',
    'author' => 'Georg Ringer',
    'author_email' => 'georg.ringer@gmail.com',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '1.1.0',
    'constraints' =>
        [
            'depends' => [
                'typo3' => '10.4.0-13.4.99'
            ],
            'conflicts' => [],
            'suggests' => [],
        ]
];
