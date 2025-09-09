<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Example: Eastern Time (Toronto, Canada)
date_default_timezone_set("America/Toronto");

// Now dates will show in Canada (Toronto) time

define('LARAVEL_START', microtime(true));

// Maintenance check
if (file_exists(__DIR__ . '/storage/framework/maintenance.php')) {
    require __DIR__ . '/storage/framework/maintenance.php';
}

// Autoloader (NO ../ anymore)
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
