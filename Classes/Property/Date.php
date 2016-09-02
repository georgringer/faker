<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;

class Date implements PropertyInterface
{
    static public function getSettings(array $configuration = [])
    {
        $from = $configuration['from'] ?: '-1month';
        $to = $configuration['to'] ?: '+3month';
        return [
            'type' => self::class,
            'from' => $from,
            'to' => $to,
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $faker->dateTimeBetween($configuration['from'], $configuration['to'])->getTimestamp();
    }

}