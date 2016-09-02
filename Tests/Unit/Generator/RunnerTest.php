<?php

namespace GeorgRinger\Faker\Tests\Unit\Generator;

use GeorgRinger\Faker\Generator\Runner;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class RunnerTest extends UnitTestCase
{

    /**
     * @param string $table
     * @param array $expectedFields
     * @test
     * @dataProvider fakerFieldsAreReturnedDataProvider
     */
    public function fakerFieldsAreReturned($table, $expectedFields)
    {
        $GLOBALS['TCA'] = [
            'empty' => [
                'columns' => [
                    'field1' => [
                        'label' => 'title'
                    ]
                ]
            ],
            'fields' => [
                'columns' => [
                    'field-1' => [
                        'faker' => [
                            'fo' => 1,
                            'bar' => 2
                        ],
                        'config' => [
                            'type' => 'input'
                        ]
                    ],
                    'field-2' => [
                        'config' => [
                            'fo' => 3,
                        ]
                    ],
                    'field-3' => [
                        'faker' => [
                            'bar' => 4
                        ],
                    ]
                ]
            ]
        ];
        $mockedRunner = $this->getAccessibleMock(Runner::class, ['dummy'], [], '', false);
        $mockedRunner->_set('table', $table);
        $result = $mockedRunner->_call('getFakerFields');

        $this->assertEquals($expectedFields, $result);
    }

    public function fakerFieldsAreReturnedDataProvider()
    {
        return [
            'empty' => [
                'empty', []
            ],
            'fields' => [
                'fields',
                [
                    'field-1' => [
                        'fo' => 1,
                        'bar' => 2
                    ],
                    'field-3' => [
                        'bar' => 4
                    ]
                ]
            ]
        ];
    }
}