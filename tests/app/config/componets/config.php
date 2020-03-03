<?php
$db = require __DIR__ . '/db.php';
$mgpClient = require __DIR__ . '/mgp-client.php';

return [
    'db' => $db,
    'mgpClient' => $mgpClient
];
