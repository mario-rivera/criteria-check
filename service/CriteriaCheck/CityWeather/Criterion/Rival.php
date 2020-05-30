<?php
namespace Service\CriteriaCheck\CityWeather\Criterion;

use Service\CriteriaCheck\CityWeather\WeatherCriterionInterface;
use Service\OpenWeather\Result\CityWeather;

use Service\OpenWeather\Client\OpenWeatherClientInterface;

class Rival implements
    WeatherCriterionInterface
{
    /**
     * @var OpenWeatherClientInterface
     */
    private $openWeatherClient;

    public function __construct(
        OpenWeatherClientInterface $openWeatherClient
    ) {
        $this->openWeatherClient = $openWeatherClient;
    }

    /**
     * @return bool
     */
    public function check(CityWeather $cityWeather): bool
    {
        $check = false;

        try {
            $rivalWeather = $this->openWeatherClient->queryCityWeather('cologne');

            $cityTemp = $cityWeather->getTemperature();
            $rivalTemp = $rivalWeather->getTemperature();

            $check = ($cityTemp > $rivalTemp);
        } catch(\Throwable $e) {

        }

        return $check;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'rival';
    }

    /**
     * @return string
     */
    public function getLogicalOperator(): string
    {
        return 'and';
    }
}
