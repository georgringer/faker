<?php
defined('TYPO3') or die();

$t = 'fe_users';
if (isset($GLOBALS['TCA'][$t])) {
    $GLOBALS['TCA']['fe_users']['ctrl']['faker'] = true;

    $GLOBALS['TCA']['fe_users']['columns']['username']['faker'] = \GeorgRinger\Faker\Property\Username::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['password']['faker'] = \GeorgRinger\Faker\Property\DefaultPassword::getSettings(['password' => 'Welcome01!']);
    $GLOBALS['TCA']['fe_users']['columns']['name']['faker'] = \GeorgRinger\Faker\Property\FullName::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['first_name']['faker'] = \GeorgRinger\Faker\Property\FirstName::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['middle_name']['faker'] = \GeorgRinger\Faker\Property\EmptyString::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['last_name']['faker'] = \GeorgRinger\Faker\Property\LastName::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['address']['faker'] = \GeorgRinger\Faker\Property\StreetAddress::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['telephone']['faker'] = \GeorgRinger\Faker\Property\PhoneNumber::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['email']['faker'] = \GeorgRinger\Faker\Property\SafeEmail::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['zip']['faker'] = \GeorgRinger\Faker\Property\Postcode::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['city']['faker'] = \GeorgRinger\Faker\Property\City::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['country']['faker'] = \GeorgRinger\Faker\Property\Country::getSettings([]);
    $GLOBALS['TCA']['fe_users']['columns']['www']['faker'] = \GeorgRinger\Faker\Property\Url::getSettings([]);
}
unset($t);
