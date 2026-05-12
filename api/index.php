<?php

$dbPath = '/tmp/database.sqlite';

if (!file_exists($dbPath)) {
    $source = __DIR__ . '/../database/database.sqlite';
    if (file_exists($source)) {
        copy($source, $dbPath);
    }
}

$_ENV['DB_DATABASE'] = $dbPath;
putenv("DB_DATABASE=$dbPath");

require __DIR__ . '/../public/index.php';
