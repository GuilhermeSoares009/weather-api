<?php
namespace WeatherApi\Cache;

use Predis\Client;

class RedisCache {
    private $client;
    
    public function __construct() {
        $this->client = new \Predis\Client([
            'scheme' => 'tcp',
            'host'   => 'weather-api-redis',
            'port'   => 6379,
            'timeout' => 2.5
        ]);
    }
    
    public function get(string $key): ?string {
        try {
            return $this->client->get($key);
        } catch (\Exception $e) {
            error_log('Redis error: ' . $e->getMessage());
            return null;
        }
    }
    
    public function set(string $key, string $value, int $ttl = 0): bool {
        try {
            if ($ttl > 0) {
                $this->client->setex($key, $ttl, $value);
            } else {
                $this->client->set($key, $value);
            }
            return true;
        } catch (\Exception $e) {
            error_log('Redis error: ' . $e->getMessage());
            return false;
        }
    }
}