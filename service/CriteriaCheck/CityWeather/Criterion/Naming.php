<?php
namespace Service\CriteriaCheck\CityWeather\Criterion;

use Service\CriteriaCheck\CityWeather\WeatherCriterionInterface;
use Service\OpenWeather\Result\CityWeather;

class Naming implements
    WeatherCriterionInterface
{
    /**
     * @return bool
     */
    public function check(CityWeather $cityWeather): bool
    {
        $check = false;
        $name = $cityWeather->getName();

        if (is_string($name)) {
            if (strlen($name) % 2 !== 0) {
                $check = true;
            }
        }

        return $check;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'naming';
    }

    /**
     * @return string
     */
    public function getLogicalOperator(): string
    {
        return 'and';
    }
}
