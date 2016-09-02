<?php
defined('TYPO3_MODE') or die();

$t = 'tx_news_domain_model_news';
if (isset($GLOBALS['TCA'][$t])) {
    $GLOBALS['TCA'][$t]['ctrl']['faker'] = true;

    $GLOBALS['TCA'][$t]['columns']['fal_media']['config']['appearance']['elementBrowserEnabled'] = false;

    $GLOBALS['TCA'][$t]['columns']['title']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 15, 'to' => 60]);
    $GLOBALS['TCA'][$t]['columns']['teaser']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 40, 'to' => 150]);
    $GLOBALS['TCA'][$t]['columns']['bodytext']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 200, 'to' => 650]);
    $GLOBALS['TCA'][$t]['columns']['categories']['faker'] = \GeorgRinger\Faker\Property\Relation::getSettings([
            'table' => 'sys_category',
            'pid' => 113,
            'min' => 1,
            'max' => 5]
    );
    $GLOBALS['TCA'][$t]['columns']['author']['faker'] = \GeorgRinger\Faker\Property\FullName::getSettings([]);
    $GLOBALS['TCA'][$t]['columns']['datetime']['faker'] = \GeorgRinger\Faker\Property\Date::getSettings([
        'from' => 'yesterday',
        'to' => '+2months',
    ]);
}
unset($t);