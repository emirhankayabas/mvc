<?php

session_start();
ob_start();

function loadClasses($className)
{
    require __DIR__ . '/classes/' . strtolower($className) . ".php";
}

spl_autoload_register('loadClasses');

$config = require __DIR__ . "/config.php";

try {
    $db = new BasicDB($config['db']['host'], $config['db']['name'], $config['db']['user'], $config['db']['password']);
} catch (PDOException $e) {
    die($e->getMessage());
}

foreach (glob(__DIR__ . '/helper/*.php') as $helperFile) {
    require $helperFile;
}
