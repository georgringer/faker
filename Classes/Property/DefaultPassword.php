<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;

class DefaultPassword implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        return [
            'type' => self::class,
            'password' => $configuration['password'] ?? null,
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $configuration['password'];
    }

}
