<?php
$db = require __DIR__ . '/db.php';
$cache = require __DIR__ . '/cache.php';

$mgpClient = require __DIR__ . '/mgp-client.php';

return [
    'db' => $db,
    'cache' => $cache,
    'mgpClient' => $mgpClient
];
