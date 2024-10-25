<?php

namespace App\Repositories;

interface WeatherRepositoryInterface
{
    public function getWeatherByCity(string $city): array;
}
