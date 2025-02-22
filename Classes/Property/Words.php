<?php
namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Core\Utility\MathUtility;

class Words implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        $min = MathUtility::forceIntegerInRange((int)$configuration['min'] ?? 0, 0, 20, 2);
        $max = $configuration['max'] ?? $min;
        return [
            'type' => self::class,
            'min' => $min,
            'max' => $max
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $faker->words(rand($configuration['min'], $configuration['max']), true);
    }

}
