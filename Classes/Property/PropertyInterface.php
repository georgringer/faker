<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;

interface PropertyInterface
{

    /**
     * Get the settings
     *
     * @param array $configuration
     * @return array
     */
    static public function getSettings(array $configuration = []);

    /**
     * Generate fake data
     *
     * @param array $configuration
     * @return mixed
     */
    public function generate(Generator $faker, array $configuration = []);
}