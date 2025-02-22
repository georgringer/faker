<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;

class Internet implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        return [
            'type' => self::class,
            'subtype' => $configuration['subtype'] ?? null,
        ];
    }

    /**
     * @throws \Exception
     */
    public function generate(Generator $faker, array $configuration = [])
    {
        switch ($configuration['subtype']) {
            case 'email':
                return $faker->email();
            default:
                throw new \Exception('Please specify subtype property!');
        }
    }
}
