<?php
defined('TYPO3_MODE') or die();

$t = 'tx_news_domain_model_news';
if (isset($GLOBALS['TCA'][$t])) {
    $GLOBALS['TCA'][$t]['ctrl']['faker'] = true;

    $GLOBALS['TCA'][$t]['columns']['fal_media']['config']['appearance']['elementBrowserEnabled'] = false;

    $GLOBALS['TCA'][$t]['columns']['title']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 15, 'to' => 60]);
    $GLOBALS['TCA'][$t]['columns']['teaser']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 100, 'to' => 1500]);
    $GLOBALS['TCA'][$t]['columns']['bodytext']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings(['from' => 500, 'to' => 10000]);
    $GLOBALS['TCA'][$t]['columns']['categories']['faker'] = \GeorgRinger\Faker\Property\Relation::getSettings([
            'table' => 'sys_category',
            'min' => 0,
            'max' => 5]
    );
    $GLOBALS['TCA'][$t]['columns']['author']['faker'] = \GeorgRinger\Faker\Property\FullName::getSettings([]);
    $GLOBALS['TCA'][$t]['columns']['datetime']['faker'] = \GeorgRinger\Faker\Property\Date::getSettings([
        'from' => '-2months',
        'to' => 'yesterday',
    ]);
}
unset($t);