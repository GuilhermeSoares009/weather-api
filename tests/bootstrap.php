<?php

use Dotenv\Dotenv as Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$envFile = getenv('DOTENV_FILE') ?: '.env.testing';

if (file_exists(__DIR__ . '/../' . '.env.testing')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../', $envFile);
    $dotenv->load(); ,
}

?>