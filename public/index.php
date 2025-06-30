<?php

declare(strict_types=1);


require_once __DIR__ . '/../vendor/autoload.php';

use WeatherApi\Router;
use WeatherApi\Controllers\WeatherController;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header(('X-API-Version: 1.0'));

try {
    $router = new Router();
    $weatherController = new WeatherController();

    $router->addRoute('GET', '/health', [$weatherController, 'health']);
    $router->addRoute('GET', '/weather/current', [$weatherController, 'getCurrentWeather']);

    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

    $router->dispatch($method, $path);

} catch (Throwable $e) {

    http_response_code(500);
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);

    error_log(sprintf(
        "API Error: %s in %s:%d",
        $e->getMessage(),
        $e->getFile(),
        $e->getLine()
    ));

}
