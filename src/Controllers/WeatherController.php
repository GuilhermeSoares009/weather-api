<?php

namespace WheatherApi\Controllers;

class WeatherController extends BaseController
{
    public function health() : void {
        $this->jsonResponse(['status' => 'ok']);
    }
}
?>