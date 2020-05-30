<?php
namespace Service\CriteriaCheck\CityWeather;

use Service\OpenWeather\Client\OpenWeatherClientInterface;
use Service\OpenWeather\Client\Exception\NotFoundException;

use Service\CriteriaCheck\Exception\CityNotFound;

class CriteriaManager
{
    /**
     * @var array
     */
    private $criteria;

    /**
     * @var OpenWeatherClientInterface
     */
    private $openWeatherClient;

    /**
     * @var CriteriaResponse
     */
    private $criteriaResponse;

    public function __construct(
        OpenWeatherClientInterface $openWeatherClient,
        CriteriaResponse $criteriaResponse
    ) {
       $this->openWeatherClient = $openWeatherClient; 
       $this->criteriaResponse = $criteriaResponse;
    }

    /**
     * @param array $criteria
     * @return self
     */
    public function setCriteria(array $criteria)
    {
        $this->criteria = $criteria;
        return $this;
    }

    /**
     * @param string $city
     * @return CriteriaResponse
     */
    public function check(string $city): CriteriaResponse
    {
        try {
            $cityWeather = $this->openWeatherClient->queryCityWeather($city);
            array_walk($this->criteria, [$this->criteriaResponse, 'walkCriterion'], $cityWeather);
        } catch(NotFoundException $e) {
            throw new CityNotFound("City ({$city}) not found.");
        }

        return $this->criteriaResponse;
    }
}
