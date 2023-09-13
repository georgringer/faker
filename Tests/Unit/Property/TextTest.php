<?php

namespace GeorgRinger\Faker\Tests\Unit\Property;

use GeorgRinger\Faker\Property\Date;
use GeorgRinger\Faker\Property\Text;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class TextTest extends UnitTestCase
{

    /**
     * @test
     * @dataProvider correctSettingsAreReturnedDataProvider
     * @param array $configuration
     * @param array $expected
     */
    public function correctSettingsAreReturned(array $configuration, array $expected)
    {
        $result = Text::getSettings($configuration);
        $this->assertEquals($expected, $result);
    }

    static public function correctSettingsAreReturnedDataProvider()
    {
        return [
            'basic' => [
                [], [
                    'type' => Text::class,
                    'from' => 20,
                    'to' => 20
                ]
            ],
            'lowFrom' => [
                [
                    'from' => '3',
                ], [
                    'type' => Text::class,
                    'from' => 5,
                    'to' => 5
                ]
            ],
            'full' => [
                [
                    'from' => 20,
                    'to' => 30,
                ], [
                    'type' => Text::class,
                    'from' => 20,
                    'to' => 30
                ]
            ]
        ];
    }
}
