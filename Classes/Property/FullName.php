<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;

class FullName implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        return [
            'type' => self::class,
        ];
    }

    public function generate(Generator $faker, array $configuration = []): string
    {
        return $faker->firstName . ' ' . $faker->lastName;
    }

}