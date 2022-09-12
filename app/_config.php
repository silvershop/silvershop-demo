<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;

// remove PasswordValidator for SilverStripe 5.0
$validator = new PasswordValidator();

Member::set_password_validator($validator);

global $database;
$database = ($name = Environment::getEnv('SS_DATABASE_NAME')) ? $name : 'silvershopcore';

if (Director::isLive() && isset($_SERVER['HTTPS'])) {
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
        if(!headers_sent()) {
            header("Status: 301 Moved Permanently");
            header(
                sprintf(
                    'Location: https://%s%s',
                    $_SERVER['HTTP_HOST'],
                    $_SERVER['REQUEST_URI']
                )
            );
            exit();
        }
    }
}
