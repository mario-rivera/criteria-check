<?php
namespace Service\CriteriaCheck\CityWeather;

use Service\OpenWeather\Result\CityWeather;

interface WeatherCriterionInterface
{
    /**
     * @return bool
     */
    public function check(CityWeather $cityWeather): bool;

    /**
     * @return string
     */
    public function getAlias(): string;

    /**
     * @return string
     */
    public function getLogicalOperator(): string;
}
