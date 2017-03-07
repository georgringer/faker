<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Faker',
    'description' => 'Generate faked data',
    'category' => 'backend',
    'author' => 'Georg Ringer',
    'author_email' => 'georg.ringer@gmail.com',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '1.0.1',
    'constraints' =>
        [
            'depends' => [
                'typo3' => '7.6.0-8.9.99'
            ],
            'conflicts' => [],
            'suggests' => [],
        ]
];