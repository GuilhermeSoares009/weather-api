<?php

namespace WeatherApi\Controllers;

class BaseController
{
    protected function jsonResponse(array $data, int $statusCode = 200) : void {
        header('Content-type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }
}


?>