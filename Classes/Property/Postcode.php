<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;

class Postcode implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        return [
            'type' => self::class,
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $faker->postcode;
    }

}