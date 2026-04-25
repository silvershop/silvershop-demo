<?php

use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;

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
