<?php

namespace GeorgRinger\Faker\Tests\Unit\Generator;

use GeorgRinger\Faker\Generator\Runner;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class RunnerTest extends UnitTestCase
{

    /**
     * @param string $table
     * @param array $expectedFields
     * @test
     * @backupGlobals enabled
     * @dataProvider fakerFieldsAreReturnedDataProvider
     */
    public function fakerFieldsAreReturned(string $table, array $expectedFields)
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
        $mockedRunner = $this->getAccessibleMock(Runner::class, [], [], '', false);
        $reflectionClass = new \ReflectionClass(Runner::class);
        $tableProperty = $reflectionClass->getProperty('table');
        $tableProperty->setAccessible(true);
        $tableProperty->setValue($mockedRunner, $table);
        $method = $reflectionClass->getMethod('getFakerFields');
        $method->setAccessible(true);
        $result = $method->invoke($mockedRunner); // Call the protected method

        $this->assertEquals($expectedFields, $result);
    }

    static public function fakerFieldsAreReturnedDataProvider()
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
