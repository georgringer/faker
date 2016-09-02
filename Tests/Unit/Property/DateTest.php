<?php

namespace GeorgRinger\Faker\Tests\Unit\Property;

use GeorgRinger\Faker\Property\Date;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class DateTest extends UnitTestCase
{

    /**
     * @test
     * @dataProvider correctSettingsAreReturnedDataProvider
     * @param array $configuration
     * @param array $expected
     */
    public function correctSettingsAreReturned(array $configuration, array $expected)
    {
        $result = Date::getSettings($configuration);
        $this->assertEquals($expected, $result);
    }

    public function correctSettingsAreReturnedDataProvider()
    {
        return [
            'basic' => [
                [], [
                    'type' => Date::class,
                    'from' => '-1month',
                    'to' => '+3month'
                ]
            ],
            'full' => [
                [
                    'from' => 'today',
                    'to' => 'tomorrow'
                ], [
                    'type' => Date::class,
                    'from' => 'today',
                    'to' => 'tomorrow'
                ]
            ]
        ];
    }
}