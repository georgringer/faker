<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Core\Utility\MathUtility;

class RealText implements PropertyInterface
{
    static public function getSettings(array $configuration = [])
    {
        return [
            'type' => self::class,
            'maxNbChars' => $configuration['maxNbChars'] ?? 200,
            'indexSize' => $configuration['indexSize'] ?? 2,
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $faker->realText($configuration['maxNbChars'], $configuration['indexSize']);
    }

}
