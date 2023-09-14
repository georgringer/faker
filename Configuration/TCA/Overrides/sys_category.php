<?php
defined('TYPO3') or die();

$GLOBALS['TCA']['sys_category']['ctrl']['faker'] = true;
$GLOBALS['TCA']['sys_category']['columns']['title']['faker'] = \GeorgRinger\Faker\Property\Words::getSettings(['min' => 1, 'max' => 3]);
