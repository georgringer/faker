<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = \GeorgRinger\Faker\Command\FakerCommandController::class;

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['faker']['properties'][] = \GeorgRinger\Faker\Property\Text::class;