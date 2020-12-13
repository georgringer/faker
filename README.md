# TYPO3 CMS Extension `faker`

[![Build Status](https://travis-ci.org/georgringer/faker.svg?branch=master)](https://travis-ci.org/georgringer/faker)

This extensions uses https://github.com/fzaninotto/Faker

## Requirements

- TYPO3 CMS 8.4+
- PHP 7.0-7.4
- License: GPL 2

## Manual

After installation you can run the faker by using

```
bin/typo3 faker:execute --table tx_news_domain_model_news --pid 113 --amount 20
```

### Configuration

You need to configure any table and field which should be filled by the Faker.

```
$t = 'tx_myext_domain_model_xxx';

$GLOBALS['TCA'][$t]['ctrl']['faker'] = true;
$GLOBALS['TCA'][$t]['columns']['title']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings([
	'from' => 15,
	'to' => 60,
]);
$GLOBALS['TCA'][$t]['columns']['description']['faker'] = \GeorgRinger\Faker\Property\Text::getSettings([
	'from' => 200,
	'to' => 300,
]);
$GLOBALS['TCA'][$t]['columns']['bodytext']['faker'] = \GeorgRinger\Faker\Property\RealText::getSettings([
	'maxNbChars' => 200,
	'indexSize' => 2,
]);
$GLOBALS['TCA'][$t]['columns']['title']['author'] = \GeorgRinger\Faker\Property\RandomElement::getSettings([
	'array' => [
		'Alice Apple',
		'Bob Banana',
		'Clive Clementine',
		'Daphne Dried-Fruit',
	],
]);
$GLOBALS['TCA'][$t]['columns']['starttime']['faker'] = \GeorgRinger\Faker\Property\Date::getSettings([
	'from' => '-1month',
	'to' => '+3month',
]);
$GLOBALS['TCA'][$t]['columns']['endtime']['faker'] = \GeorgRinger\Faker\Property\Date::getSettings([
	'from' => '-1month',
	'to' => '+3month',
]);
$GLOBALS['TCA'][$t]['columns']['hidden']['faker'] = \GeorgRinger\Faker\Property\Numeric::getSettings([
	'min' => 0,
	'max' => 1,
]);
$GLOBALS['TCA'][$t]['columns']['amount']['faker'] = \GeorgRinger\Faker\Property\Numeric::getSettings([
	'min' => 1,
	'max' => 5,
]);
$GLOBALS['TCA'][$t]['columns']['costs']['faker'] = \GeorgRinger\Faker\Property\Numeric::getSettings([
	'subtype' => 'randomFloat',
	'min' => 25,
	'max' => 100,
]);
$GLOBALS['TCA'][$t]['columns']['user']['faker'] = \GeorgRinger\Faker\Property\Relation::getSettings([
	'table' => 'fe_users',
	'pid' => 2,
	'min' => 1,
	'max' => 1,
]);
```

TBC, until then check out the configuration inside the ext.
