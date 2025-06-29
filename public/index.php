<?php

require_once __DIR__ . '/../vendor/autoload.php';

use WheatherApi\Router;
use WheatherApi\Controllers\WeatherController;

$router = new Router();
$weatherController = new WeatherController();

$router->addRoute('GET', '/health', [$weatherController, 'health']);

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $path);

