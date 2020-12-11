<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Core\Utility\MathUtility;

class RandomElement implements PropertyInterface
{
    static public function getSettings(array $configuration = [])
    {
        return [
            'type' => self::class,
            'array' => $configuration['array'] ?? ['a', 'b', 'c'],
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $faker->randomElement($configuration['array']);
    }

}
