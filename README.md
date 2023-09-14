# TYPO3 CMS Extension `faker`

![Build Status](https://github.com/georgringer/faker/actions/workflows/tests.yml/badge.svg?branch=master)

This extensions uses https://github.com/FakerPHP/Faker

## Requirements

- TYPO3 CMS 10, 11, 12
- PHP 7.4-8.3
- License: GPL 2

## Manual

Install:
```
composer require --dev georgringer/faker
```

After installation, you can run the faker by using

```
# arguments are <tablename> <pid> <amount>
bin/typo3 faker:execute tx_news_domain_model_news 113 20
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
$GLOBALS['TCA'][$t]['columns']['keywords']['faker'] = \GeorgRinger\Faker\Property\Words::getSettings([
	'min' => 3,
	'max' => 15,
]);
$GLOBALS['TCA'][$t]['columns']['bodytext']['faker'] = \GeorgRinger\Faker\Property\RealText::getSettings([
	'maxNbChars' => 200,
	'indexSize' => 2,
]);
$GLOBALS['TCA'][$t]['columns']['nothing']['faker'] = \GeorgRinger\Faker\Property\EmptyString::getSettings();
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
$GLOBALS['TCA'][$t]['columns']['firstname']['faker'] = \GeorgRinger\Faker\Property\FirstName::getSettings();
$GLOBALS['TCA'][$t]['columns']['lastname']['faker'] = \GeorgRinger\Faker\Property\LastName::getSettings();
$GLOBALS['TCA'][$t]['columns']['fullname']['faker'] = \GeorgRinger\Faker\Property\FullName::getSettings();
$GLOBALS['TCA'][$t]['columns']['city']['faker'] = \GeorgRinger\Faker\Property\City::getSettings();
$GLOBALS['TCA'][$t]['columns']['zip']['faker'] = \GeorgRinger\Faker\Property\Postcode::getSettings();
$GLOBALS['TCA'][$t]['columns']['street']['faker'] = \GeorgRinger\Faker\Property\StreetAddress::getSettings();
$GLOBALS['TCA'][$t]['columns']['email']['faker'] = \GeorgRinger\Faker\Property\SafeEmail::getSettings();
$GLOBALS['TCA'][$t]['columns']['phone']['faker'] = \GeorgRinger\Faker\Property\PhoneNumber::getSettings();
$GLOBALS['TCA'][$t]['columns']['url']['faker'] = \GeorgRinger\Faker\Property\Url::getSettings();
$GLOBALS['TCA'][$t]['columns']['username']['faker'] = \GeorgRinger\Faker\Property\Username::getSettings();
$GLOBALS['TCA'][$t]['columns']['password']['faker'] = \GeorgRinger\Faker\Property\DefaultPassword::getSettings([
	'password' => '123456',
]);
$GLOBALS['TCA'][$t]['columns']['user']['faker'] = \GeorgRinger\Faker\Property\Relation::getSettings([
	'table' => 'fe_users',
	'pid' => 2, // instead of an integer this can be set to 'current' as well
	'min' => 1,
	'max' => 1,
]);
```

TBC, until then check out the configuration inside the ext.
