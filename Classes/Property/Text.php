<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Core\Utility\MathUtility;

class Text implements PropertyInterface
{
    static public function getSettings(array $configuration = [])
    {
        $from = MathUtility::forceIntegerInRange((int)($configuration['from'] ?? 20), 5, 20000);
        $to = $configuration['to'] ?? $from;
        return [
            'type' => self::class,
            'from' => $from,
            'to' => $to
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $faker->text(rand($configuration['from'], $configuration['to']));
    }

}