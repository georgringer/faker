<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TCA']['sys_category']['ctrl']['faker'] = true;
$GLOBALS['TCA']['sys_category']['columns']['title']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 8, 'to' => 20]);
