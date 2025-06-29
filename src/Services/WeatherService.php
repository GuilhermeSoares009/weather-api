<?php 

namespace WheatherApi\Services;

use GuzzleHttp\Client;
use WheatherApi\Cachce\RedisCache;

class WeatherService
{
    private $httpClient;
    private $cache;
    private $apiKey;

    public function __construct(RedisCache $cache) {
        $this->cache = $cache;
        $this->apiKey = getenv('WEATHER_API_KEY');
        $this->httpClient =  new Client(['base_uri' => getenv('WEATHER_API_URL')]);
    }

    public function getCurrentWeather(string $city) : array {
        
        $cacheKey = "weather:current:{$city}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return json_decode($cachedData, true);
        }

        $response = $this->httpClient->get($city, [
            'query' => [
                'key' => $this->apiKey,
                'unitGroup' => 'metric',
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        $this->cache->set($cacheKey, json_encode($data), getenv('CACHE_TTL'));

        return $data;

    }

    

}
