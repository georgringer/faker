<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Core\Utility\MathUtility;

class Numeric implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        $min = MathUtility::forceIntegerInRange((int)$configuration['min'], -2147483647, 2147483647, 0);
        $max = $configuration['max'] ?? $min;
        return [
            'type' => self::class,
            'subtype' => $configuration['subtype'] ?? null,
            'nbMaxDecimals' => $configuration['nbMaxDecimals'] ?? null,
            'min' => $min,
            'max' => $max
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        switch ($configuration['subtype']) {
            case 'randomFloat':
                return $faker->randomFloat($configuration['nbMaxDecimals'], $configuration['min'], $configuration['max']);
            case 'numberBetween':
            default:
                return $faker->numberBetween($configuration['min'], $configuration['max']);
        }
    }
}
