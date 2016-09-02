<?php

namespace GeorgRinger\Faker\Tests\Unit\Property;

use GeorgRinger\Faker\Property\FullName;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class FullNameTest extends UnitTestCase
{

    /**
     * @test
     * @dataProvider correctSettingsAreReturnedDataProvider
     * @param array $configuration
     * @param array $expected
     */
    public function correctSettingsAreReturned(array $configuration, array $expected)
    {
        $result = FullName::getSettings($configuration);
        $this->assertEquals($expected, $result);
    }

    public function correctSettingsAreReturnedDataProvider()
    {
        return [
            'basic' => [
                [], [
                    'type' => FullName::class,
                ]
            ]
        ];
    }
}