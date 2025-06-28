<?php
namespace WheatherApi;

class Router
{
    
    private $routes = [];

    public function addRoute(string $method, string $path, callable $handler) : void {
        $this->routes["$method $path"] = $handler;
    }

    public function dispatch(string $method, string $path) : void {
        $key = "$method $path";
        if (isset($this->routes[$key])) {
            call_user_func($this->routes[$key]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
        }
        
    }

}




?>