<?php
namespace Service\OpenWeather\Client;

interface OpenWeatherClientInterface
{
    /**
     * @param string $location
     * @return array
     */
    public function getWeather(string $location): array;
}
