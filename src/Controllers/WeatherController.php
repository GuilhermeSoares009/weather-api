<?php

namespace WeatherApi\Controllers;

use WeatherApi\Services\WeatherService;
use WeatherApi\Cache\RedisCache;

class WeatherController extends BaseController
{

    private WeatherService $weatherService;

    public function __construct() {
        $this->weatherService = new WeatherService(new RedisCache());
    }

    public function health() : void {
        $this->jsonResponse(['status' => 'ok', 'timestamp' => time()]);
    }

    public function getCurrentWeather(array $params): void {

        if(empty($params['city'])){
            $this->jsonResponse(['error' => ' "City" parameter is required'], 400);
            return;
        }

        try {
            $weatherData = $this->weatherService->getWeatherData($params['city'], 'today');

            $this->jsonResponse([
                'city' => $params['city'],
                'data' => $weatherData['currentConditions'] ?? null,
                'source' => 'Visual Crossing API',
                'cached' => $weatherData['fromCache'] ?? false,
            ]);

        } catch (\Exception $e) {
            error_log('WeatherApi Error: ' . $e->getMessage());
            $this->jsonResponse(['error' => 'Failed to fetch weather data'], 500);
        }

    }


}
?>