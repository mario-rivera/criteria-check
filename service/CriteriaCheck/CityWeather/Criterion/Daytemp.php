<?php
namespace Service\CriteriaCheck\CityWeather\Criterion;

use Service\CriteriaCheck\CityWeather\WeatherCriterionInterface;
use Service\OpenWeather\Result\CityWeather;

use DateTime;
use DateTimeZone;

class Daytemp implements
    WeatherCriterionInterface
{
    /**
     * @return bool
     */
    public function check(CityWeather $cityWeather): bool
    {
        $check = false;

        $currentTimestamp = (new DateTime('now', new DateTimeZone('UTC')))->getTimestamp();
        $sunrise =  $cityWeather->getSunrise();
        $sunset = $cityWeather->getSunset();

        $day = ($currentTimestamp >= $sunrise) && ($currentTimestamp < $sunset);

        $temp = $cityWeather->getTemperature();
        if ($temp) {
            // convert to C
            $temp = round(($temp - 273.15));

            if ($day) {
                $check = ($temp >= 17) && ($temp <= 25);
            } else {
                $check = ($temp >= 10) && ($temp <= 15);
            }
        }

        return $check;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'daytemp';
    }

    /**
     * @return string
     */
    public function getLogicalOperator(): string
    {
        return 'and';
    }
}
