<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;

// remove PasswordValidator for SilverStripe 5.0
$validator = new PasswordValidator();

$validator->minLength(8);
$validator->checkHistoricalPasswords(6);
Member::set_password_validator($validator);

global $database;
$database = ($name = Environment::getEnv('SS_DATABASE_NAME')) ? $name : 'silvershopcore';

if (Director::isLive()) Director::forceSSL();