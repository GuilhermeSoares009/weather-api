<?php 

namespace WeatherApi\Services;

use GuzzleHttp\Client;
use WeatherApi\Cache\RedisCache;

class WeatherService
{
    private $httpClient;
    private $cache;
    private $apiKey;

    public function __construct(RedisCache $cache) {
        $this->cache = $cache;
        $this->apiKey = getenv('WEATHER_API_KEY');
        $this->httpClient =  new Client([
            'base_uri' => getenv('WEATHER_API_URL'),
            'timeout' => 10,
        ]);


    }

    public function getWeatherData(
        string $location, 
        ?string $startDate = null, 
        ?string $endDate = null,
        string $include = 'days,hours,current'
    ): array {

        $cacheKey = $this->generateCacheKey($location, $startDate, $endDate);

        if ($cachedData = $this->cache->get($cacheKey)) {
            return array_merge(
                json_decode($cachedData, true),
                ['fromCache' => true]
            );
        }

        try {
            $apiPath = $this->buildApiPath($location, $startDate, $endDate);

            $response = $this->httpClient->get($apiPath, [
                'query' => [
                    'key' => $this->apiKey,
                    'unitGroup' => 'metric',
                    'include' => $include,
                    'lang' => 'pt'
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $this->cache->set($cacheKey, json_encode($data), (int) getenv('CACHE_TTL'));

            return array_merge($data, ['fromCache' => false]);

        } catch (GuzzleException  $e) {
            error_log('API Request Failed: ' . $e->getMessage());
            throw new \RuntimeException('Weather service unavailable', 500);
        }
    }  

    public function getCurrentWeather(string $city) : array {
        return $this->getWeatherData($city, 'today', null, 'current');
    }  

    private function generateCacheKey(
        string $location, 
        ?string $startDate = null, 
        ?string $endDate = null
    ) : string {
        
        return sprintf(
            'weather:%s:%s:%s',
            strtolower($location),
            $startDate ?? 'current',
            $endDate ?? ''
        );
    }

    private function buildApiPath(
        string $location, 
        ?string $startDate, 
        ?string $endDate
    ): string {
        $path = rawurlencode($location);
        if($startDate) $path .= '/' . rawurlencode($startDate);
        if($endDate) $path .= '/' . rawurlencode($endDate);
        return $path;

    }


}
