<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$dbPath = '/tmp/database.sqlite';

if (!file_exists($dbPath)) {
    touch($dbPath);
}

$_ENV['DB_DATABASE'] = $dbPath;
putenv("DB_DATABASE=$dbPath");

require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

try {
    $db = new PDO("sqlite:$dbPath");
    $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")->fetch();
    if (!$tables) {
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->call('migrate', ['--force' => true]);
        $kernel->call('db:seed', ['--force' => true]);
    }
} catch (\Exception $e) {
    // fallback
}

$app->handleRequest(Request::capture());
