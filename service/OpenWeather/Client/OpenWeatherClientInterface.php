<?php
namespace Service\OpenWeather\Client;

use Service\OpenWeather\Result\CityWeather;

interface OpenWeatherClientInterface
{
    /**
     * @param string $city
     * 
     * @throws Exception\NotFoundException
     * @throws Exception\ApiException
     * 
     * @return CityWeather
     */
    public function queryCityWeather(string $location): CityWeather;
}
