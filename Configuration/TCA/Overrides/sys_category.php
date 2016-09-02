<?php
defined('TYPO3_MODE') or die();
$t = 'sys_category';
$GLOBALS['TCA'][$t]['ctrl']['faker'] = true;
$GLOBALS['TCA'][$t]['columns']['title']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 8, 'to' => 20]);
