<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherRepository implements WeatherRepositoryInterface
{
    private string $apiUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.openweather.url');
        $this->apiKey = config('services.openweather.key');
    }

    public function getWeatherByCity(string $city): array
    {
        try {
            $response = Http::get("{$this->apiUrl}?q={$city}&appid={$this->apiKey}&units=metric");

            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('API Error: ' . $response->body());
            return [];
        } catch (\Exception $e) {
            Log::error('HTTP Request failed: ' . $e->getMessage());
            return [];
        }
    }
}
